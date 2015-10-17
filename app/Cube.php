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
     * Get the blocks for the cube.
     */
    public function blocks()
    {
        return $this->hasMany('App\Block');
    }
}
