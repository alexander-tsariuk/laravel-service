<?php

namespace Modules\OurWorks\Entities;

use Illuminate\Database\Eloquent\Model;

class OurWork extends Model {
    protected $table = 'our_works';

    protected $with = [
        'translations'
    ];

    protected $fillable = [
        'prefix',
        'status'
    ];

    public function translations() {
        return $this->hasMany(OurWorkTranslation::class, 'rowId', 'id');
    }

    protected function getList() {
        $items = parent::orderBy('id', 'DESC')->get();

        return $items;
    }

    protected function createItem(array $insertData) {
        $item = new OurWork();

        $item = $item->fill($insertData);

        $item->save();

        return $item;
    }

    protected function updateItem(int $id, array $insertData) {
        $item = parent::find($id);

        $item = $item->fill([
            'prefix' => $insertData['prefix'],
            'status' => $insertData['status']
        ]);

        if($item->save()) {
            // переводы
        }

        return false;
    }


}
