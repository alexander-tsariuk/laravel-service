<?php

namespace Modules\Menu\Entities;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model {

    protected $fillable = [
        'name',
        'code',
        'status'
    ];

    /**
     * Список элементов
     * @return mixed
     */
    protected function getList() {
        return $this->orderBy('id', 'DESC');
    }

    /**
     * Создаем новый элемент меню
     * @param array $insertData
     * @return Menu
     */
    protected function createItem(array $insertData) : Menu {
        $item = new Menu();

        $item = $item->fill($insertData);

        $item->save();

        return $item;
    }


    protected function updateItem(int $id, array $insertData) : bool {
        $item = $this->find($id);

        if(!$item) {
            return false;
        }

        $item->fill($insertData);

        return $item->save();
    }

    protected function deleteItem(int $id) : bool {
        $item = $this->find($id);

        return $item->delete();
    }
}
