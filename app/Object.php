<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Object extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'objects';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['key'];

    /**
     * The storage format of the model's date columns.
     */
    protected $dateFormat = 'U';

    public function values()
    {
        return $this->hasMany(ObjectValue::class);
    }
}
