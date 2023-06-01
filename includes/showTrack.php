<?php

require_once 'includes/functions.php';

class ShowTrack
{
    public function list($trackID)
    {
        $functions = new Functions;
        $query = $functions->query("SELECT id, title, artist, year, album, genre,price FROM tracks WHERE id=$trackID");
        $data = mysqli_fetch_assoc($query);
        return $data;
    }

    public function showSearch($search, $category)
    {
        $functions = new Functions;
        $query = $functions->query("SELECT id FROM tracks WHERE {$category}='{$search}'");
        if(mysqli_fetch_assoc($query) === null) {
            echo "Search result not Found";
        } else {
            while($row = mysqli_fetch_assoc($query)) {
                $this->showTrack($row['id']);
            }
        }
    }

    public function showOwnedTracks()
    {
        $functions = new Functions;
        foreach($_SESSION as $data => $value) {
            if($value == 2 && substr($data, 0, 8)== "product_") {
                    $id = substr($data, 8, strlen($data)-8);
                    $this->showTrack($id);
            }
        }
    }

    public function showAllTracks()
    {
        $count = 1;
        $trackTotal = $this->trackTotal();                    
        while($count <= $trackTotal) {
            $this->showTrack($count);
            $count++;
        }
    }
    
    public function showTrack($trackID)
    {
        $data = $this->list($trackID);
        $track = <<<DELIMETER
            <div class="col-sm-4 col-lg-4 col-md-4">
                <div class="thumbnail">
                    <img src="images/{$data['album']}.jpg" alt="Album">
                    <div class="caption">
                        <h4 class="pull-right">$ {$data['price']}</h4>
                        <h4>{$data['title']}</h4>
                        <p>{$data['artist']}</p>
                        <p>{$data['album']}</p>
                        <p>({$data['genre']}) {$data['year']}</p>
                    </div>
        DELIMETER;
        echo $track;
        if ($_SESSION['product_'.$trackID] == 0) {
            $button = <<<DELIMETER
                        <a class="btn btn-primary" href="cart.php?add={$trackID}">Add to Cart</a>
                    </div>
                </div>
            DELIMETER;
            echo $button;
        } else if ($_SESSION['product_'.$trackID] == 1) {
            $button = <<<DELIMETER
                        <a class="btn btn-primary" href="cart.php?remove={$trackID}">Remove from Cart</a>
                    </div>
                </div>
            DELIMETER;
            echo $button;
        } else if ($_SESSION['product_'.$trackID] == 2) {
            $button = <<<DELIMETER
                        <h5> In Library </h5>
                        <a class="btn btn-primary" href="">Download</a>
                    </div>
                </div>
            DELIMETER;
            echo $button;
        }
    }

    public function trackTotal()
    {
        $functions = new Functions;
        $count = 0;
        $query = $functions->query("SELECT id FROM tracks");
        while($row = mysqli_fetch_assoc($query))
        {
            $count++;
        }
        return $count;
    }
}