<?php

namespace Modules\Project\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Dashboard\Helpers\Upload;

class ProjectImages extends Model {

    public $timestamps = false;
    protected $fillable = [
        'projectId',
        'path',
    ];

    /** Загружаем изображения
     * @param int $itemId
     * @param array $insertData
     * @return string
     */
    protected function uploadImages(int $itemId, $uploadingFile) {
        $uploader = new Upload('project-images');


        $uploadedFile = $uploader->uploadMultiple($itemId, $uploadingFile);

        $item = new ProjectImages();

        $item->path = $uploadedFile;
        $item->projectId = $itemId;

        if(!$item->save()) {
            throw new \Exception("Изображение было загружено, но при обновлении элемента произошла ошибка. Обратитесь к администратору!");
        }

        return $uploadedFile;
    }

    protected function deleteImage(int $itemId, string $directory) {
        $uploader = new Upload($directory ?? '');

        $item = parent::find($itemId);

        if(!$item){
            throw new \Exception("Выбранный элемент не найден!");
        }

        $uploadedFile = $uploader->delete($item->path);

        if(!$item->delete()) {
            throw new \Exception("При удалении изображения произошла ошибка!");
        }

        return $uploadedFile;
    }
}
