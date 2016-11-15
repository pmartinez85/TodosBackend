<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Task
 * @package App
 */
class Task extends Model
{
    protected $fillable = ['name', 'done', 'priority'];

    /**
     * @param $id
     */
    public static function findOrFail($id)
    {
    }

    /**
     * @param $int
     */
    public static function paginate($int)
    {
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
