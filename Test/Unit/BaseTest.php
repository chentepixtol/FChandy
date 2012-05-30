<?php

namespace Test\Unit;


/**
 *
 * @author chente
 *
 */
abstract class BaseTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     * @param string $xml
     * @return string
     */
    public function inline($xml){
        return preg_replace('/\n/', '', $xml);
    }

}

