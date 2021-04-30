<?php
/**
 * Created by PhpStorm.
 * User: Willem Turkstra
 * Date: 4/30/2021
 * Time: 8:28 PM
 */
namespace LydicGroup\Filtering\Tests;

use LydicGroup\Filtering\FilterGroup;
use PHPUnit\Framework\TestCase;

class FilterGroupTest extends TestCase
{
    /**
     * @covers \LydicGroup\Filtering\FilterGroup
     */
    public function testFilterGroup()
    {
        $filterGroup = new FilterGroup();

        $nodes = $filterGroup->getNodes();
        $this->assertEmpty($nodes);

        $filterGroup->setNodes(['node1', 'node2', 'node3']);
        $nodes = $filterGroup->getNodes();
        $this->assertEquals(['node1', 'node2', 'node3'], $nodes);

        $filterGroup->addNode('node4');
        $nodes = $filterGroup->getNodes();
        $this->assertEquals(['node1', 'node2', 'node3', 'node4'], $nodes);
    }
}
