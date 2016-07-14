<?php

namespace Dwo\ApidocTreebuilder\Nodes\Swagger;

use Dwo\ApidocTreebuilder\Nodes\NodeInterface;

/**
 * Class Parameter
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
     * @var string (formData|path|header|query)
     */
    public $in;
    /**
     * @var string
     */
    public $description;
    /**
     * @var string
     */
    public $required = false;
    /**
     * @var string
     */
    public $type;
    /**
     * @var string
     */
    public $example;

    /**
     * @param string $name
     * @param string $in
     */
    public function __construct($name, $in)
    {
        $this->name = $name;
        $this->in = $in;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            "name"        => $this->name,
            "in"          => $this->in,
            "description" => $this->description,
            "required"    => $this->required,
            #"example"     => $this->example,
            "type"        => 'string', #gettype($this->example),
        );
    }
}