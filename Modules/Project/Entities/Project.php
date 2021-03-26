<?php

namespace Modules\Project\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Dashboard\Helpers\Upload;

class Project extends Model {
    protected $with = [
        'translations',
        'translation'
    ];

    protected $fillable = [
        'prefix',
        'status',
        'image',
        'serviceId'
    ];

    public function translations() {
        return $this->hasMany(ProjectTranslation::class, 'rowId', 'id');
    }

    public function translation() {
        return $this->hasOne(ProjectTranslation::class, 'rowId', 'id')
            ->where('languageId', 1);
    }

    /**
     * Превращаем коллекцию в ассоциативный массив объектов
     * Вид: ID перевода -> объект перевода
     * @return array
     */
    public function prepareTranslationsByID() {
        $result = [];

        if(!empty($this->translations)) {
            foreach($this->translations as $translation) {
                $result[$translation->languageId] = $translation;
            }
        }

        return $result;
    }

    protected function getList() {
        $items = $this->orderBy('id', 'DESC');

        return $items;
    }

    /**
     * Создаем элемент
     * @param array $insertData
     * @return Project
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    protected function createItem(array $insertData) {
        $item = new Project();

        $item = $item->fill($insertData);

        $item->save();

        return $item;
    }

    /**
     * Обновляем информацию элемента
     * @param int $itemId
     * @param array $insertData
     * @return bool
     * @throws \Exception
     */
    protected function updateItem(int $itemId, array $insertData) : bool {
        $item = parent::find($itemId);

        if(!$item) {
            throw new \Exception("Элемент с таким идентификатором не был найден!");
        }

        $item = $item->fill($insertData);

        return $item->save();
    }

    /**
     * Загружаем изображения
     * @param int $itemId
     * @param array $insertData
     * @return string
     */
    protected function uploadImage(int $itemId, array $insertData) {
        $uploader = new Upload($insertData['directory'] ?? '');

        $uploadedFile = $uploader->upload($itemId);

        $item = parent::find($itemId);

        $item->image = $uploadedFile;

        if(!$item->save()) {
            throw new \Exception("Изображение было загружено, но при обновлении элемента произошла ошибка. Обратитесь к администратору!");
        }

        return $uploadedFile;
    }

    protected function getActiveList() {
        return $this->orderBy('id', 'DESC')->where('status', 1)->get();
    }

    protected function getByPrefix(string $prefix) {
        return $this->where('prefix', $prefix)
            ->where('status', 1)
            ->first();
    }
}
