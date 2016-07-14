<?php

namespace Dwo\ApidocTreebuilder\Treebuilder;

/**
 * Interface TreebuilderInterface
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
interface TreebuilderInterface
{
    /**
     * @param string $title
     * @param string $baseUri
     * @param string $version
     */
    public function addInfos($title = '', $baseUri = '', $version = '');
}