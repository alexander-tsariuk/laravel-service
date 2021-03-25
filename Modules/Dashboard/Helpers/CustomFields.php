<?php

if(!function_exists('getFieldByIdType')) {
    function getFieldByIdType(int $fieldType, string $name, string $value = '') {
        $html = "";

        if($fieldType == 1) {
            $html .= "<input type=\"text\" name=\"{$name}\" class=\"form-control form-control-border\" value='{$value}'>";
        } elseif($fieldType == 2) {
            $html .= "<textarea name=\"{$name}\" class=\"form-control form-control-border\">{$value}</textarea>";
        } elseif($fieldType == 3) {
            $html .= "<textarea name=\"{$name}\" class=\"form-control form-control-border summernote\">{$value}</textarea>";
        }



        return $html;
    }
}
