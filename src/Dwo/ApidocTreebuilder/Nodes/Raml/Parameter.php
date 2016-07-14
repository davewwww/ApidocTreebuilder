<?php

namespace Dwo\ApidocTreebuilder\Nodes\Raml;

use Dwo\ApidocTreebuilder\Nodes\NodeInterface;

/**
 * Class Method
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
class Parameter implements NodeInterface
{
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $description;
    /**
     * @var string
     */
    public $type;
    /**
     * @var string
     */
    public $example;

    function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            "example" => $this->example,
            "type"    => gettype($this->example),
        );
    }
}