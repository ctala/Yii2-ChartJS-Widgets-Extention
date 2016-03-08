<?php

namespace ctala\chartjs;

use ctala\chartjs\ChartJSAsset;

/**
 * This is just an example.
 */
class AutoloadExample extends \yii\base\Widget {

    public function run() {
        ChartJSAsset::register($this);
        return "Hello!";
    }

}
