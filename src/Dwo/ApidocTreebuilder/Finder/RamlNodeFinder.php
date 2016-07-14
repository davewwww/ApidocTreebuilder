<?php

namespace Dwo\ApidocTreebuilder\Finder;

use Dwo\ApidocTreebuilder\Nodes\Raml\BodiesAwareInterface;
use Dwo\ApidocTreebuilder\Nodes\Raml\Body;
use Dwo\ApidocTreebuilder\Nodes\Raml\Method;
use Dwo\ApidocTreebuilder\Nodes\Raml\Resource as RamlResource;
use Dwo\ApidocTreebuilder\Nodes\Raml\ResourcesAwareInterface;
use Dwo\ApidocTreebuilder\Nodes\Raml\Response;
use Dwo\ApidocTreebuilder\Nodes\Raml\Root;

/**
 * Class RamlNodeFinder
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
class RamlNodeFinder
{
    /**
     * @param string $route
     * @param string $methodString
     * @param Root   $rootNode
     *
     * @return Method
     */
    public function getMethod($route, $methodString, Root $rootNode)
    {
        $resource = $this->createOrFindResource($route, $rootNode);

        return $this->createOrFindMethod($methodString, $resource);
    }

    /**
     * @param string $statusCode
     * @param Method $method
     *
     * @return Response
     */
    public function createOrFindResponse($statusCode, Method $method)
    {
        if (null === $response = $method->getResponse($statusCode)) {
            $method->addResponse($statusCode, $response = new Response($statusCode));
        }

        return $response;
    }

    /**
     * @param string               $contentType
     * @param BodiesAwareInterface $bodiesAware
     *
     * @return Body
     */
    public function createOrFindBody($contentType, BodiesAwareInterface $bodiesAware)
    {
        if (null === $body = $bodiesAware->getBody($contentType)) {
            $bodiesAware->addBody($contentType, $body = new Body($contentType));
        }

        return $body;
    }

    /**
     * @param string       $methodName
     * @param RamlResource $resource
     *
     * @return Method
     */
    public function createOrFindMethod($methodName, RamlResource $resource)
    {
        if (null === $method = $resource->getMethod($methodName = strtolower($methodName))) {
            $resource->addMethod($methodName, $method = new Method($methodName));
        }

        return $method;
    }

    /**
     * @param string                  $routePath
     * @param ResourcesAwareInterface $resource
     *
     * @return RamlResource
     */
    public function createOrFindResource($routePath, ResourcesAwareInterface $resource)
    {
        $urlParts = explode("/", $routePath);
        unset($urlParts[0]);

        foreach ($urlParts as $urlPart) {
            $urlPart = "/".$urlPart;

            if (null === $newResource = $resource->getResource($urlPart)) {
                $resource->addResource($urlPart, $newResource = new RamlResource($urlPart));
            }
            $resource = $newResource;
        }

        return $resource;
    }
}