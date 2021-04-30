<?php
/**
 * Created by PhpStorm.
 * User: Willem Turkstra
 * Date: 4/30/2021
 * Time: 9:23 PM
 */
namespace LydicGroup\Filtering\Tests;

use LydicGroup\Filtering\ExpressionLexer;
use PHPUnit\Framework\TestCase;

class ExpressionLexerTest extends TestCase
{
    /**
     * @covers \LydicGroup\Filtering\ExpressionLexer
     */
    public function testExpressionLexerBasic()
    {
        $expression = 'name:eq:willem';

        $tokens = $this->getTokens($expression);

        $this->assertCount(3, $tokens);
        $this->assertEquals('name', $tokens[0]['value']);
        $this->assertEquals('eq', $tokens[1]['value']);
        $this->assertEquals('willem', $tokens[2]['value']);

        $this->assertEquals(100, $tokens[0]['type']);
        $this->assertEquals(0, $tokens[1]['type']);
        $this->assertEquals(200, $tokens[2]['type']);
    }

    /**
     * @covers \LydicGroup\Filtering\ExpressionLexer
     */
    public function testExpressionLexerAdvanced()
    {
        $expression = 'name:eq:willem AND age:gt:10';

        $tokens = $this->getTokens($expression);

        $this->assertCount(7, $tokens);
        $this->assertEquals('name', $tokens[0]['value']);
        $this->assertEquals('eq', $tokens[1]['value']);
        $this->assertEquals('willem', $tokens[2]['value']);
        $this->assertEquals('AND', $tokens[3]['value']);
        $this->assertEquals('age', $tokens[4]['value']);
        $this->assertEquals('gt', $tokens[5]['value']);
        $this->assertEquals('10', $tokens[6]['value']);

        $this->assertEquals(100, $tokens[0]['type']);
        $this->assertEquals(0, $tokens[1]['type']);
        $this->assertEquals(200, $tokens[2]['type']);
        $this->assertEquals(50, $tokens[3]['type']);
        $this->assertEquals(100, $tokens[4]['type']);
        $this->assertEquals(2, $tokens[5]['type']);
        $this->assertEquals(200, $tokens[6]['type']);
    }

    /**
     * @covers \LydicGroup\Filtering\ExpressionLexer
     */
    public function testExpressionLexerAdvancedGrouping()
    {
        $expression = 'name:eq:willem AND (age:gt:10 OR city:neq:Amsterdam)';

        $tokens = $this->getTokens($expression);

        $this->assertCount(13, $tokens);
        $this->assertEquals('name', $tokens[0]['value']);
        $this->assertEquals('eq', $tokens[1]['value']);
        $this->assertEquals('willem', $tokens[2]['value']);
        $this->assertEquals('AND', $tokens[3]['value']);
        $this->assertEquals('(', $tokens[4]['value']);
        $this->assertEquals('age', $tokens[5]['value']);
        $this->assertEquals('gt', $tokens[6]['value']);
        $this->assertEquals('10', $tokens[7]['value']);
        $this->assertEquals('OR', $tokens[8]['value']);
        $this->assertEquals('city', $tokens[9]['value']);
        $this->assertEquals('neq', $tokens[10]['value']);
        $this->assertEquals('Amsterdam', $tokens[11]['value']);
        $this->assertEquals(')', $tokens[12]['value']);

        $this->assertEquals(100, $tokens[0]['type']);
        $this->assertEquals(0, $tokens[1]['type']);
        $this->assertEquals(200, $tokens[2]['type']);
        $this->assertEquals(50, $tokens[3]['type']);
        $this->assertEquals(300, $tokens[4]['type']);
        $this->assertEquals(100, $tokens[5]['type']);
        $this->assertEquals(2, $tokens[6]['type']);
        $this->assertEquals(200, $tokens[7]['type']);
        $this->assertEquals(50, $tokens[8]['type']);
        $this->assertEquals(100, $tokens[9]['type']);
        $this->assertEquals(1, $tokens[10]['type']);
        $this->assertEquals(200, $tokens[11]['type']);
        $this->assertEquals(310, $tokens[12]['type']);
    }

    /**
     * @param ExpressionLexer $lexer
     * @return array
     */
    private function getTokens(string $expression): array
    {
        $lexer = new ExpressionLexer();
        $lexer->setInput($expression);
        $lexer->moveNext();

        $tokens = [];
        while (true) {
            if (!$lexer->lookahead) {
                break;
            }

            $lexer->moveNext();

            $tokens[] = $lexer->token;
        }
        return $tokens;
    }
}
