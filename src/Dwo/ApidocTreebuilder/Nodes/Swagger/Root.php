<?php

namespace Dwo\ApidocTreebuilder\Nodes\Swagger;

use Dwo\ApidocTreebuilder\Nodes\NodeInterface;

/**
 * Class Root
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
class Root implements NodeInterface
{
    /**
     * @var Info
     */
    public $info;
    /**
     * @var string
     */
    public $host = 'swagger.io';
    /**
     * @var string
     */
    public $basePath = '/';
    /**
     * @var Path[]
     */
    public $paths;
    /**
     * @var string
     */
    private $swagger = '2.0';

    /**
     * @param Info|null $info
     */
    public function __construct(Info $info = null)
    {
        $this->info = $info ?: new Info();
    }

    /**
     * @param string $key
     * @param Path   $path
     */
    public function addPath($key, Path $path)
    {
        $this->paths[$key] = $path;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            "swagger"  => $this->swagger,
            "info"     => $this->info,
            "host"     => $this->host,
            #schemes
            "basePath" => $this->basePath,
            #produces
            #securityDefinitions
            "paths"    => $this->paths,
        );
    }
}