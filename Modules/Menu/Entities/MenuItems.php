<?php

namespace Modules\Menu\Entities;

use Illuminate\Database\Eloquent\Model;

class MenuItems extends Model {

    public $timestamps = false;

    protected $fillable = [
        'menuId',
        'parentId',
        'url',
        'status'
    ];

    protected $with = [
        'translation',
        'translations'
    ];

    public function translation() {
        return $this->hasOne(MenuItemTranslations::class, 'menuItemId', 'id')
            ->where('languageId', config()->get('app.localeId'));
    }

    public function translations() {
        return $this->hasMany(MenuItemTranslations::class, 'menuItemId', 'id');
    }

    protected function getList(int $menuId) {
        return $this->orderBy('id', 'DESC')->where('menuId', $menuId);
    }

    protected function createItem(int $menuId, array $insertData) {
        $item = new MenuItems();

        $item = $item->fill([
            'menuId' => $menuId,
            'parentId' => $insertData['parentId'] ?? null,
            'url' => $insertData['url'],
            'status' => $insertData['status'] ?? 0
        ]);

        $item->save();

        return $item;
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
}
