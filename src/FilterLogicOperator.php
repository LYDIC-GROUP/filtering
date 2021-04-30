<?php
/**
 * Created by PhpStorm.
 * User: Willem
 * Date: 2/24/2021
 * Time: 11:44 PM
 */

namespace LydicGroup\Filtering;


class FilterLogicOperator
{
    protected string $operator;

    /**
     * @return string
     */
    public function getOperator(): string
    {
        return $this->operator;
    }

    /**
     * @param string $operator
     */
    public function setOperator(string $operator): void
    {
        $this->operator = $operator;
    }
}