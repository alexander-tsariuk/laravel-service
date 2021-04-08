<?php

namespace Modules\Slider\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Dashboard\Helpers\Upload;
use PHPUnit\Util\Exception;

class Slider extends Model {
    protected $table = 'slider';

    protected $fillable = [
        'status',
        'image'
    ];

    protected $with = [
        'translations',
        'translation',
    ];

    public function translations() {
        return $this->hasMany(SlideTranslation::class, 'rowId', 'id');
    }

    public function translation() {
        return $this->hasOne(SlideTranslation::class, 'rowId', 'id')
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

    /**
     * Получаем список слайдов
     * @return mixed
     */
    protected function getList() {
        $items = $this->orderBy('id', 'DESC')->paginate(10);

        return $items;
    }

    /**
     * Получаем список активных слайдов
     * @return mixed
     */
    protected function getActiveList() {
        return $this->orderBy('id', 'DESC')->limit(10)->get();
    }

    /**
     * Создаем слайд
     * @param array $insertData
     * @return Slider
     */
    protected function createItem(array $insertData) {
        $item = new Slider();

        $item = $item->fill($insertData);

        $item->save();

        return $item;
    }

    /**
     * Обновляем информацию слайда
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

    protected function uploadImage(int $itemId, array $insertData) {
        $uploader = new Upload($insertData['directory'] ?? '');

        $uploadedFile = $uploader->upload($itemId);

        $item = parent::find($itemId);

        $item->image = $uploadedFile;

        if(!$item->save()) {
            throw new \Exception("Изображение было загружено, но при обновлении слайда произошла ошибка. Обратитесь к администратору!");
        }

        return $uploadedFile;
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
}
