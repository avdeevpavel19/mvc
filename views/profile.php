<?php

use App\Core\App;

/** @var $this \App\Core\View */
$this->title = 'Профиль';

?>

<h3>Привет <b><?php echo App::$app->user->getLogin() ?></b></h3>

<style>
    h3 {
        text-align: center;
        padding-top: 250px;
    }
</style>