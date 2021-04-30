<?php
/**
 * Created by PhpStorm.
 * User: Willem Turkstra
 * Date: 2/24/2021
 * Time: 11:29 PM
 */
namespace LydicGroup\Filtering;

class ExpressionParser
{
    private ExpressionLexer $lexer;

    /**
     * QueryFilterParser constructor.
     *
     * @param ExpressionLexer $lexer
     */
    public function __construct(ExpressionLexer $lexer)
    {
        $this->lexer = $lexer;
    }

    public function parse(string $expression): FilterSyntaxTree
    {
        $this->lexer->setInput($expression);
        $this->lexer->moveNext();

        $fst = $this->build(new FilterSyntaxTree());

        return $fst;
    }

    private function build($root) {

        $lastFilter = null;
        while ($this->lexer->lookahead !== null) {
            $this->lexer->moveNext();
            if ($this->lexer->token === null)
                continue;

            if ($this->lexer->token['type'] == ExpressionLexer::FILTER_PROPERTY) {
                $lastFilter = new Filter();
                $lastFilter->setProperty($this->lexer->token['value']);
            } elseif (in_array($this->lexer->token['type'], ExpressionLexer::OPERATORS)) {
                $lastFilter->setOperator($this->lexer->token['value']);
            } elseif ($this->lexer->token['type'] == ExpressionLexer::FILTER_VALUE) {
                $lastFilter->setValue($this->lexer->token['value']);

                //If next value also is a value then a weird query is being given
                if($this->lexer->isNextToken(ExpressionLexer::FILTER_VALUE)) {
                    $this->lexer->moveNext();
                }

                $root->addNode($lastFilter);
            }

            elseif ($this->lexer->token['type'] == ExpressionLexer::LOGIC_OPERATOR) {
                $logicOperator = new FilterLogicOperator();
                $logicOperator->setOperator($this->lexer->token['value']);
                $root->addNode($logicOperator);
            } elseif($this->lexer->token['type'] == ExpressionLexer::GROUP_START) {
                $group = $this->build(new FilterGroup());
                $root->addNode($group);
            } elseif($this->lexer->token['type'] == ExpressionLexer::GROUP_END) {
                return $root;
            }
        }

        return $root;
    }
}