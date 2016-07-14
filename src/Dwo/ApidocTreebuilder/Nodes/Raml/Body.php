<?php

namespace Dwo\ApidocTreebuilder\Nodes\Raml;

use Dwo\ApidocTreebuilder\Nodes\NodeInterface;

/**
 * Class Body
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
class Body implements NodeInterface
{
    /**
     * @var string
     */
    public $contentType;
    /**
     * @var Parameter[]
     */
    public $formParameters;
    /**
     * @var string
     */
    public $example;

    /**
     * @param $contentType
     */
    function __construct($contentType)
    {
        $this->contentType = $contentType;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $return = [];

        if (!empty($this->formParameters)) {
            $return["formParameters"] = $this->formParameters;
        }
        if (!empty($this->example)) {
            $return["example"] = $this->example;
        }

        return $return;
    }
}