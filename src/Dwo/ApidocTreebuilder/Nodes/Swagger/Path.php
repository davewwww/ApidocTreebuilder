<?php

namespace Dwo\ApidocTreebuilder\Nodes\Swagger;

use Dwo\ApidocTreebuilder\Nodes\NodeInterface;

/**
 * Class Path
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
class Path implements NodeInterface
{
    /**
     * @var Method[]
     */
    public $methods;

    /**
     * @param string $key
     *
     * @return Resource|null
     */
    public function getMethod($key)
    {
        return isset($this->methods[$key]) ? $this->methods[$key] : null;
    }

    /**
     * @param string $key
     * @param Method $node
     */
    public function addMethod($key, Method $node)
    {
        $this->methods[$key] = $node;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->methods;
    }
}