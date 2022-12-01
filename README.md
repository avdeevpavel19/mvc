# MVC
Реализация MVC на примере авторизации

## Технологии
- [php 8.1](https://www.php.net/releases/8.1/en.php)
- [phpdotenv](https://github.com/vlucas/phpdotenv)

## Установка
Копируем репозиторий
```sh
git clone https://github.com/avdeevpavel19/mvc.git
```

Переходим в папку проекта
```sh
cd mvc
```

Устанавливаем зависимости
```sh
composer install
```

Копируем содержимое из файла .env.example в файл .env
```sh
cp .env.example .env
```

Редактируем файл .env Вставляем данные для подключения к БД
```sh
DB_DSN = mysql:host=127.0.0.1;port=3306;dbname=example
DB_USER = root
DB_PASSWORD = root
```

Выполняем миграции
```sh
php migrations.php
```

## Запуск
Переходим в папку public
```sh
cd public
```

Запускаем локальный сервер
```sh
php -S localhost:8000
```
