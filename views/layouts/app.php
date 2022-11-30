<?php

use App\Core\App;

/** @var $this \App\Core\View */

?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title><?php echo $this->title ?></title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">mvc</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/">Главная</a>
                </li>

                <?php if (App::isGuest()): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/register">Регистрация</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Вход</a>
                    </li>
                <?php else: ?>
            </ul>

            <ul class="d-flex" style="align-items: center; width: 12%; justify-content: space-between;">
                <li class="nav-item">
                    <a class="nav-link" href="/profile">Профиль</a>
                </li>
                <li class="nav-item">
                    <a href="/logout" class="btn btn-primary">Выйти</a>
                </li>
                <?php endif ?>
            </ul>
        </div>
    </div>
</nav>

<?php if (App::$app->session->getFlash('success')): ?>
    <div class="alert alert-success" style="text-align: center">
        <?php echo App::$app->session->getFlash('success') ?>
    </div>
<?php endif; ?>

{{content}}
</body>
</html>

<style>
    li {
        list-style-type: none;
    }
</style>
