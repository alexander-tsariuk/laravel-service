<?php

namespace Modules\Dashboard\Helpers;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class Upload {

    protected $directory;

    public function __construct($directory) {

        $this->directory = $directory;
    }

    public function upload($itemId, $sizes = []) {
        if(!$this->directory) {
            throw new \Exception("Некорректно задана директория для загрузки изображения!");
        }

        $directory = "{$this->directory}/{$itemId}";

        if(!Storage::exists("/public/{$directory}")) {
            Storage::makeDirectory("/public/{$directory}");
        }

        $extension = request()->uploadingFile->extension();
        $fileName = Str::random(32).time();

        // создаем изображение
        $image = Image::make(request()->uploadingFile->getRealPath());

        $image->resize(isset($sizes['width']) ? $sizes['width'] : null, isset($sizes['height']) ? $sizes['height'] : null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $image->encode('jpg');

        $imagePath = Storage::disk('public')->path("/{$directory}/{$fileName}".".{$extension}");
        $imagePath = preg_replace("#(\/\/)#", "/", $imagePath);

        $image->save($imagePath, 75);

        // webp
//        $this->makeWebp('/'.$directory.'/'.$fileName, $extension);

        return "/{$directory}/{$fileName}.{$extension}";
    }

    public function uploadMultiple($itemId, $file) {
        if(!$this->directory) {
            throw new \Exception("Некорректно задана директория для загрузки изображения!");
        }

        $directory = "{$this->directory}/{$itemId}";

        if(!Storage::exists("/public/{$directory}")) {
            Storage::makeDirectory("/public/{$directory}");
        }

        $extension = $file->extension();

        $fileName = Str::random(32).time().".".$extension;

        $file->storeAs('/public/', $directory.'/'.$fileName);

//        $this->makeWebp('/'.$directory.'/'.$fileName, $extension);

        return "/{$directory}/{$fileName}";
    }

    public function delete(string $imagePath) {
        if(!$this->directory) {
            throw new \Exception("Некорректно задана директория для загрузки изображения!");
        }

        if(Storage::exists("/public/{$imagePath}")) {
            Storage::delete("/public/{$imagePath}");
        }

        return true;
    }

    public function makeWebp(string $imagePath, string $extension) {
        $source = Storage::disk('public')->get($imagePath.'.'.$extension);

        $image = Image::make($source)->encode('webp', 90);

        $imagePath = Storage::disk('public')->path($imagePath.'.webp');

        $imagePath = preg_replace("#(\/\/)#", "/", $imagePath);

        return $image->save($imagePath);
    }



}
