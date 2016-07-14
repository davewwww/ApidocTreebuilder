<?php

namespace Dwo\ApidocTreebuilder\Nodes\Raml;

use Dwo\ApidocTreebuilder\Nodes\NodeInterface;

/**
 * Class Method
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
class Response implements BodiesAwareInterface, NodeInterface
{
    use BodiesAware;

    /**
     * @var string
     */
    public $statusCode;

    /**
     * @param string $statusCode
     */
    function __construct($statusCode)
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $res = [];
        if (null !== $this->bodies) {
            foreach ($this->bodies as $k => $v) {
                $res[$k] = $v;
            }
        }

        return $res;
    }

}