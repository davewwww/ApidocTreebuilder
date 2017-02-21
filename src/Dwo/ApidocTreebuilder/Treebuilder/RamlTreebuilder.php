<?php

namespace Dwo\ApidocTreebuilder\Treebuilder;

use Dwo\ApidocTreebuilder\Finder\RamlNodeFinder;
use Dwo\ApidocTreebuilder\Nodes\Raml\Body;
use Dwo\ApidocTreebuilder\Nodes\Raml\Method;
use Dwo\ApidocTreebuilder\Nodes\Raml\Parameter;
use Dwo\ApidocTreebuilder\Nodes\Raml\Response;
use Dwo\ApidocTreebuilder\Nodes\Raml\Root;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

/**
 * Class RamlTreebuilder
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
class RamlTreebuilder
{
    /**
     * @var Root;
     */
    protected $root;

    /**
     * @var RamlNodeFinder;
     */
    protected $nodeFinder;

    /**
     * @param string              $rootPath
     * @param RamlNodeFinder|null $nodeFinder
     */
    function __construct($rootPath = "/", RamlNodeFinder $nodeFinder = null)
    {
        $this->root = new Root($rootPath);
        $this->nodeFinder = $nodeFinder ?: new RamlNodeFinder();
    }

    /**
     * @return Root
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * @param Request      $request
     * @param HttpResponse $httpResonse
     * @param Method       $method
     */
    public function add(Request $request, HttpResponse $httpResonse, Method $method)
    {
        $this->addQueryToMethod($request->query->all(), $method);
        $this->addBody($request, $method);

        $response = $this->nodeFinder->createOrFindResponse($httpResonse->getStatusCode(), $method);
        $this->addContent($request, $httpResonse, $response);
    }

    /**
     * @param Request $request
     * @param Method  $method
     */
    public function addBody(Request $request, Method $method)
    {
        $contentType = $request->headers->get("Content-Type");
        $requestParams = $request->request->all();

        if (!empty($contentType) && !empty($requestParams)) {
            $requestBody = $this->nodeFinder->createOrFindBody($contentType, $method);
            $this->addParameterToBody($requestBody, $request->request->all());
            $this->addContentToBody($requestBody, $request->getContent());
        }
    }

    /**
     * @param Request      $request
     * @param HttpResponse $httpResonse
     * @param Response     $response
     */
    public function addContent(Request $request, HttpResponse $httpResonse, Response $response)
    {
        $contentType = $httpResonse->headers->get("Content-Type");
        $responseContent = $httpResonse->getContent();

        $this->addContentToBody(
            $this->nodeFinder->createOrFindBody($contentType, $response),
            $responseContent
        );
    }

    /**
     * @param Body  $body
     * @param mixed $content
     */
    public function addContentToBody(Body $body, $content)
    {
        if (null === $body->example) {
            $body->example = is_array($v = $content) ? json_encode($v) : $v;
        }
    }

    /**
     * @param array  $query
     * @param Method $method
     */
    public function addQueryToMethod(array $query, Method $method)
    {
        if (!empty($query)) {
            foreach ($query as $k => $v) {
                if (!isset($method->queryParameters[$k])) {
                    $param = new Parameter($k);
                    $param->example = is_array($v) ? json_encode($v) : $v;
                    $method->queryParameters[$k] = $param;
                }
            }
        }
    }

    /**
     * @param Body  $body
     * @param array $query
     */
    public function addParameterToBody(Body $body, array $query)
    {
        if (!empty($query)) {
            foreach ($query as $k => $v) {
                if (!isset($body->formParameters[$k])) {
                    $param = new Parameter($k);
                    $param->example = is_array($v) ? json_encode($v) : $v;
                    $body->formParameters[$k] = $param;
                }
            }
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
            $root->title = $title;
        }
        if (null !== $version) {
            $root->version = $version;
        }
        if (null !== $baseUri) {
            $root->baseUri = $baseUri;
        }
    }
}