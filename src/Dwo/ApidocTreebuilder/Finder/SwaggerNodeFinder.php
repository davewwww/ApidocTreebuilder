<?php

namespace Dwo\ApidocTreebuilder\Finder;

use Dwo\ApidocTreebuilder\Nodes\Swagger\Method;
use Dwo\ApidocTreebuilder\Nodes\Swagger\Parameter;
use Dwo\ApidocTreebuilder\Nodes\Swagger\Path;
use Dwo\ApidocTreebuilder\Nodes\Swagger\Response;
use Dwo\ApidocTreebuilder\Nodes\Swagger\Root;

/**
 * Class SwaggerNodeFinder
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
class SwaggerNodeFinder
{
    /**
     * @param string $pathStr
     * @param Root   $root
     *
     * @return Path
     */
    public function findOrCreatePath($pathStr, Root $root)
    {
        if (!isset($root->paths[$pathStr])) {
            $root->addPath($pathStr, new Path());
        }

        return $root->paths[$pathStr];
    }

    /**
     * @param string $methodStr
     * @param Path   $path
     *
     * @return Method
     */
    public function findOrCreateMethod($methodStr, Path $path)
    {
        $methodStr = strtolower($methodStr);

        if (!isset($path->methods[$methodStr])) {
            $path->addMethod($methodStr, new Method());
        }

        return $path->methods[$methodStr];
    }

    /**
     * @param string $name
     * @param string $in
     * @param Method $method
     *
     * @return Parameter
     */
    public function findOrCreateParameter($name, $in, Method $method)
    {
        foreach ($method->parameters as $paramter) {
            if ($name === $paramter->name && $in === $paramter->in) {
                return $paramter;
            }
        }

        $method->parameters[] = $parameters = new Parameter($name, $in);

        return $parameters;
    }

    /**
     * @param int    $statusCode
     * @param Method $method
     *
     * @return Response
     */
    public function findOrCreateResponse($statusCode, Method $method)
    {
        if (!isset($method->responses[$statusCode])) {
            $method->addResponse($statusCode, new Response());
        }

        return $method->responses[$statusCode];
    }
}