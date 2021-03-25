<?php

namespace Modules\Dashboard\Entities;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model {
    public $fieldTypes = [
        1 => 'input',
        2 => 'textarea',
        3 => 'summernote',
    ];

    protected function getList() {
        $items = $this->orderBy('id', 'ASC')->get();
        // разбиваем элементы на группы
        $items = $this->prepareItems($items);

        return $items;
    }

    private function prepareItems($items) {
        if(!empty($items)) {
            $result = [];

            foreach ($items as $item) {
                $code = explode('.', $item->code);
                if(!empty($code)) {
                    $result[$code[0]][$code[1] ?? count($result[$code[0]] + 1)] = $item;
                }
            }


            return $result;
        }

        return $items;
    }

    protected function updateItems(array $insertData) {
        if(!empty($insertData)) {
            foreach ($insertData as $group => $fields) {
                if(!empty($fields)) {
                    foreach ($fields as $code => $value) {
                        $parameter = $this->where('code', "{$group}.{$code}")->first();

                        if(!empty($parameter)) {
                            $parameter->content = $value;

                            $parameter->save();
                        }
                    }
                }
            }
        }

        return true;
    }
}
