<?php
/**
 * Created by PhpStorm.
 * User: Willem
 * Date: 2/25/2021
 * Time: 12:33 AM
 */

namespace LydicGroup\Filtering;

class FilterGroup
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