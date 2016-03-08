Yii2 ChartJS Widget
===================
An extention that helps create beautifull charts using ChartJS

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist ctala/yii2-ctala-chartjs "*"
```

or add

```
"ctala/yii2-ctala-chartjs": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?

echo \ctala\chartjs\ChartJS::widget([
    "data" => $datosAno2016,
    "responsive" => "false",
    "titulo" => "Ventas Sitios 2016",
    "id" => "canvas2016",
    "height" => 500,
    "width" => 1000,
        ]
);
echo \ctala\chartjs\ChartJS::widget([
    "data" => $datosAno2015,
    "responsive" => "false",
    "titulo" => "Ventas Sitios 2015",
    "id" => "canvas2015",
    "height" => 500,
    "width" => 1000,
    "chartType" => "line"
        ]
);

?>```