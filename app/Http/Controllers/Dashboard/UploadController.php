<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image, Validator;

class UploadController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $rules = [
                'image'           => 'required|image'
            ];

            $validate = Validator::make($request->all(), $rules);

            if ($validate->fails()) {
                $data = [
                    'status'     => 'error',
                    'message'    => 'you should choose a correct image format!!'
                ];
            }else {
                $folderInput  = $request->input('folder');
                if (!file_exists(public_path('uploads/'.$folderInput))) {
                    mkdir(public_path('uploads/'.$folderInput));
                    chmod(public_path('uploads/'.$folderInput), 0777);
                }
		        $image        = $request->file('image');
		        $exrention    = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
		        $name         = rand(11111, 99999)."_".rand(11111, 99999)."_".time().".".$exrention;
		        $folder       = public_path('uploads/'.$folderInput.'/');
		        $save         = Image::make($image);
		        $save->resize($request->input('width'), $request->input('height'));
		        $save->save($folder.$name);

                if ($request->input('work') != 'undefined') {
                    $data = [
                        'status'  => 'success',
                        'html'    => '<div class="col-xl-3 col-lg-4 col-6" id="showimage">
                                        <div class="thumbnail">
                                            <img class="img-thumbnail bg-white rounded" src="'.asset('uploads/'.$folderInput.'/'.$name).'" />
                                        </div>
                                        <input type="hidden" name="images[]" value="'.asset('uploads/'.$folderInput.'/'.$name).'">
                                        <button type="button" class="btn btn-danger btn-block" id="delete_image">
                                            <i class="fa fa-times"></i> delete image
                                        </button>
                                    </div>'
                    ];
                }else {
                    $data = [
                        'status'  => 'success',
                        'image'   => asset('uploads/'.$folderInput.'/'.$name)
                    ];
                }
            }

            return response()->json($data);
        }
    }
}
