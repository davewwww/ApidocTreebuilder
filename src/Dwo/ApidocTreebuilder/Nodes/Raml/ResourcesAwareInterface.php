<?php

namespace Dwo\ApidocTreebuilder\Nodes\Raml;

use Dwo\ApidocTreebuilder\Nodes\Raml\Resource as RamlResource;

/**
 * Class Method
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
interface ResourcesAwareInterface
{
    /**
     * @return Resource[]
     */
    public function getResources();

    /**
     * @param string $key
     *
     * @return Resource|null
     */
    public function getResource($key);

    /**
     * @param string       $key
     * @param RamlResource $node
     */
    public function addResource($key, RamlResource $node);
}