<?php

require_once 'autoload.php';

$autoload = new Autoload;

Class Order
{
    public function writeOrderHistory($dataArray)
    {
        $dbase = new Database;
        $dataString = http_build_query($dataArray);
        $query = $$dbase->query("INSERT INTO history (username, data, total, count) VALUES ('{$_SESSION['user']}', '{$dataString}', '{$_SESSION['total']}', '{$_SESSION['count']}')");
        if (!$query) {
            echo "failed to input data";
        }
    }

    public function viewOrderHistory($orderID, $username)
    {
        $dbase = new Database;
        if ($orderID === NULL){
            $orderQuery = $dbase->query("SELECT id, data, date FROM history WHERE username = '{$username}'");
            while($row = mysqli_fetch_assoc($orderQuery)){
                $this->showOrderTable($row);
            }
        } else {
            $orderQuery = $$dbase->query("SELECT id, data, date FROM history WHERE username = '{$username}' && id = '{$orderID}'");
            while($row = mysqli_fetch_assoc($orderQuery)){
                $this->showOrderTable($row);
            }
        }
    }

    public function showOrderTable($orderData)
    {
        $dbase = new Database;
        $functions = new Functions;

        $orderArray = [];

        parse_str($orderData['data'], $orderArray);
        foreach ($orderArray as $data => $value) {
            if ($value == 1 && substr($data, 0, 8)== "product_"){
                $id = substr($data, 8, strlen($data)-8);
                $trackQuery = $dbase->query("SELECT * FROM tracks WHERE id =". $id);
                while($row = mysqli_fetch_assoc($trackQuery)) {
                    $order = <<<DELIMETER
                        <tr>
                            <td>{$orderData['id']}</td>
                            <td>{$row['title']}</td>
                            <td>{$row['price']}</td>
                            <td>{$orderData['date']}</td>
                        </tr>
                    DELIMETER;
                    $functions->totalOrder = $functions->totalOrder + $row['price'];
                    $functions->countOrder++;
                    echo $order;
                }
            }
        }
    }
}