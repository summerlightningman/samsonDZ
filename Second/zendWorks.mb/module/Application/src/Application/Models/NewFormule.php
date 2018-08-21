<?php
/**
 * Created by PhpStorm.
 * User: stive
 * Date: 15.08.2018
 * Time: 19:41
 */

namespace Zend\View\Model;


class NewFormule
{
    public function F2($a, $b, $c)
    {
        $sup = new SupportModel();
        return $sup->power(($a + $b), $c) * $sup->power(($a / $c), $sup->mininmal(array($a, $b, $c)));
    }
}