<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = ['key', 'position_name', 'description'];

    public function users()
    {
        return $this->hasMany(User::class, 'position_id');
    }
}
