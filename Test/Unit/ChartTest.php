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

}

