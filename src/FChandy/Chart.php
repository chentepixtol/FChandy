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
    private $categories = array();

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
        $this->attributes = array_merge(array(
            'caption' => $caption,
            'xAxisName' => $xAxisName,
            'yAxisName' => $yAxisName,
        ), $attributes);
    }

    /**
     *
     * @param string $value
     * @param string $label
     * @param array $attributes
     */
    public function addSet($value, $label = '', array $attributes = array()){
        $this->sets[] = array_merge(array(
            'label' => $label,
            'value' => $value,
        ), $attributes);
    }

    /**
     *
     * @param string $label
     * @param array $attributes
     */
    public function addCategory($label, array $attributes = array()){
        $this->categories[] = array_merge(array(
            'label' => $label,
        ), $attributes);
    }

    /**
     *
     * @param int $startValue
     * @param string $displayvalue
     * @param array $attributes
     */
    public function addTrendline($startValue, $displayvalue = '', array $attributes = array()){
        $this->trendlines[] = array_merge(array(
            'startValue' => $startValue,
            'displayvalue' => $displayvalue,
        ), $attributes);
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
            $chart->element('set', $set);
        }

        if( count($this->categories) ){
            $categories = $chart->element('categories');
            foreach ($this->categories as $category){
                $categories->element('category', $category);
            }
        }

        if( count($this->trendlines) ){
            $trendlines = $chart->element('trendLines');
            foreach ($this->trendlines as $trendline){
                $trendlines->element('line', $trendline);
            }
        }

        return $simpledom;
    }

}
