<?php

namespace FChandy;

use SimpleDOM\SimpleDOM;

/**
 *
 * @author chente
 */
class Chart
{
    /**
     *
     * @var array
     */
    private $sets = array();

    /**
     *
     * @var array
     */
    private $trendlines = array();

    /**
     *
     * @var array
     */
    private $attributes = array();

    /**
     *
     * @param string $caption
     * @param string $xAxisName
     * @param string $yAxisName
     * @param array $attributes
     */
    public function __construct($caption = '', $xAxisName = '', $yAxisName = '', array $attributes = array()){
        $this->attributes['caption'] = $caption;
        $this->attributes['xAxisName'] = $xAxisName;
        $this->attributes['yAxisName'] = $yAxisName;
        $this->attributes = array_merge($this->attributes, $attributes);
    }

    /**
     *
     * @param string $value
     * @param string $label
     * @param array $attributes
     */
    public function addSet($value, $label = '', $attributes = array()){
        $this->sets[] = array(
            'attributes' => array_merge(array(
                'label' => $label,
                'value' => $value,
             ), $attributes)
        );
    }

    public function addTrendline($startValue, $displayvalue = '', array $attributes){
        $this->trendlines[] = array(
            'attributes' => array_merge(array(
                'startValue' => $startValue,
                'displayvalue' => $displayvalue,
             ), $attributes)
        );
    }

    /**
     *
     * @return string
     */
    public function buildXml(){
        return $this->buildSimpleDom()->getDOMDocument()->saveXML();
    }

    /**
     *
     * @return \SimpleDOM\SimpleDOM
     */
    public function buildSimpleDom(){
        $simpledom  = new SimpleDOM('1.0');
        $chart = $simpledom->element('chart', $this->attributes);

        foreach ($this->sets as $set){
            $chart->element('set', $set['attributes']);
        }

        if( count($this->trendlines) ){
            $trendlines = $chart->element('trendLines');
            foreach ($this->trendlines as $trendline){
                $trendlines->element('line', $trendline['attributes']);
            }
        }

        return $simpledom;
    }

}
