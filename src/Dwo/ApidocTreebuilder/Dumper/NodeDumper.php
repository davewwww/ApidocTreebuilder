<?php

namespace Dwo\ApidocTreebuilder\Dumper;

use Dwo\ApidocTreebuilder\Nodes\NodeInterface;

/**
 * Class NodeDumper
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
class NodeDumper
{
    /**
     * @param NodeInterface $node
     *
     * @return array
     */
    public static function dump(NodeInterface $node)
    {
        $data = $node->toArray();

        if (is_array($data)) {
            self::removeNull($data);
            self::walkArray($data);
        }

        return $data;
    }

    /**
     * @param array $data
     */
    private function removeNull(array &$data)
    {
        foreach ($data as $key => $value) {
            if (null === $value) {
                unset($data[$key]);
            }
        }
    }

    /**
     * @param array $array
     */
    private function walkArray(array &$array)
    {
        foreach ($array as $k => &$v) {
            if ($v instanceof NodeInterface) {
                $v = self::dump($v);
            } elseif (is_array($v)) {
                self::walkArray($v);
            }
        }
    }
}