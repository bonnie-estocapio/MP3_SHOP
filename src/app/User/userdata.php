<?php

namespace App\User;

use App\Operation\Database;

Class UserData
{
    public function change($before, $after)
    {
        $userdata = new UserData;
        $database = new Database;

        foreach ($_SESSION as $data => $value) {
            if ($value === $before && substr($data, 0, 8) == "product_") {
                $id = substr($data, 8, strlen($data)-8);
                $query = $database->query("SELECT * FROM tracks WHERE id =". $id);
                while ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
                    $_SESSION['product_'.$id] = $after;
                }
            }
        }
        $userdata->write($_SESSION['user']);
    }

    public function write($username)
    {
        $database = new Database;
        $dataArray = [];

        foreach ($_SESSION as $data => $value) {
            if ($value != 0 && substr($data, 0, 8) == "product_") {
                $id = substr($data, 8, strlen($data) - 8);
                $query = $database->query("SELECT * FROM tracks WHERE id =". $id);
                while ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
                    $dataArray['product_' . $id] = $_SESSION['product_' . $id];
                }
            }
        }

        $dataString = http_build_query($dataArray);
        $query = $database->query("UPDATE users SET data = '{$dataString}' WHERE username = '{$username}'");
        if (!$query) {
            echo "failed to input data";
        }
    }

    public function read()
    {
        $database = new Database;

        $newArray = [];
        $query = $database->query("SELECT data FROM users WHERE username = '{$_SESSION['user']}'");
        $data = $query->fetch(\PDO::FETCH_ASSOC);
        $data['data'] = trim($data['data'], '{()}');
        parse_str($data['data'], $newArray);
        
        foreach ($newArray as $data => $value) {
            if ($value > 0 && substr($data, 0, 8) == "product_") {
                $id = substr($data, 8, strlen($data) - 8);
                $_SESSION['product_'.$id] = $newArray['product_'.$id];
            }
        }
    }
}
