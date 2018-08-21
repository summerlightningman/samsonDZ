<?php
/**
 * Created by PhpStorm.
 * User: stive
 * Date: 16.08.2018
 * Time: 19:24
 */

namespace Zend\View\Model;


abstract class TableModel
{
    abstract protected function getValue();

    public function drawTable($a = array(), $cellpadding = 0)
    {
        if ($this->getValue() == 'WithoutBorder') {
            $table = "<table cellpadding='{$cellpadding}'><tr>";
            foreach ($a as $value)
                $table .= "<tr>$value</tr>";
            $table .= '</td></table>';
            echo $table;
        }
        if ($this->getValue() == 'WithBorder') {
            $table = "<table border=1 cellpadding='{$cellpadding}'><tr>";
            foreach ($a as $value)
                $table .= "<tr>$value</tr>";
            $table .= '</td></table>';
            echo $table;
        }
    }
}