<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObjectValue extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'objects_values';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['value', 'object_id'];

    /**
     * The storage format of the model's date columns.
     */
    protected $dateFormat = 'U';

    public function key()
    {
        return $this->belongsTo(Object::class);
    }
}
