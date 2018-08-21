<?php
/**
 * Created by PhpStorm.
 * User: stive
 * Date: 16.08.2018
 * Time: 19:27
 */

namespace Zend\View\Model;


class NoBorderModel extends TableModel
{
    protected function getValue()
    {
        return "WithoutBorder";
    }
}