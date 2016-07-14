<?php

namespace Dwo\ApidocTreebuilder\Nodes\Swagger;

use Dwo\ApidocTreebuilder\Nodes\NodeInterface;

/**
 * Class Info
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
class Info implements NodeInterface
{
    public $title = 'No Title';
    public $description = '';
    public $version = '1.0.0';

    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            "title"       => $this->title,
            "description" => $this->description,
            "version"     => $this->version,
        );
    }
}