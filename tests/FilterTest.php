<?php
/**
 * Created by PhpStorm.
 * User: Willem Turkstra
 * Date: 4/30/2021
 * Time: 8:24 PM
 */
namespace LydicGroup\Filtering\Tests;

use LydicGroup\Filtering\Filter;
use PHPUnit\Framework\TestCase;

class FilterTest extends TestCase
{
    /**
     * @covers \LydicGroup\Filtering\Filter
     */
    public function testFilter()
    {
        $filter = new Filter();
        $filter->setProperty('name');
        $filter->setOperator('eq');
        $filter->setValue('willem');

        $this->assertEquals('name', $filter->getProperty());
        $this->assertEquals('eq', $filter->getOperator());
        $this->assertEquals('willem', $filter->getValue());
    }
}
