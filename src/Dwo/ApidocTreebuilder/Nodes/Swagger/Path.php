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
        //sort known keys
        $methodKeys = array('get', 'post', 'put', 'patch', 'delete');
        $keys = array_keys($this->methods);
        $intersect = array_values(array_intersect($methodKeys, $keys));

        //sort unknown keys
        if ($diff = array_diff($keys, $methodKeys)) {
            asort($diff);
            $intersect = array_merge($intersect, array_values($diff));
        }

        //sort all keys
        $return = [];
        foreach ($intersect as $method) {
            $return[$method] = $this->methods[$method];
        }

        return $return;
    }
}