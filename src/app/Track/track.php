<?php

namespace App\Track;

use App\Operation\Database;

class Track
{
    public function __construct()
    {
        $_POST['searchtext'] = '';
    }
    
    public function list($trackID): array
    {
        $database = new Database;

        $query = $database->conn->prepare("SELECT id, title, artist, year, album, genre,price FROM tracks WHERE id = :id");
        $query->bindParam(':id', $trackID);
        $query->execute();
        $data = $query->fetch(\PDO::FETCH_ASSOC);

        return $data;
    }

    public function search($search, $category): void
    {
        $database = new Database;
        $query = $database->conn->prepare("SELECT id FROM tracks WHERE :category = ':search'");
        $query->bindParam(':category', $category);
        $query->bindParam(':search', $search);
        $query->execute();

        if($query === null) {
            echo "Search result not Found";
        } else {
            while($row = $query->fetch(\PDO::FETCH_ASSOC)) {
                $this->display($row['id']);
            }
        }
    }

    public function owned(): void
    {
        foreach($_SESSION as $data => $value) {
            if($value === 'owned' && substr($data, 0, 8) === "product_") {
                $id = substr($data, 8);
                $this->display($id);
            }
        }
    }

    public function all(): void
    {
        $count = 1;
        $trackTotal = $this->count();                    
        while($count <= $trackTotal) {
            $this->display($count);
            $count++;
        }
    }
    
    public function display($trackID): void
    {
        $download = new Download;
        $data = $this->list($trackID);
        $download->downloadTrack();
        $track = <<<DELIMETER
            <div class="col-sm-4 col-lg-4 col-md-4">
                <div class="thumbnail">
                    <img src="../resources/images/{$data['album']}.jpg" alt="Album">
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
            $button = <<<DELIMITER
                        <a class="btn btn-primary" href="cart.php?add={$trackID}">Add to Cart</a>
                    </div>
                </div>
            DELIMITER;
            echo $button;
        } elseif ($_SESSION['product_'.$trackID] === "cart") {
            $button = <<<DELIMITER
                        <a class="btn btn-primary" href="cart.php?remove={$trackID}">Remove from Cart</a>
                    </div>
                </div>
            DELIMITER;
            echo $button;
        } elseif ($_SESSION['product_'.$trackID] === "owned") {
            $button = <<<DELIMITER
                        <a class="btn btn-primary" href="{$_SERVER['REQUEST_URI']}?id={$trackID}">Download</a>
                    </div>
                </div>
            DELIMITER;
            echo $button;
        }
    }

    public function count(): int
    {
        $database = new Database;
        $count = 0;
        $query = $database->query("SELECT id FROM tracks");
        while($row = $query->fetch(\PDO::FETCH_ASSOC))
        {
            $count++;
        }
        return $count;
    }

    public function getQuery($id): mixed
    {
        $database = new Database;
        $query = $database->conn->prepare("SELECT * FROM tracks WHERE id = :id");
        $query->bindParam(':id', $id);
        $query->execute();

        return $query;
    }
}