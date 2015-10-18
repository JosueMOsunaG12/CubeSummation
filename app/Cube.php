<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cube extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cubes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];



    /**
     * Get the blocks for the cube.
     */
    public function blocks()
    {
        return $this->hasMany('App\Block');
    }
}
