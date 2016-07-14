<?php

namespace Dwo\ApidocTreebuilder\Nodes\Swagger;

use Dwo\ApidocTreebuilder\Nodes\NodeInterface;

/**
 * Class Response
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
class Response implements NodeInterface
{
    /**
     * @var string
     */
    public $description;

    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            'description' => $this->description,
            #'schema' => $this->schema,
        );
    }

}