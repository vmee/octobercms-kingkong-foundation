<?php namespace Kingkong\Foundation\Http\Controllers;

use System\Models\File;
use Illuminate\Routing\Controller as BaseController;
use Response;

class UploadController extends BaseController
{
    /**
     * Display the specified resource.
     * GET /api/{resource}/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function store()
    {

        $fileHes= $args[0];
        $width = isset($args[1]) ?  $args[1] : false;
        $height = isset($args[2]) ?  $args[2] : $width;

        $id = pack('H*', $fileHes);

        if(empty($id)){
            return response()->json(['error' => '参数错误'], 400);
        }

        $file = null;
        if(is_numeric($id)){
            $file = File::find($id);
        }

        if(!$file){
            return response()->json(['error' => '图片未找到'], 404);
        }

        if($width || $height){
            return $file->outputThumb($width, $height);
        }else{
            return $file->output();
        }


    }
}