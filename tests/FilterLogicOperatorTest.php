<?php
/**
 * Created by PhpStorm.
 * User: Willem Turkstra
 * Date: 4/30/2021
 * Time: 8:24 PM
 */
namespace LydicGroup\Filtering\Tests;

use LydicGroup\Filtering\FilterLogicOperator;
use PHPUnit\Framework\TestCase;

class FilterLogicOperatorTest extends TestCase
{
    /**
     * @covers \LydicGroup\Filtering\FilterLogicOperator
     */
    public function testFilter()
    {
        $filter = new FilterLogicOperator();
        $filter->setOperator('AND');

        $this->assertEquals('AND', $filter->getOperator());
    }
}
