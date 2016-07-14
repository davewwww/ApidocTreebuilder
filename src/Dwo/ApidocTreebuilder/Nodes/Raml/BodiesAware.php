<?php

namespace Dwo\ApidocTreebuilder\Nodes\Raml;

/**
 * Class Method
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
trait BodiesAware
{
    /**
     * @var Body[]
     */
    public $bodies;

    /**
     * @param string $key
     *
     * @return Body|null
     */
    public function getBody($key)
    {
        return isset($this->bodies[$key]) ? $this->bodies[$key] : null;
    }

    /**
     * @param      $key
     * @param Body $x
     */
    public function addBody($key, Body $x)
    {
        $this->bodies[$key] = $x;
    }
}