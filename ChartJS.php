<?php

namespace ctala\chartjs;

use ctala\chartjs\ChartJSAsset;
use \yii\web\View;

/**
 * This is just an example.
 */
class ChartJS extends \yii\base\Widget {

    public $chartType = "bar";
    public $titulo = "Mi Super Titulo";
    public $style = "";
    public $id = "canvas";
    public $class = "col-md-12";
    public $height = 0;
    public $width = 0;
    public $labels = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    public $data = array();
    public $responsive = true;

    public function run() {
        ChartJSAsset::register($this->view);

        $myDiv = "<div class='row'>" .
                "<div class='panel panel-default'>"
                . "<div class='panel-heading'>$this->titulo</div>"
                . "<div class='panel-body'>"
                . "<div class='$this->class' style='$this->style'>";
        if (isset($this->height) && isset($this->width) && $this->height != 0 && $this->width != 0) {
            $myDiv.="<canvas id='$this->id' height='$this->height' width='$this->width'></canvas>";
        } else {
            $myDiv.="<canvas id='$this->id'></canvas>";
        }
        $myDiv.="
		</div>
                </div>
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
            //We use 200 because 255 is white.
            $colorBase = intval(200 / $tamano * $cantidad);
            $datasets[] = array(
                "label" => $key,
                "fillColor" => "rgba($colorBase,150,100,0.5)",
                "strokeColor" => "rgba( $colorBase ,150,100,0.8)",
                "highlightFill" => "rgba($colorBase,150,100,0.75)",
                "highlightStroke" => "rgba($colorBase,150,100,1)",
                "data" => $data
            );
            $cantidad++;
        }

        $barChartData = "barChartData".  $this->id;

        $script = '
            
            var '.$barChartData.' = {
		labels : ' . json_encode($this->labels) . ',
		datasets : ' . json_encode($datasets) . '
	}
	addLoadEvent(function(){
		var ctx = document.getElementById("' . $this->id . '").getContext("2d");
		window.myBar = new Chart(ctx).Bar('.$barChartData.', {
			responsive : ' . $this->responsive . '
		});
	})';
        $this->getView()->registerJs($script, View::POS_END, 'ctala-chartjs-bar-' . $this->id);
    }

}
