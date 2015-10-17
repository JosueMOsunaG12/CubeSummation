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
     * Get the cube for the block.
     */
    public function blocks()
    {
        return $this->belongsTo('App\Cube');
    }
}
