1) win + R (cmd)
2) cd D:\OSPanel\domains\yii.local
3) composer create-project --prefer-dist yiisoft/yii2-app-basic basic
4) Убираем web из адресной строки при помощи https://github.com/ilopX/yii2-basic-htaccess
composer require ilopx/yii2-basic-htaccess

---

5) вывод в админке новостей
6) вывод в админке категорий


7) вывод в главной странице
8) комментарии к новости


https://toster.ru/q/158061



$dataProvider = new ActiveDataProvider([
    'query' => News::find()->where(['visibility'=>1])->orderBy('date DESC'),
    'pagination' => [
        'pageSize' => 20,
    ],
]);