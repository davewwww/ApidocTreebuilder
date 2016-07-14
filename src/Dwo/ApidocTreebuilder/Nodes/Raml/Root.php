<?php

namespace Dwo\ApidocTreebuilder\Nodes\Raml;

use Dwo\ApidocTreebuilder\Nodes\NodeInterface;

/**
 * Class Root
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
class Root implements ResourcesAwareInterface, NodeInterface
{
    use ResourcesAware;

    /**
     * @var string
     */
    public $title;
    /**
     * @var string
     */
    public $version;
    /**
     * @var string
     */
    public $baseUri;

    /**
     * @return array
     */
    public function toArray()
    {
        $res = array(
            "title"   => $this->title,
            "version" => $this->version,
            "baseUri" => $this->baseUri,
        );
        if (null !== $this->resources) {
            foreach ($this->resources as $k => $v) {
                $res[$k] = $v;
            }
        }

        return $res;
    }
}