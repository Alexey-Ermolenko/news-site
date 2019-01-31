<p align="center">
    <h1 align="center">Простой новостной сайт на Yii2 framework</h1>
    <br>
</p>
<small>Создан на Yii 2.0.14</small>

Требования
------------

apache-2.4

php-7.1.22

Mysql-8.0


Установка
------------

1) win + R (cmd)
2) `cd D:\localhost\yii.local` - каталог сайта
3) `git clone https://github.com/Alexey-Ermolenko/news-site.git`
4) залить дамп c тестовыми данными файл `yii_local.sql` имя бд yii_local


Конфигурация
-------------

### База данных

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii_local',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
];
```