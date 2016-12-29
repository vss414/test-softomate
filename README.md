# Test project for Softomate


Для работы с базой данных необходимо создать файл local_db.php 
в папке config путём копирования файла db.php. В файле local_db.php
заполните данные для коннекта к базе данных, которая должна быть уже 
создана для проекта.

Далее находясь в корневой папке проекта выполните следующую команду:

```
php yii migrate
```

Выполнение этой команды создаст все необходимые для работы проекта 
таблицы и наполнит их тестовыми данными.


## Структура проекта

1. migrations
    
    Директория с миграциями проекта. 
    Содержит две миграции - первая создаёт необходимые таблицы, 
    вторая их наполняет тестовыми данными
    
2. config

    Директория с конфигурационными файлами.
    Данные для подключения к базе данных берутся из файла 
    local_db.php.
    Получить его можно путём копирования файла db.php и замены 
    в нём поля {host}, {db}, {login}, {password}.
    
3. controllers
    
    Директория с контроллерами проекта.
    SiteController.php - реализовывает методы для главной страницы 
    (вывод информации о списке методов апи), для авторизации и выхода
    из сессии.
    
4. views

    Директория с представлениями проекта. Содержит макет проекта
    layouts/main.php, представление для главной страницы 
    site/index.php, представление с формой авторизации site/login.php.
    
5. models

    Директория с моделями проекта.
    
    * AuthUser - модель для авторизации. Использует данные из
    таблицы пользователей.
    * LoginForm - форма для авторизации.
    * Merchant - модель для сущности мерчантов.
    * MerchantCoupon - модель для купонов мерчантов.
    * User - модель для пользователей. Содержит метод beforeSave
    для заполнения токена при создании и перезаписи пароля в виде
    хеша.
    * UserCoupon - модель для купонов пользователей.
    
    1. search - директория с поисковыми моделями для 
    административного раздела.
    
6. module

    1. admin - Директория с административным модулем. В нём можно 
        редактировать информацию по пользователям, удалять мерчантов,
        просматривать список пользователей, мерчантов, купонов 
        мерчантов и пользователей.
        В классе из файла Module.php выполняется проверка, что 
        просмотр раздела выполняется авторизованным пользователем.
        
    2. api - Директория с модулем API.
        Все методы реализованы в контроллере V1Controller.
    
    
    
    
