<?php
/**
 * Created by PhpStorm.
 * User: Willem
 * Date: 2/23/2021
 * Time: 7:34 PM
 */
namespace LydicGroup\Filtering;

use Doctrine\Common\Lexer\AbstractLexer;

class ExpressionLexer extends AbstractLexer
{
    const OP_EQUALS = 0;
    const OP_NOT_EQUALS = 1;
    const OP_GREATER_THEN = 2;
    const OP_LESS_THEN = 3;
    const OP_GREATER_THEN_EQUALS = 4;
    const OP_LESS_THEN_EQUALS = 5;
    const OP_LIKE = 6;

    const LOGIC_OPERATOR = 50;

    const FILTER_PROPERTY = 100;
    const FILTER_VALUE = 200;

    const GROUP_START = 300;
    const GROUP_END = 310;

    const OPERATORS = [
        0, 1, 2, 3, 4, 5, 6
    ];

    protected function getCatchablePatterns()
    {
        return [
            /* PROPERTIES */ "(?<=\s|^|\()[a-zA-Z0-9_.]*:", //every string starting with a space or is the start of the string //The property
            /* OPERATORS */ '(?<=:)[a-z]+(?=:)',
            /* Quoted string */ "(?<=:)[a-zA-Z0-9]+(?=\s|$)|'(?:[^']|'')*'",
            /* LOGIC OPERATORS */ '(?<=\s)AND|OR(?=\s+)',
            /* GROUPER */ '(?<=\s)\(|\)(?=$|\s)'
        ];
    }

    protected function getNonCatchablePatterns()
    {
        return [
            ':',
            '\s'
        ];
    }

    protected function getType(&$value)
    {
        if ($value == '(') {
           return self::GROUP_START;
        } elseif ($value == ')') {
            return self::GROUP_END;
        }

        //operators
        switch (true) {
            case $value === 'eq':
                return self::OP_EQUALS;
            case $value === 'neq':
                return self::OP_NOT_EQUALS;
            case $value === 'gt':
                return self::OP_GREATER_THEN;
            case $value === 'lt':
                return self::OP_LESS_THEN;
            case $value === 'gte':
                return self::OP_GREATER_THEN_EQUALS;
            case $value === 'lte':
                return self::OP_LESS_THEN_EQUALS;
            case $value === 'like':
                return self::OP_LIKE;
        }

        if ($value == 'AND' || $value == 'OR') {
           return self::LOGIC_OPERATOR;
        }

        if (substr($value, -1) == ':') {
            $value = substr($value, 0 , -1);
            return self::FILTER_PROPERTY;
        }

        return self::FILTER_VALUE;
    }
}
