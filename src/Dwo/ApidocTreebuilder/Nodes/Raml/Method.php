<?php

namespace Dwo\ApidocTreebuilder\Nodes\Raml;

use Dwo\ApidocTreebuilder\Nodes\NodeInterface;

/**
 * Class Method
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
class Method implements BodiesAwareInterface, NodeInterface
{
    use BodiesAware;

    /**
     * @var string
     */
    public $method;
    /**
     * @var string
     */
    public $description;

    /**
     * @var Parameter[]
     */
    public $headers;

    /**
     * @var Parameter[]
     */
    public $queryParameters;

    /**
     * @var Response[]
     */
    public $responses;

    /**
     * @param string $method
     */
    function __construct($method)
    {
        $this->method = $method;
    }

    /**
     * @param string $key
     *
     * @return Response|null
     */
    public function getResponse($key)
    {
        return isset($this->responses[$key]) ? $this->responses[$key] : null;
    }

    /**
     * @param string   $key
     * @param Response $x
     */
    public function addResponse($key, Response $x)
    {
        $this->responses[$key] = $x;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $return = [];

        if (null !== $this->queryParameters) {
            foreach ($this->queryParameters as $key => $parameter) {
                $return["queryParameters"][$key] = $parameter;
            }
        }

        if (null !== $this->bodies) {
            $body = [];
            foreach ($this->bodies as $k => $v) {
                $body[$k] = $v;
            }

            if (!empty($body)) {
                $return["body"] = $body;
            }
        }

        if (null !== $this->responses) {
            $responses = [];
            foreach ($this->responses as $statusCode => $response) {
                $responses[$statusCode] = array("body" => $response);
            }
            $return["responses"] = $responses;
        }

        return $return;
    }
}