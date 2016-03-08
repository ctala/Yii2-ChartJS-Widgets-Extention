<?php
/**
 * @link 
 * @copyright  
 * @license 
 */

namespace ctala\chartjs;

use yii\web\AssetBundle;

/**
 * @author Cristian Tala Sánchez <yomismo@cristiantala.cl>
 * @since 1.0
 */
class ChartJSAsset extends AssetBundle
{
   
    public $sourcePath = __DIR__;
    
    public $css = [
       
    ];
    public $js = [
        'js/Chart.Bar.js',
        'js/Chart.Core.js',
        'js/Chart.Doughnut.js',
        'js/Chart.Line.js',
        'js/Chart.PolarArea.js',
        'js/Chart.Radar.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}