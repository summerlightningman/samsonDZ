<?php
/**
 * Created by PhpStorm.
 * User: stive
 * Date: 15.08.2018
 * Time: 19:41
 */

namespace Zend\View\Model;


class SupportModel
{
    public function mininmal($array = array())
    {
        $min = array_shift($array);
        foreach ($array as $v)
            if ($v < $min)
                $min = $v;
        return $min;
    }

    public function power($value, $power = 1)
    {
        if ($power > 1)
            $value *= power($value, $power - 1);
        return $value;
    }
}