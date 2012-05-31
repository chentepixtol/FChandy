<?php

namespace Test\Unit;

use FChandy\Chart;

/**
 *
 * @author chente
 *
 */
class ChartTest extends BaseTest
{

    /**
     * @test
     */
    public function construct(){
        $chart = new Chart("My Chart", "X", "Y", array(
            "labelDisplay" => "Rotate",
            "slantLabels"=> "0",
        ));
        $this->assertEquals('<?xml version="1.0"?><chart caption="My Chart" xAxisName="X" yAxisName="Y" labelDisplay="Rotate" slantLabels="0"></chart>',
                $this->inline($chart->buildXml()));
    }

    /**
     * @test
     */
    public function set(){
        $chart = new Chart();
        $chart->addSet(600, 'php');
        $chart->addSet(700, 'scala');
        $this->assertEquals('<?xml version="1.0"?><chart caption="" xAxisName="" yAxisName=""><set label="php" value="600"></set><set label="scala" value="700"></set></chart>',
                $this->inline($chart->buildXml()));
    }

    /**
     * @test
     */
    public function trendline(){
       $chart = new Chart();
       $chart->addTrendline(1000, 'millar', array('color' => 'FF0044'));
       $this->assertEquals('<?xml version="1.0"?><chart caption="" xAxisName="" yAxisName=""><trendLines><line startValue="1000" displayvalue="millar" color="FF0044"></line></trendLines></chart>',
               $this->inline($chart->buildXml()));
    }

    /**
     * @test
     */
    public function categories(){
        $chart = new Chart();
        $chart->addCategory('Jan');
        $chart->addCategory('Feb');
        $this->assertEquals('<?xml version="1.0"?><chart caption="" xAxisName="" yAxisName=""><categories><category label="Jan"></category><category label="Feb"></category></categories></chart>',
                $this->inline($chart->buildXml()));
    }

    /**
     * @test
     */
    public function datasets(){
        $chart = new Chart();
        $chart->addDataset("2012", array(1,2,3));
        $chart->addDataset("2013", array(2,4,6));
        $this->assertEquals('<?xml version="1.0"?><chart caption="" xAxisName="" yAxisName=""><dataset seriesName="2012"><set value="1"></set><set value="2"></set><set value="3"></set></dataset><dataset seriesName="2013"><set value="2"></set><set value="4"></set><set value="6"></set></dataset></chart>',
                $this->inline($chart->buildXml()));
    }

}

