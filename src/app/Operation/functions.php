<?php

namespace App\Operation;

class Functions
{
    private bool $guest = true;

    public function filter($s, $flags = null): string
    {
        if (is_string($s)) {
            return ($flags === null) ? htmlspecialchars($s) : htmlspecialchars($s, $flags);
        } else {
            return "";
        }
    }

    public function state(): bool
    {
        $navigation = new Navigation;
        $location = $navigation->getCurrent();

        if ($location !== '/Music_Shop/register.php') {
            $this->guest = true;

            if (!isset($_SESSION['loggedin'])) {
                $this->guest = true;

                for ($id = 1; $id <= 9; $id++) {
                    $_SESSION['product_'.$id] = 0;
                }

                $_SESSION['loggedin'] = false;
                $_SESSION['user'] = 'Guest';
            } elseif (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                $this->guest = false;
            }
        } else {
            $this->guest = true;
        }

        return $this->guest;
    }

    public function showUser(): void
    {
        $functions = new Functions;

        $user = $functions->filter($_SESSION['user']);
        
        echo $user;
    }
}