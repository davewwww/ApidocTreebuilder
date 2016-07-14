<?php

namespace Dwo\ApidocTreebuilder\Nodes\Raml;

use Dwo\ApidocTreebuilder\Nodes\NodeInterface;

/**
 * Class Method
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
class Resource implements ResourcesAwareInterface, NodeInterface
{
    use ResourcesAware;

    /**
     * @var string
     */
    public $name;
    /**
     * @var Method[]
     */
    public $methods;

    /**
     * @param string $name
     */
    function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

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
        $res = [];
        if (null !== $this->resources) {
            foreach ($this->resources as $k => $v) {
                $res[$k] = $v;
            }
        }
        if (null !== $this->methods) {
            foreach ($this->methods as $k => $v) {
                $res[$k] = $v;
            }
        }

        return $res;
    }
}