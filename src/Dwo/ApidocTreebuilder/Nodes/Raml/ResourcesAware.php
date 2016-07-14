<?php

namespace Dwo\ApidocTreebuilder\Nodes\Raml;

/**
 * Class Method
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
trait ResourcesAware
{
    /**
     * @var Resource[]
     */
    public $resources;

    /**
     * @return Resource[]
     */
    public function getResources()
    {
        return $this->resources;
    }

    /**
     * @param string $key
     *
     * @return Resource|null
     */
    public function getResource($key)
    {
        return isset($this->resources[$key]) ? $this->resources[$key] : null;
    }

    /**
     * @param string   $key
     * @param Resource $node
     */
    public function addResource($key, Resource $node)
    {
        $this->resources[$key] = $node;
    }
}