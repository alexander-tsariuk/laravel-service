<?php

namespace Modules\Slider\Entities;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model {
    protected $table = 'slider';

    protected $fillable = [
        'status',
        'image'
    ];

    protected function getList() {
        $items = parent::orderBy('id', 'DESC')->get();

        return $items;
    }

    protected function createItem(array $insertData) {
        $item = new Slider();

        $item = $item->fill($insertData);

        $item->save();

        return $item;
    }
}
