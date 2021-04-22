<?php

namespace Modules\OurWorks\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Dashboard\Helpers\Upload;

class OurWork extends Model {
    protected $table = 'our_works';

    protected $with = [
        'translations',
        'translation'
    ];

    protected $fillable = [
        'prefix',
        'status',
        'image',
        'parentId'
    ];

    public function translations() {
        return $this->hasMany(OurWorkTranslation::class, 'rowId', 'id');
    }

    public function translation() {
        return $this->hasOne(OurWorkTranslation::class, 'rowId', 'id')
            ->where('languageId', config()->get('app.localeId'));
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

    protected function getByPrefix(string $servicePrefix) {
        return $this->where('prefix', $servicePrefix)
            ->where('status', 1)
            ->first();
    }

    /**
     * Создаем элемент
     * @param array $insertData
     * @return OurWork
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    protected function createItem(array $insertData) {
        $item = new OurWork();

        if(isset($insertData['parentId']) || empty($insertData['parentId'])) {
            $insertData['parentId'] = null;
        }

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

        if(isset($insertData['parentId']) || empty($insertData['parentId'])) {
            $insertData['parentId'] = null;
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
        return $this->orderBy('id', 'DESC')
            ->where('status', 1)
            ->whereIn('parentId', [
                null,
                0
            ])
            ->get();
    }

    protected function deleteImage(int $itemId, string $directory) {
        $uploader = new Upload($directory ?? '');

        $item = parent::find($itemId);

        if(!$item){
            throw new \Exception("Выбранный элемент не найден!");
        }

        $uploadedFile = $uploader->delete($item->image);

        $item->image = null;

        if(!$item->save()) {
            throw new \Exception("При удалении изображения произошла ошибка!");
        }

        return $uploadedFile;
    }

    protected function getListWithExclude($excludedId = null) {
        $query = $this->orderBy('id', 'DESC');
        if(!empty($excludedId)) {
            $query = $query->where('id', '!=', $excludedId);
        }

        return $query->get();
    }

    protected function getChildList($parentId) {
        $query = $this->orderBy('id', 'DESC')
            ->where('parentId', $parentId);

        return $query->get();
    }

    protected function existsItem(string $firstPrefix, string $secondPrefix = '') : bool {
        $firstItem = $this->where('prefix', $firstPrefix)->where('status', 1)->first();

        if(!$firstItem || $firstItem->translation->set_404 == 1) {
            return false;
        }

        if(!empty($secondPrefix)) {
            $secondItem = $this->where('prefix', $secondPrefix)->where('status', 1)
                ->where('parentId', $firstItem->id)->first();

            if(!$secondItem || $secondItem->translation->set_404 == 1) {
                return false;
            }
        }

        return true;
    }
}
