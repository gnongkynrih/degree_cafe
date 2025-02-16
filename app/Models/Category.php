<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = ['id'];

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}
