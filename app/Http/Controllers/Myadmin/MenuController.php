<?php

namespace App\Http\Controllers\Myadmin;

use App\Http\Controllers\Controller;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class MenuController extends Controller
{
    public function items()
    {
        $array = Menu::all();
        return response()->json($array);
    }

    public function info(Request $request)
    {
        $id = $request->id;
        $array = Menu::where('id', $id)->first();
        return response()->json($array);
    }

    public function edit($id, Request $request)
    {
        $file_input_name = 'image';

        $fields = $request->all();

        //Photo upload
        unset($fields[$file_input_name]);

        Menu::where('id', $id)->update($fields);
        $fields['id'] = $id;

        $user_data = Menu::where('id', $id)->first();
        $fields[$file_input_name] = $user_data[$file_input_name];

        //Photo upload start, (also see unset on top of this function)
        if ($request->hasFile($file_input_name)) {
            if ($request->hasFile($file_input_name)) {
                $request->validate([
                    $file_input_name => 'required|file|image|max:10140|dimensions:max_width=4096,max_height=4096',
                ]);

                $extension = $request->file($file_input_name)->extension();
                $file_name = $id . "." . $extension;
                $destination = '/public/Menu_photos';
                $url = 'storage/Menu_photos/' . $file_name;
                $request->file($file_input_name)->storeAs($destination, $file_name);

                $fields[$file_input_name] = $url;

                Menu::where('id', $id)->update([$file_input_name => $url]);
            }
        }
        //Photo upload end

        return response()->json($fields);
    }

    public function add(Request $request)
    {
        $file_input_name = 'image';
        $fields = $request->all();

        //Photo upload
        unset($fields[$file_input_name]);

        $mysql_data = $fields;
        $mysql_data['time'] = time();
        $mysql_data['status'] = 1;

        $data = Menu::create($mysql_data);
        $id = $data->id;

        //Photo upload start, (also see unset on top of this function)
        if ($request->hasFile($file_input_name)) {
            $request->validate([
                $file_input_name => 'required|file|image|max:10140|dimensions:max_width=4096,max_height=4096',
            ]);

            $extension = $request->file($file_input_name)->extension();
            $file_name = $id . "." . $extension;
            $destination = '/public/Menu_photos';
            $url = 'storage/Menu_photos/' . $file_name;
            $request->file($file_input_name)->storeAs($destination, $file_name);



            //Thumb
            $image = $request->file('image');
            $thumb_name = time().'.'.$image->getClientOriginalExtension();
            $thumb_destination = public_path('/storage/Menu_photos/thumb');

            $img = Image::make($image->getRealPath());
//            $img->resize(100, 100, function ($constraint) {
//                $constraint->aspectRatio();
//            })->save($thumb_destination.'/'.$thumb_name, 60);
            $img->save($thumb_destination.'/'.$thumb_name, 60);

            //Thumb end


            Menu::where('id', $id)->update([$file_input_name => $url]);
            $fields[$file_input_name] = $url;
        }
        //Photo upload end
        $fields["id"] = $id;

        return response()->json($fields);
    }


    public function delete(Request $request)
    {
        $id = intval($request->id);
        $data = Menu::where('id', $id)->first();

        $image_url = $data->image;
        $image_url = preg_replace('/storage/','public', $image_url);
        Storage::delete($image_url);

        $res = Menu::where('id', $id)->delete();

        return $res;
    }
}
