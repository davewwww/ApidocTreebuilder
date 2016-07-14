<?php

namespace Dwo\ApidocTreebuilder\Nodes\Raml;

/**
 * Class Method
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
interface BodiesAwareInterface
{
    /**
     * @param string $key
     *
     * @return Body|null
     */
    public function getBody($key);

    /**
     * @param      $key
     * @param Body $x
     */
    public function addBody($key, Body $x);
}