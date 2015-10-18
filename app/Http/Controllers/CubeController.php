<?php

namespace App\Http\Controllers;

use App\Cube;
use App\Block;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CubeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cubes = Cube::all();

        return view('cubes.index', array('cubes' => $cubes)
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cube = Cube::create(array(
            'name' => $request->input('name')
        ));
    
        $cubes = Cube::all();

        return view('cubes.index', 
            array(  'cubes' => $cubes,
                    'cube_act' => $cube,
                    'msg_create' => 'The cube was created successfully')
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cubes = Cube::all();
        $cube = $cubes->find($id);
        $blocks = $cube->blocks();

        return view('cubes.show', array('cubes' => $cubes,
                                        'cube_act' => $cube,
                                        'blocks' => $blocks));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cubes = Cube::all();
        $cube = $cubes->find($id);
        $blocks = $cube->blocks();

        $x = $request->input('x');
        $y = $request->input('y');
        $z = $request->input('z');
        $value = $request->input('value');

        foreach ($blocks as $block) {
            if ($block->x == $x && $block->y == $y && $block->z == $z) {
                $block->value = $value;
                $block->save();

                return view('cubes.show', array('cubes' => $cubes,
                                                'cube_act' => $cube,
                                                'blocks' => $blocks));   
            }  
        }

        $block = Block::create(array(
            'x' => $x,
            'y' => $y,
            'z' => $z,
            'value' => $value,
            'cube_id' => $cube->id
        ));

        $blocks = $cube->blocks();
        return view('cubes.show', array('cubes' => $cubes,
                                        'cube_act' => $cube,
                                        'blocks' => $blocks));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
