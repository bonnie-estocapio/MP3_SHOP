# Music_Shop
An online shop for mp3 files in which it can store and allow users to play it in their libraries. This project uses PHP.

Version Check:
PHP version = 8.2.
mysqli = 8.2.0
phpmyadmin Server version =  10.4.27-MariaDB - mariadb.org binary distribution 
XAMPP Control Panel v3.3.0 (start Apache and MySQL Modules)

Install autoloader via Composer

Generate App Password for PHPMailer
1. Go to your Google Account.
2. Select Security.
3. Under "Signing in to Google," select 2-Step Verification.
4. At the bottom of the page, select App passwords.
5. Select "Other (Custom name)" and input any name.
6. Select Generate.
7. Copy App Password
8. Edit the following lines in includes/send.php
            $mail->Username = "<enter email here>";
            $mail->Password = '<enter generated app password>';

How to use:
1. Copy files to localhost root (C:\xampp\htdocs\)
2. Open https://localhost/Music_Shop/public in browser to start using the website.
3. Please register with valid and working email.
4. Use website as intended
