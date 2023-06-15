<?php

namespace App\Track;

use App\Operation\Database;
use App\Operation\Message;

class Download
{
    public function downloadTrack(): void
    {
        $message = new Message;
        $database = new Database;

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $owned = $this->checkIfOwned($id);
            $query = $database->query("SELECT title from tracks WHERE id = " . $id);
            $data = $query->fetch(\PDO::FETCH_ASSOC);
            $filename = "../resources/tracks/{$data['title']}.mp3";

            if (file_exists($filename) && $owned === true) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header("Cache-Control: no-cache, must-revalidate");
                header("Expires: 0");
                header('Content-Disposition: attachment; filename="'.basename($filename).'"');
                header('Content-Length: ' . filesize($filename));
                header('Pragma: public');
                flush();
                readfile($filename);

                die();
            } else {
                $message->set("No permission to download");
            }
        }
    }

    public function checkIfOwned($trackID): bool
    {
        $owned = false;
        foreach ($_SESSION as $data => $value) {
            if ($data === 'product_' . $trackID) {
                if ($value === "owned") {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }
}