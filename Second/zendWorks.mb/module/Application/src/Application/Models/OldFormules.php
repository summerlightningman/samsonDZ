<?php
/**
 * Created by PhpStorm.
 * User: stive
 * Date: 15.08.2018
 * Time: 19:40
 */

namespace Zend\View\Model;


class OldFormules
{
    public function S($a, $b, $c)
    {
        return 0.5 * ($a + $b) * $c;
    }

    public function F($a, $b, $c)
    {
        $sup = new SupportModel();
        return $a * $sup->power($b, $c) + ($sup->power(($sup->power(($a / $c), $b) % 3), $sup->mininmal(array($a, $b, $c))));
    }
}