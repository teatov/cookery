Курсовой проект. [Этот же проект](https://github.com/teatov/Web-Project-Recipes), переписанный на PHP, Yii2 и MySQL.

![cookery](https://github.com/teatov/cookery/assets/79892286/3ada6c5e-2f9c-4cfb-b928-735f84ec4365)

Установка

Откройте командную строку в папке приложения и запустите следующую команду, чтобы установить необходимые расширения:

    composer install

Выполните команду

    init

Затем запустите следующую команду, чтобы проверить требования:

    php requirements.php

Откройте файл common/config/main_local.php и измените параметры на верные для вашей базы данных.
По умолчанию:

    'db' => [
            'class' => \yii\db\Connection::class,
            'dsn' => 'mysql:host=127.0.0.1;dbname=cookery',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],

Запустите следующую команду, чтобы запустить миграцию БД:

    php yii migrate

Подключите приложение к вашему серверу Apache или Nginx.
Создайте для него виртуальный хост с именем cookery.test, ведущий в frontend/web.
Создайте для него виртуальный хост с именем editry.cookery.test, ведущий в backend/web.
Запустите сервер
(либо можно на докере запустить, но я не пробовал)

У сайта есть два домена - cookery и editry.cookery. На обычном происходит просмотр рецептов, а на editry рецепты создаются и редактируются. У них свои отдельные сессии, так что нужно войти и там и там.

Все письма приходят в папку @frontend/runtime/mail. Чтобы открыть ссылки, нужно убрать разрывы строки с =, а =3D заменить на =.
Подробнее тут https://github.com/yiisoft/yii2-app-advanced/blob/master/docs/guide/start-installation.md
