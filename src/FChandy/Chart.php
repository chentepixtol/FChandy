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
     * @var unknown_type
     */
    private $attributes = array();

    /**
     *
     * @param unknown_type $caption
     * @param unknown_type $xAxisName
     * @param unknown_type $yAxisName
     * @param array $attributes
     */
    public function __construct($caption = '', $xAxisName = '', $yAxisName = '', array $attributes = array()){
        $this->attributes['caption'] = $caption;
        $this->attributes['xAxisName'] = $xAxisName;
        $this->attributes['yAxisName'] = $yAxisName;
        $this->attributes = array_merge($this->attributes, $attributes);
    }

    public function addSet($value, $label = '', $attributes = array()){
        $attributes['label'] = $label;
        $attributes['value'] = $value;
        $this->sets[] = array(
            'attributes' => $attributes,
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

        return $simpledom;
    }

}
