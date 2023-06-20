<?php

namespace App\Order;

use App\Operation\Database;
use App\Track\Track;

class Order
{
    public float $total = 0;
    public int $count = 0;

    public function log($dataArray): void
    {
        $database = new Database;

        $username = $_SESSION['user'];
        $total = $_SESSION['total'];
        $count = $_SESSION['count'];
        $dataString = http_build_query($dataArray);

        $query = $database->conn->prepare("INSERT INTO history (username, data, total, count) VALUES (:username, :dataString, :total, :count)");
        $query->bindParam(':username', $username);
        $query->bindParam(':dataString', $dataString);
        $query->bindParam(':total', $total);
        $query->bindParam(':count', $count);
        $query->execute();

        if (!$query) {
            echo "failed to input data";
        }
    }

    public function readLog($orderID, $username): void
    {
        $database = new Database;

        if ($orderID === null) {
            $orderQuery = $database->conn->prepare("SELECT id, data, date FROM history WHERE username = :username");
            $orderQuery->bindParam(':username', $username);
            $orderQuery->execute();

            while ($row = $orderQuery->fetch(\PDO::FETCH_ASSOC)) {
                $this->show($row);
            }
        } else {
            $orderQuery = $database->conn->prepare("SELECT id, data, date FROM history WHERE username = :username && id = :orderID");
            $orderQuery->bindParam(':username', $username);
            $orderQuery->bindParam(':orderID', $orderID);
            $orderQuery->execute();

            while ($row = $orderQuery->fetch(\PDO::FETCH_ASSOC)) {
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
                $id = substr($data, 8);
                $trackQuery = $track->getQuery($id);

                while ($row = $trackQuery->fetch(\PDO::FETCH_ASSOC)) {
                    $order = <<<DELIMITER
                        <tr>
                            <td>{$orderData['id']}</td>
                            <td>{$row['title']}</td>
                            <td>{$row['price']}</td>
                            <td>{$orderData['date']}</td>
                        </tr>
                    DELIMITER;

                    $this->total += $row['price'];
                    $this->count++;
                    echo $order;
                }
            }
        }
    }
}