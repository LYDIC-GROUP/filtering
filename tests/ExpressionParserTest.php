<?php
/**
 * Created by PhpStorm.
 * User: Willem Turkstra
 * Date: 4/30/2021
 * Time: 9:23 PM
 */
namespace LydicGroup\Filtering\Tests;

use LydicGroup\Filtering\ExpressionLexer;
use LydicGroup\Filtering\ExpressionParser;
use PHPUnit\Framework\TestCase;

class ExpressionParserTest extends TestCase
{
    /**
     * @covers \LydicGroup\Filtering\ExpressionParser
     */
    public function testExpressionParserBasic()
    {
        $expression = 'name:eq:willem';

        $nodes = $this->getFstNodes($expression);

        $this->assertCount(1, $nodes);

        $this->assertEquals('name', $nodes[0]->getProperty());
        $this->assertEquals('eq', $nodes[0]->getOperator());
        $this->assertEquals('willem', $nodes[0]->getValue());
    }

    /**
     * @covers \LydicGroup\Filtering\ExpressionParser
     */
    public function testExpressionLexerAdvanced()
    {
        $expression = 'name:eq:willem AND age:gt:10';

        $nodes = $this->getFstNodes($expression);

        $this->assertCount(3, $nodes);
        $this->assertEquals('name', $nodes[0]->getProperty());
        $this->assertEquals('eq', $nodes[0]->getOperator());
        $this->assertEquals('willem', $nodes[0]->getValue());
        $this->assertEquals('AND', $nodes[1]->getOperator());
        $this->assertEquals('age', $nodes[2]->getProperty());
        $this->assertEquals('gt', $nodes[2]->getOperator());
        $this->assertEquals('10', $nodes[2]->getValue());
    }

    /**
     * @covers \LydicGroup\Filtering\ExpressionParser
     */
    public function testExpressionLexerAdvancedGrouping()
    {
        $expression = 'name:eq:willem AND (age:gt:10 OR city:neq:Amsterdam)';

        $nodes = $this->getFstNodes($expression);

        $this->assertCount(3, $nodes);
        $this->assertEquals('name', $nodes[0]->getProperty());
        $this->assertEquals('eq', $nodes[0]->getOperator());
        $this->assertEquals('willem', $nodes[0]->getValue());
        $this->assertEquals('AND', $nodes[1]->getOperator());

        $groupNodes = $nodes[2]->getNodes();
        $this->assertCount(3, $groupNodes);
        $this->assertEquals('age', $groupNodes[0]->getProperty());
        $this->assertEquals('gt', $groupNodes[0]->getOperator());
        $this->assertEquals('10', $groupNodes[0]->getValue());

        $this->assertEquals('OR', $groupNodes[1]->getOperator());

        $this->assertEquals('city', $groupNodes[2]->getProperty());
        $this->assertEquals('neq', $groupNodes[2]->getOperator());
        $this->assertEquals('Amsterdam', $groupNodes[2]->getValue());
    }

    /**
     * @param string $expression
     * @return array
     */
    private function getFstNodes(string $expression): array
    {
        $lexer = new ExpressionLexer();
        $parser = new ExpressionParser($lexer);
        $fst = $parser->parse($expression);
        return $fst->getNodes();
    }
}
