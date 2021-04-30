<?php
/**
 * Created by PhpStorm.
 * User: Willem
 * Date: 2/24/2021
 * Time: 11:29 PM
 */
namespace LydicGroup\Filtering;

class FilterSyntaxTree
{
    private array $nodes;

    /**
     * AST constructor.
     * @param array $nodes
     */
    public function __construct()
    {
        $this->nodes = [];
    }

    public function addNode($node): self {
        $this->nodes[] = $node;

        return $this;
    }

    /**
     * @return array
     */
    public function getNodes(): array
    {
        return $this->nodes;
    }

    /**
     * @param array $nodes
     */
    public function setNodes(array $nodes): self
    {
        $this->nodes = $nodes;

        return $this;
    }
}
