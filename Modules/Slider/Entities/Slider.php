<?php

namespace Modules\Slider\Entities;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model {
    protected $table = 'slider';

    protected function getList() {
        $items = parent::orderBy('id', 'DESC')->get();

        return $items;
    }
}
