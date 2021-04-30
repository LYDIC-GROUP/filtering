<?php
/**
 * Created by PhpStorm.
 * User: Willem
 * Date: 2/24/2021
 * Time: 11:32 PM
 */
namespace LydicGroup\Filtering;

class Filter
{
    private ?string $property;
    private ?string $operator;
    private ?string $value;

    public function __construct()
    {
        $this->property = null;
        $this->operator = null;
        $this->value = null;
    }

    /**
     * @return string
     */
    public function getProperty(): ?string
    {
        return $this->property;
    }

    /**
     * @param string $property
     */
    public function setProperty(?string $property): void
    {
        $this->property = $property;
    }

    /**
     * @return string
     */
    public function getOperator(): ?string
    {
        return $this->operator;
    }

    /**
     * @param string $operator
     */
    public function setOperator(?string $operator): void
    {
        $this->operator = $operator;
    }

    /**
     * @return string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(?string $value): void
    {
        $this->value = $value;
    }
}
