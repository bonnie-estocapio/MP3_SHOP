<?php

namespace App\Track;

use App\Operation\Message;

class Download
{
    public function downloadTrack(): void
    {
        $message = new Message;

        if (isset($_GET['path'])) {
            $filename = $_GET['path'];
            if (file_exists($filename)) {
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
                $message->set("File does not exist.");
            }
        }
        
    }
}