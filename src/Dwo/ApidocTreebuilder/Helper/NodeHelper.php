<?php

namespace Dwo\ApidocTreebuilder\Helper;

use Dwo\ApidocTreebuilder\Nodes\NodeInterface;
use Symfony\Component\Yaml\Yaml;

/**
 * Class NodeHelper
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
class NodeHelper
{
    /**
     * @param mixed $data
     *
     * @return string
     * @throws \Exception
     */
    public static function toYaml($data)
    {
        if ($data instanceof NodeInterface) {
            $data = self::toArray($data);
        }
        if (!is_array($data)) {
            throw new \Exception('expect array');
        }

        if(!class_exists('Symfony\Component\Yaml\Yaml')) {
            throw new \Exception('Symfony\Component\Yaml\Yaml is not installed');
        }

        return Yaml::dump($data, 10, 2);
    }

    /**
     * @param NodeInterface $data
     *
     * @return string
     * @throws \Exception
     */
    public static function toJson(NodeInterface $data)
    {
        if ($data instanceof NodeInterface) {
            $data = self::toArray($data);
        }
        if (!is_array($data)) {
            throw new \Exception('expect array');
        }

        return json_encode($data);
    }

    /**
     * @param NodeInterface $node
     *
     * @return array
     */
    public static function toArray(NodeInterface $node)
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
                $v = self::toArray($v);
            } elseif (is_array($v)) {
                self::walkArray($v);
            }
        }
    }
}