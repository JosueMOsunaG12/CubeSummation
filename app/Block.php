<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'blocks';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['x', 'y', 'z', 'value', 'cube_id'];

    /**
     * Get the cube for the block.
     */
    public function blocks()
    {
        return $this->belongsTo('App\Cube');
    }
}
