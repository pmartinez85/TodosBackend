<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['name', 'done', 'priority'];

    public static function findOrFail($id)
    {
    }

    public static function paginate($int)
    {
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
