<?php

namespace Dwo\ApidocTreebuilder\Treebuilder;

use Dwo\ApidocTreebuilder\Finder\SwaggerNodeFinder;
use Dwo\ApidocTreebuilder\Nodes\Swagger\Method;
use Dwo\ApidocTreebuilder\Nodes\Swagger\Root;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SwaggerTreebuilder
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
class SwaggerTreebuilder
{
    /**
     * @var Root;
     */
    protected $root;

    /**
     * @var SwaggerNodeFinder;
     */
    protected $nodeFinder;

    /**
     * @param string                 $rootPath
     * @param SwaggerNodeFinder|null $nodeFinder
     */
    function __construct($rootPath = "/", SwaggerNodeFinder $nodeFinder = null)
    {
        $this->root = new Root();
        $this->nodeFinder = $nodeFinder ?: new SwaggerNodeFinder();
    }

    /**
     * @return Root
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param Method   $method
     */
    public function addContentToMethod(Request $request, Response $response, Method $method)
    {
        /**
         * add query Parameter
         */
        foreach ($request->query->all() as $name => $value) {
            $parameter = $this->nodeFinder->findOrCreateParameter($name, 'query', $method);
            if (null === $parameter->description) {
                $parameter->description = 'Example: '.$value;
            }
        }

        /**
         * add formData Parameter
         */
        foreach ($request->request->all() as $name => $value) {
            $parameter = $this->nodeFinder->findOrCreateParameter($name, 'formData', $method);
            if (null === $parameter->description) {
                $parameter->description = 'Example: '.$value;
            }
        }

        /**
         * add responses
         */
        $responseNode = $this->nodeFinder->findOrCreateResponse($response->getStatusCode(), $method);
        if (null === $responseNode->description) {
            $responseNode->description = 'Example: '.$response->getContent();
        }
    }

    /**
     * @param string $title
     * @param string $baseUri
     * @param string $version
     */
    public function addInfos($title = '', $baseUri = '', $version = '')
    {
        $root = $this->getRoot();

        if (null !== $title) {
            $root->info->title = $title;
        }
        if (null !== $version) {
            $root->info->version = $version;
        }

        $parsed = parse_url($baseUri);
        $root->host = $parsed['host'];
    }
}