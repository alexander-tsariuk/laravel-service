<?php

namespace Modules\Dashboard\Helpers;


class Upload {

    protected $directory;

    public function __construct($directory) {

        $this->directory = $directory;
    }

    public function upload() {
        if(!$this->directory) {
            dd('Не удалось загрузить изображение!');
        }

        dd('Удалось нахуй!');
    }



}
