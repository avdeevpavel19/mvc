<?php

use App\Core\App;

class m0002_add_password
{
    public function up()
    {
        $db = App::$app->db;

        $sql = "ALTER TABLE `users` 
                ADD  `password` VARCHAR(255) 
                NOT NULL AFTER `login`;";

        $db->pdo->exec($sql);
    }
}