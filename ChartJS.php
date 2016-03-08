<?php

namespace ctala\chartjs;

use ctala\chartjs\ChartJSAsset;
use \yii\web\View;

/**
 * This is just an example.
 */
class ChartJS extends \yii\base\Widget {

    public $chartType = "bar";
    public $style = "";
    public $id = "canvas";
    public $class = "col-md-12";
    public $height = 450;
    public $width = 650;
    public $labels = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    public $data = array(
        array(25, 35, 52, 1, 45, 6, 2, 6, 12, 6), array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10),
    );
    public $responsive = true;

    public function run() {
        ChartJSAsset::register($this->view);

        $myDiv = "<div class='row'>"
                . "<div class='$this->class' style='$this->style'>
			<canvas id='$this->id' height='$this->height' width='$this->width'></canvas>
		</div> "
                . "</div>";

        echo $myDiv;

        switch ($this->chartType) {
            case "bar":
                $this->generateBar();

                break;

            default:
                break;
        }
    }

    private function generateBar() {


        $datasets = array();
        $cantidad = 1;
        $tamano = count($this->data);
        foreach ($this->data as $key => $data) {
            $colorBase = intval(255 / $tamano * $cantidad);
            $datasets[] = array(
                "label" => $key,
                "fillColor" => "rgba($colorBase,$colorBase,$colorBase,0.5)",
                "strokeColor" => "rgba( $colorBase ,$colorBase,$colorBase,0.8)",
                "highlightFill" => "rgba($colorBase,$colorBase,$colorBase,0.75)",
                "highlightStroke" => "rgba($colorBase,$colorBase,$colorBase,1)",
                "data" => $data
            );
            $cantidad++;
        }

        $script = '
            
            var barChartData = {
		labels : ' . json_encode($this->labels) . ',
		datasets : ' . json_encode($datasets) . '
	}
	window.onload = function(){
		var ctx = document.getElementById("' . $this->id . '").getContext("2d");
		window.myBar = new Chart(ctx).Bar(barChartData, {
			responsive : '. $this->responsive .'
		});
	}';
        $this->getView()->registerJs($script, View::POS_END, 'ctala-chartjs-bar');
    }

}
