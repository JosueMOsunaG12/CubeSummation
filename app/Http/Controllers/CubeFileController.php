<?php

namespace App\Http\Controllers;

use Validator;
use App\Cube;
use App\Block;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Storage;

/**
*
*   The CubeFileController program implements an application that
*   lets you load a file, read and calculate the operations 
*   contained in the file 
* 
*/
class CubeFileController extends Controller
{
    private $cube;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createCube($info)
    {
        $name = 'Cube ' . $info;

        $this->cube = Cube::create(array(
            'name' => $name
        ));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($x, $y, $z, $value)
    {
        $blocks = $this->cube->blocks()->get();

        foreach ($blocks as $block) {
            if ($block->x == $x && $block->y == $y && $block->z == $z) {
                $block->value = $value;
                $block->save();
                return;   
            }  
        }

        $block = Block::create(array(
            'x' => $x,
            'y' => $y,
            'z' => $z,
            'value' => $value,
            'cube_id' => $this->cube->id
        ));
    }

    /**
     * Query the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function query($x1, $y1, $z1, $x2, $y2, $z2)
    {
        $blocks = $this->cube->blocks()->get();
        $sum = 0;

        foreach ($blocks as $block) {
            if(($x1 <= $block->x) && ($block->x <= $x2)) {
                if (($y1 <= $block->y) && ($block->y <= $y2)) {
                    if (($z1 <= $block->z) && ($block->z <= $z2)) {
                        $sum += $block->value;
                    }
                }
            }
        }
        
        return $sum;
    }


    /**
     * Upload a file and calculate this operations
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cube_file' => 'required|mimes:txt|max:128',
        ]);

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $file = $request->file('cube_file');
        $input = fopen($file, 'r');
        Storage::delete('output.txt');

        // Read test cases
        $line = fgets($input);
        $t = intval($line);
        for ($i = 0; $i < $t; $i++) {
            $line = fgets($input);
            $a = explode(" ", $line);
            $n = $a[0]; 
            $m = $a[1];
            
            $this->createCube($line);

            for($j = 0; $j < $m; $j++) {
                $line = fgets($input);
                $a = explode(" ", $line);

                if ($a[0] == "UPDATE") {
                    $this->update(  intval($a[1]), intval($a[2]), 
                                    intval($a[3]), floatval($a[4]));
                } else if ($a[0] == "QUERY") {
                    $sum = $this->query(intval($a[1]), intval($a[2]), 
                                        intval($a[3]), intval($a[4]), 
                                        intval($a[5]), intval($a[6]));
                    Storage::append('output.txt', $sum);
                } 
            }
        }

        fclose($input);

        $next_page = '/cube/'. $this->cube->id .'/download';
        \Session::flash('download_in_the_next_request', $next_page);

        return redirect()->to('/cube/' . $this->cube->id);
    }

    /**
     * Download the output, before
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download(Request $request)
    {
        $file_path = storage_path() .'/app/output.txt';    
        return response()->download($file_path);
    }

}
