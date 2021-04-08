<?php

namespace Modules\Menu\Entities;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model {


    protected function getList() {
        return $this->orderBy('id', 'DESC');
    }
}
