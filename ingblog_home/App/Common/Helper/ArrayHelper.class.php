<?php
namespace Common\Helper;

class ArrayHelper
{

    //获取字段值
    public static function getColumn($array, $name, $keepKeys = true)
    {
        $result = [];
        if ($keepKeys) {
            foreach ($array as $k => $element) {
                $result[$k] = static::getValue($element, $name);
            }
        } else {
            foreach ($array as $element) {
                $result[] = static::getValue($element, $name);
            }
        }

        return $result;
    }

    //字段组合
    public static function map($array, $from, $to, $group = null)
    {
        $result = [];
        foreach ($array as $element) {
            $key = static::getValue($element, $from);
            $value = static::getValue($element, $to);
            if ($group !== null) {
                $result[static::getValue($element, $group)][$key] = $value;
            } else {
                $result[$key] = $value;
            }
        }
        return $result;
    }

    //取主键
    public static function index($array, $key)
    {
        $result = [];
        foreach ($array as $element) {
            $value = static::getValue($element, $key);
            $result[$value] = $element;
        }

        return $result;
    }

    public static function getValue($array, $key, $default = null)
    {

        if (is_array($key)) {
            $lastKey = array_pop($key);
            foreach ($key as $keyPart) {
                $array = static::getValue($array, $keyPart);
            }
            $key = $lastKey;
        }

        if (is_array($array) && array_key_exists($key, $array)) {
            return $array[$key];
        }

        if (($pos = strrpos($key, '.')) !== false) {
            $array = static::getValue($array, substr($key, 0, $pos), $default);
            $key = substr($key, $pos + 1);
        }

        if (is_object($array)) {
            return $array->$key;
        } elseif (is_array($array)) {
            return array_key_exists($key, $array) ? $array[$key] : $default;
        } else {
            return $default;
        }
    }

    //合并数组
    public static function merge($a, $b)
    {
        $args = func_get_args();
        $res = array_shift($args);
        while (!empty($args)) {
            $next = array_shift($args);
            foreach ($next as $k => $v) {
                if (is_int($k)) {
                    if (isset($res[$k])) {
                        $res[] = $v;
                    } else {
                        $res[$k] = $v;
                    }
                } elseif (is_array($v) && isset($res[$k]) && is_array($res[$k])) {
                    $res[$k] = self::merge($res[$k], $v);
                } else {
                    $res[$k] = $v;
                }
            }
        }

        return $res;
    }

    //格式化成索引数组
    public static function formatArrayToSort($array) {
        if(is_array($array)) {
            $return = [];
            foreach ($array as $val) {
                $return[] = $val;
            }
            return $return;
        }else{
            return $array;
        }
    }

    //将多为数组转化为一维数组
//    public static $data=[];
//    public static function formatArrayToOne1($array, $level = 1) {
//        $level++;
//        foreach($array as $child) {
//            $return['id'] = $child['id'];
//            $return['name'] = $child['name'];
//            $return['level'] = $level;
//            array_push(self::$data, $return);
//            if(is_array($child['child'])) {
//                self::formatArrayToOne($child['child'], $level);
//            }
//        }
//        return self::$data;
//    }

    public static function formatArrayToOne($array) {
        $return = [];
        $i = 0;
        foreach($array as $val) {
            $return[$i]['id'] = $val['id'];
            $return[$i]['name'] = $val['name'];
            $return[$i]['level'] = 1;
            $i++;
            foreach($val['child'] as $child) {
                $return[$i]['id'] = $child['id'];
                $return[$i]['name'] = $child['name'];
                $return[$i]['level'] = 2;
                $i++;
                foreach($child['child'] as $child1) {
                    $return[$i]['id'] = $child1['id'];
                    $return[$i]['name'] = $child1['name'];
                    $return[$i]['level'] = 3;
                    $i++;
                }
            }
        }
        return $return;
    }
}