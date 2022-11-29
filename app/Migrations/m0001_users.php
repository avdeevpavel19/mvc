<?php

use App\Core\App;

class m0001_users
{
    public function up()
    {
        $db = App::$app->db;

        $sql = "CREATE TABLE `users` ( 
            `id` INT(11) NOT NULL AUTO_INCREMENT , 
            `login` VARCHAR(255) NOT NULL , 
            PRIMARY KEY (`id`)) ENGINE = InnoDB;";

        $db->pdo->exec($sql);
    }
}