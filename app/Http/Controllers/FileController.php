<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
use App\Http\Requests;
use Intervention\Image\ImageManagerStatic as Image;

class FileController extends Controller
{
    private $file;

    public function __construct(File $file){
      $this->middleware('auth');
      $this->file = $file;
    }

    public function show($id)
    {
      $file = $this->file->todo_id->find($id);
      return view('file.index')->with(compact('file'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'file' => 'image|max:3000',
        ]);


        $input = $request->all();
        $fileName = $input['file']->getClientOriginalName();
        $fileType = $input['file']->getClientOriginalExtension();
        $filePath = '/images/' . $input['id'] . '/';

        //画像保存先フォルダ作成

        if (!file_exists(public_path() . $filePath)) mkdir(public_path() . '/images/' . $input['id'] , 0777);
        if (!file_exists(public_path() . '/pureimages/' . $input['id'])) mkdir(public_path() . '/pureimages/' . $input['id'] , 0777);

        //画像処理
        $image = Image::make($input['file']->getRealPath());
        $image->save(public_path() . '/pureimages/' . $input['id'] . '/' . $fileName);
        $image->resize(400, null, function($constraint){$constraint->aspectRatio();})->save(public_path() . $filePath . $fileName);

        //データベース保存
        $this->file->file_name = $fileName;
        $this->file->file_path = $filePath;
        $this->file->file_type = $fileType;
        $this->file->todo_id = $input['id'];
        $this->file->save();

        return redirect()->action('TodoController@edit', $request->id);
    }
}
