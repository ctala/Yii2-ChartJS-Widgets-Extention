<?php

namespace ctala\chartjs;

use ctala\chartjs\ChartJSAsset;
use \yii\web\View;
/**
 * This is just an example.
 */
class AutoloadExample extends \yii\base\Widget {

    public $chartType = "bar";
    public $style = "width: 50%";
    public $id = "canvas";
    public $height = 450;
    public $width = 650;
    
    public $labels = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    public $data = array(
        array(25, 345, 452, 1, 45, 6, 2, 6, 12, 6), array(1, 2, 3, 4, 5, 6, 7, 8, 9, 0),
    );

    public function run() {
        ChartJSAsset::register($this->view);

        $myDiv = "<div style='$this->style'>
			<canvas id='$this->id' height='$this->height' width='$this->width'></canvas>
		</div>";

        echo $myDiv;

        switch ($this->chartType) {
            case "bar":
                $this->generateBar();

                break;

            default:
                break;
        }
        return "Hello!";
    }

    function generateBar() {
        $script = '
            var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
            var barChartData = {
		labels : ["January","February","March","April","May","June","July"],
		datasets : [
			{
				fillColor : "rgba(220,220,220,0.5)",
				strokeColor : "rgba(220,220,220,0.8)",
				highlightFill: "rgba(220,220,220,0.75)",
				highlightStroke: "rgba(220,220,220,1)",
				data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
			},
			{
				fillColor : "rgba(151,187,205,0.5)",
				strokeColor : "rgba(151,187,205,0.8)",
				highlightFill : "rgba(151,187,205,0.75)",
				highlightStroke : "rgba(151,187,205,1)",
				data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
			}
		]
	}
	window.onload = function(){
		var ctx = document.getElementById("canvas").getContext("2d");
		window.myBar = new Chart(ctx).Bar(barChartData, {
			responsive : true
		});
	}';
        $this->getView()->registerJs($script, View::POS_END, 'ctala-chartjs-bar');
    }

    function js_array($array) {
        $temp = array_map('js_str', $array);
        return '[' . implode(',', $temp) . ']';
    }

}
