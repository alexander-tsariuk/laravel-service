<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'phone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected function getList() {
        $items = $this->orderBy('id', 'DESC');

        return $items;
    }

    protected function updateItem(int $id, array $insertData) : bool {
        $item = $this->find($id);

        if(!$item) {
            return false;
        }

        $item = $item->fill($insertData);

        return $item->save();
    }

    protected function createItem(array $insertData) : User {
        $item = new User();

        $item = $item->fill($insertData);

        $item->password = Hash::make($insertData['password']);

        $item->save();

        return $item;
    }

    protected function prepareDate(string $date) : string {
        $date = Carbon::make($date)->translatedFormat('d F Y H:i');

        return $date;
    }
}
