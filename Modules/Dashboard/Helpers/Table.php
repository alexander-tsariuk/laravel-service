<?php

if(!function_exists('tableStatus')) {
    function tableStatus(int $status) {
        $html = "";

        switch ($status) {
            case 0:
                $html .= "<span class=\"badge bg-danger\">Неактивен</span>";
                break;
            case 1:
                $html .= "<span class=\"badge bg-success\">Активен</span>";
                break;
        }

        return $html;
    }
}

if(!function_exists('tableDefault')) {
    function tableDefault(int $default) {
        $html = "";

        switch ($default) {
            case 0:
                $html .= "<span class=\"badge bg-danger\">Нет</span>";
                break;
            case 1:
                $html .= "<span class=\"badge bg-success\">Да</span>";
                break;
        }

        return $html;
    }
}

if(!function_exists('tableActions')) {
    function tableActions(int $id, string $route) {
        $editUrl = route('dashboard.'.$route.'.edit', ['itemId' => $id]);

        $html = "<a href=\"{$editUrl}\" title=\"Редактировать\">
                    <i class=\"fa fa-pen\"></i>
                 </a>
                 <a href=\"#\" class=\"delete-item\" data-id=\"{$id}\" data-route=\"{$route}\" title='Удалить'>
                    <i class=\"fa fa-trash\"></i>
                 </a>";

        return $html;
    }
}
