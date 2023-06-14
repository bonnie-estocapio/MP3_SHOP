<?php

namespace App\Order;

use App\Operation\Navigation;
use App\Track\Track;

class Cart
{
    public function add(): void
    {
        $navigation = new Navigation();
        if (isset($_GET['add'])) {
            $_SESSION['product_' . $_GET['add']] = 'cart';
            $navigation->goTo("checkout.php");
        }
    }

    public function remove(): void
    {
        $navigation = new Navigation;
        if (isset($_GET['remove'])) {
            $_SESSION['product_' . $_GET['remove']] = 0;
            $navigation->goTo("checkout.php");
        }
    }

    public function view(): void
    {
        $track = new Track();
        $total = 0;
        $count = 0;
        foreach ($_SESSION as $data => $value) {
            if ($value === "cart" && substr($data, 0, 8) === "product_") {
                $id = substr($data, 8);
                $query = $track->getQuery($id);

                while ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
                    $product = <<<DELIMITER
                        <tr>
                            <td>{$row['title']}</td>
                            <td>{$row['artist']}</td>
                            <td>{$row['price']}</td>
                            <td><a href="cart.php?remove={$row['id']}">Remove</a></td>
                        </tr>
                    DELIMITER;
                    $total += $row['price'];
                    $count++;
                    echo $product;
                }
            }
        }
        $_SESSION['total'] = $total;
        $_SESSION['count'] = $count;
    }
}