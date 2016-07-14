<?php

namespace Dwo\ApidocTreebuilder\Nodes\Swagger;

use Dwo\ApidocTreebuilder\Nodes\NodeInterface;

/**
 * Class Method
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
class Method implements NodeInterface
{
    /**
     * @var string
     */
    public $summary;

    /**
     * @var string
     */
    public $description;

    /**
     * @var Parameter[]
     */
    public $parameters = [];

    /**
     * @var array
     */
    public $tags;

    /**
     * @var Response[]
     */
    public $responses = [];

    /**
     * @param Parameter $parameter
     */
    public function addParameter(Parameter $parameter)
    {
        $this->parameters[] = $parameter;
    }

    /**
     * @param string   $statusCode
     * @param Response $responses
     */
    public function addResponse($statusCode, Response $responses)
    {
        $this->responses[$statusCode] = $responses;
    }

    function toArray()
    {
        $return = array(
            'summary'     => $this->summary,
            'description' => $this->description,
            'parameters'  => $this->parameters,
            #'security'        => $this->security,
            'tags'        => $this->tags,
            'responses'   => $this->responses,
        );

        if (empty($this->parameters)) {
            unset($return['parameters']);
        }

        return $return;
    }

}