<?php

require_once 'functions.php';

class CartFunctions
{
    public function addCart()
    {
        $functions = new Functions;
        if(isset($_GET['add'])) {
            $_SESSION['product_' . $_GET['add']]=1;
            $functions->navigate("checkout.php");
        }
    }

    public function removeCart()
    {
        $functions = new Functions;
        if(isset($_GET['remove'])) {
            $_SESSION['product_' . $_GET['remove']]=0;
            $functions->navigate("checkout.php");
        }
    }

    public function viewCart()
    {  
        $functions = new Functions;
        $total=0;
        $count=0;
        foreach($_SESSION as $data => $value) {
            if($value == 1 && substr($data, 0, 8)== "product_") {
                $id = substr($data, 8, strlen($data)-8);
                $query = $functions->query("SELECT * FROM tracks WHERE id =". $id);
                while($row = mysqli_fetch_assoc($query)) {
                    $product = <<<DELIMETER
                        <tr>
                            <td>{$row['title']}</td>
                            <td>{$row['artist']}</td>
                            <td>{$row['price']}</td>
                            <td><a href="cart.php?remove={$row['id']}">Remove</a></td>
                        </tr>
                    DELIMETER;
                    $total = $total + $row['price'];
                    $count++;
                    echo $product;
                }
            }
        }
        $_SESSION['total'] = $total;
        $_SESSION['count'] = $count;
    }

    public function seeOrder($username)
    {
        $arrayOrder = [];
        
    }
}