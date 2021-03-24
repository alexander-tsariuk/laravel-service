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

        $html = "<div class=\"btn-group btn-group-sm\">";
        $html .= "<a href=\"{$editUrl}\" class=\"btn btn-info\" title=\"Редактировать\"><i class=\"fas fa-pen\"></i></a>";
        $html .= "<a href=\"#\" class=\"delete-item btn btn-danger\" data-id=\"{$id}\" data-route=\"{$route}\" title='Удалить'>";
        $html .= "<i class=\"fas fa-trash\"></i></a>";
        $html .= "</div>";

        return $html;
    }
}
