<?php

namespace Modules\ContactUs\Entities;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model {
    protected $table = 'contact_us';

    protected $fillable = [
        'name',
        'phone',
        'comment'
    ];

    protected function createItem(array $insertData) {
        $item = new ContactUs();

        $item = $item->fill($insertData);

        if(!$item->save()) {
            throw new \Exception("Не удалось отправить сообщение. Повторите попытку позже или обратитесь к администратору.");
        }

        return $item;
    }

    protected function getList() {
        return $this->orderBy('id', 'DESC');
    }
}
