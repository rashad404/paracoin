<?php

namespace App\Http\Controllers\Myadmin;

use App\Http\Controllers\Controller;

use App\Models\Social;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SocialController extends Controller
{
    public function items()
    {
        $array = Social::all();
        return response()->json($array);
    }

    public function info(Request $request)
    {
        $id = $request->id;
        $array = Social::where('id', $id)->first();
        return response()->json($array);
    }

    public function edit($id, Request $request)
    {
        $file_input_name = 'image';

        $fields = $request->all();

        //Photo upload
        unset($fields[$file_input_name]);

        Social::where('id', $id)->update($fields);
        $fields['id'] = $id;

        $user_data = Social::where('id', $id)->first();
        $fields[$file_input_name] = $user_data[$file_input_name];


        return response()->json($fields);
    }

    public function add(Request $request)
    {

        $fields = $request->all();

        $file_input_name = 'image';
        unset($fields[$file_input_name]);


        $mysql_data = $fields;
        $mysql_data['position'] = 0;
        $mysql_data['status'] = 1;

        $data = Social::create($mysql_data);
        $id = $data->id;


        $fields["id"] = $id;

        return response()->json($fields);
    }


    public function delete(Request $request)
    {
        $id = intval($request->id);
        $data = Social::where('id', $id)->first();

        $image_url = $data->image;
        $image_url = preg_replace('/storage/','public', $image_url);
        Storage::delete($image_url);

        $res = Social::where('id', $id)->delete();

        return $res;
    }
}
