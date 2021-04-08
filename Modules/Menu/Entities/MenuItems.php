<?php

namespace Modules\Menu\Entities;

use Illuminate\Database\Eloquent\Model;

class MenuItems extends Model {

    public $timestamps = false;

    protected $fillable = [
        'menuId',
        'parentId',
        'url',
        'label',
        'languageId'
    ];

    protected function getList(int $menuId) {
        return $this->orderBy('id', 'DESC')->where('menuId', $menuId);
    }

    protected function createItem(int $menuId, array $insertData) {
        $item = new MenuItems();

        $item = $item->fill([
            'menuId' => $menuId,
            'parentId' => $insertData['parentId'] ?? null,
            'url' => $insertData['url'],
            'label' => $insertData['label'],
            'languageId' => $insertData['languageId']
        ]);

        $item->save();

        return $item;
    }
}
