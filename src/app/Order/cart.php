<?php

namespace App\Order;

use App\Operation\Navigation;
use App\Track\Track;

class Cart
{
    public function add()
    {
        $navigation = new Navigation();
        if (isset($_GET['add'])) {
            $_SESSION['product_' . $_GET['add']]=1;
            $navigation->goTo("checkout.php");
        }
    }

    public function remove()
    {
        $navigation = new Navigation;
        if (isset($_GET['remove'])) {
            $_SESSION['product_' . $_GET['remove']] = 0;
            $navigation->goTo("checkout.php");
        }
    }

    public function view()
    {   
        $track = new Track;
        $total=0;
        $count=0;
        foreach ($_SESSION as $data => $value) {
            if ($value === 1 && substr($data, 0, 8) === "product_") {
                $id = substr($data, 8, strlen($data) - 8);
                $query = $track->getQuery($id);

                while ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
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
}