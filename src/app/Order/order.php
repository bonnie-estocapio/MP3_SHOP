<?php

namespace App\Order;

use App\Operation\Database;
use App\Operation\Functions;
use App\Track\Track;

Class Order
{
    public float $total = 0;
    public int $count = 0;

    public function log($dataArray): void
    {   
        $dbase = new Database;

        $username = $_SESSION['user'];
        $total = $_SESSION['total'];
        $count = $_SESSION['count'];
        $dataString = http_build_query($dataArray);
        
        $query = $dbase->query("INSERT INTO history (username, data, total, count) VALUES ('{$username}', '{$dataString}', '{$total}', '{$count}')");
        if (!$query) {
            echo "failed to input data";
        }
    }

    public function readLog($orderID, $username): void
    {
        $dbase = new Database;

        if ($orderID === NULL) {
            $orderQuery = $dbase->query("SELECT id, data, date FROM history WHERE username = '{$username}'");
            while($row = $orderQuery->fetch(\PDO::FETCH_ASSOC)){
                $this->show($row);
            }
        } else {
            $orderQuery = $dbase->query("SELECT id, data, date FROM history WHERE username = '{$username}' && id = '{$orderID}'");
            while($row = $orderQuery->fetch(\PDO::FETCH_ASSOC)){
                $this->show($row);
            }
        }
    }

    public function show($orderData): void
    {
        $track = new Track;
        $orderArray = [];
        parse_str($orderData['data'], $orderArray);

        foreach ($orderArray as $data => $value) {
            if ($value === "checkout" && substr($data, 0, 8) === "product_") {
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