<?php

namespace Modules\Page\Entities;

use Illuminate\Database\Eloquent\Model;

class Page extends Model {

    protected $fillable = [
        'prefix',
        'status',
    ];

    protected $with = [
        'translations',
        'translation',
    ];

    public function translations() {
        return $this->hasMany(PageTranslation::class, 'rowId', 'id');
    }

    public function translation() {
        return $this->hasOne(PageTranslation::class, 'rowId', 'id')
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

    /**
     * Получаем список слайдов
     * @return mixed
     */
    protected function getList() {
        $items = $this->orderBy('id', 'DESC');

        return $items;
    }

    /**
     * Создаем слайд
     * @param array $insertData
     * @return Slider
     */
    protected function createItem(array $insertData) {
        $item = new Page();

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

    protected function deleteItem(int $id) : bool {
        $item = parent::find($id);

        return $item->delete();
    }
}
