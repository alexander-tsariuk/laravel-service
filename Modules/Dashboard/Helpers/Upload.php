<?php

namespace Modules\Dashboard\Helpers;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Upload {

    protected $directory;

    public function __construct($directory) {

        $this->directory = $directory;
    }

    public function upload($itemId) {
        if(!$this->directory) {
            throw new \Exception("Некорректно задана директория для загрузки изображения!");
        }

        $directory = "{$this->directory}/{$itemId}";

        if(!Storage::exists("/public/{$directory}")) {
            Storage::makeDirectory("/public/{$directory}");
        }

        $extension = request()->uploadingFile->extension();

        $fileName = Str::random(32).time().".".$extension;

        request()->uploadingFile->storeAs('/public/', $directory.'/'.$fileName);

        return "/{$directory}/{$fileName}";
    }




}
