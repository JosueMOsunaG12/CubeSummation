<?php

namespace App\Http\Controllers;

use Validator;
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }


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
        $blocks = $cube->blocks()->paginate(10);

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
        $blocks = $cube->blocks()->get();
        $message = 'The cube was updated successfully';

        $validator = Validator::make($request->all(), [
            'x' => 'required|integer|max:32767',
            'y' => 'required|integer|max:32767',
            'z' => 'required|integer|max:32767',
            'value' => 'required|integer|max:9223372036854775807',
        ]);

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $x = $request->input('x');
        $y = $request->input('y');
        $z = $request->input('z');
        $value = $request->input('value');

        foreach ($blocks as $block) {
            if ($block->x == $x && $block->y == $y && $block->z == $z) {
                $block->value = $value;
                $block->save();

                $blocks = $cube->blocks()->paginate(10);
                return view('cubes.show', array('cubes'     => $cubes,
                                                'cube_act'  => $cube,
                                                'blocks'    => $blocks,
                                                'message'   => $message));   
            }  
        }

        $block = Block::create(array(
            'x' => $x,
            'y' => $y,
            'z' => $z,
            'value' => $value,
            'cube_id' => $cube->id
        ));

        $blocks = $cube->blocks()->paginate(10);
        return view('cubes.show', array('cubes'     => $cubes,
                                        'cube_act'  => $cube,
                                        'blocks'    => $blocks,
                                        'message'   => $message));

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

    /**
     * Query the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function query(Request $request, $id)
    {
        $cubes = Cube::all();
        $cube = $cubes->find($id);
        $blocks = $cube->blocks()->get();
        $sum = 0;
        $message = "The query resulted in the sum of: ";

        $validator = Validator::make($request->all(), [
            'x1' => 'required|integer|max:32767',
            'y1' => 'required|integer|max:32767',
            'z1' => 'required|integer|max:32767',
            'x2' => 'required|integer|max:32767',
            'y2' => 'required|integer|max:32767',
            'z2' => 'required|integer|max:32767',
        ]);

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $x1 = $request->input('x1');
        $y1 = $request->input('y1');
        $z1 = $request->input('z1');
        $x2 = $request->input('x2');
        $y2 = $request->input('y2');
        $z2 = $request->input('z2');


        foreach ($blocks as $block) {
            if (($x1 <= $block->x) && ($block->x <= $x2)) {
                if (($y1 <= $block->y) && ($block->y <= $y2)){
                    if (($z1 <= $block->z) && ($block->z <= $z2)) {
                        $sum += $block->value;
                    }
                }
            }
        }

        $blocks = $cube->blocks()->paginate(10);
        return view('cubes.show', array('cubes'     => $cubes,
                                        'cube_act'  => $cube,
                                        'blocks'    => $blocks,
                                        'message'   => $message . $sum));
    }
}
