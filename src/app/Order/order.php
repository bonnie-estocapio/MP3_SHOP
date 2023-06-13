<?php

namespace App\Order;

use App\Operation\Database;
use App\Operation\Functions;
use App\Track\Track;

Class Order
{
    public float $total = 0;
    public int $count = 0;

    public function log($dataArray)
    {
        $dbase = new Database;
        $dataString = http_build_query($dataArray);
        $query = $dbase->query("INSERT INTO history (username, data, total, count) VALUES ('{$_SESSION['user']}', '{$dataString}', '{$_SESSION['total']}', '{$_SESSION['count']}')");
        if (!$query) {
            echo "failed to input data";
        }
    }

    public function readLog($orderID, $username)
    {
        $dbase = new Database;
        if ($orderID === NULL){
            $orderQuery = $dbase->query("SELECT id, data, date FROM history WHERE username = '{$username}'");
            while($row = $orderQuery->fetch(\PDO::FETCH_ASSOC)){
                $this->show($row);
            }
        } else {
            $orderQuery = $$dbase->query("SELECT id, data, date FROM history WHERE username = '{$username}' && id = '{$orderID}'");
            while($row = $orderQuery->fetch(\PDO::FETCH_ASSOC)){
                $this->show($row);
            }
        }
    }

    public function show($orderData)
    {
        $track = new Track;
        $functions = new Functions;

        $orderArray = [];

        parse_str($orderData['data'], $orderArray);
        foreach ($orderArray as $data => $value) {
            if ($value === 1 && substr($data, 0, 8)== "product_"){
                $id = substr($data, 8, strlen($data) - 8);
                $trackQuery = $track->getQuery($id);
                while($row = $trackQuery->fetch(\PDO::FETCH_ASSOC)) {
                    $order = <<<DELIMETER
                        <tr>
                            <td>{$orderData['id']}</td>
                            <td>{$row['title']}</td>
                            <td>{$row['price']}</td>
                            <td>{$orderData['date']}</td>
                        </tr>
                    DELIMETER;
                    $this->total = $this->total + $row['price'];
                    $this->count++;
                    echo $order;
                }
            }
        }
    }
}