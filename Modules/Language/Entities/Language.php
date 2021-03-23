<?php

namespace Modules\Language\Entities;

use Illuminate\Database\Eloquent\Model;

class Language extends Model {
    public $timestamps = false;

    protected $fillable = [
        'name',
        'prefix',
        'status',
        'default'
    ];

    protected function getList() {
        $items = $this->orderBy('id', 'DESC');

        return $items;
    }

    protected function getById(int $itemId) : Language {
        return $this->find($itemId);
    }

    protected function updateItem(int $id, array $insertData) : bool {
        $item = parent::find($id);

        if(!$item) {
            return false;
        }

        if($item->default == 0 && $insertData['default'] == 1) {
            $clearAll = parent::where('id', '>', 1)->update(['default' => 0]);
        }

        $item->fill($insertData);

        return $item->save();
    }

    protected function deleteItem(int $id) : bool {
        $item = parent::find($id);

        return $item->delete();
    }

    protected function createItem(array $insertData) {
        $item = new Language();

        $item = $item->fill($insertData);

        $item->save();

        return $item;
    }

}
