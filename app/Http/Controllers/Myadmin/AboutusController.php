<?php

namespace App\Http\Controllers\Myadmin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Text;
use Illuminate\Http\Request;

class AboutusController extends Controller
{

    public function items()
    {
        $array = AboutUs::all();
        return response()->json($array);
    }

    public function edit(Request $request)
    {
        $id = 1;
        $file_input_name = 'image';

        $fields = $request->all();

        //Photo upload
        unset($fields[$file_input_name]);

        AboutUs::where('id', $id)->update($fields);
        $fields['id'] = $id;

        $user_data = AboutUs::where('id', $id)->first();
        $fields[$file_input_name] = $user_data[$file_input_name];

        //Photo upload start, (also see unset on top of this function)
        if ($request->hasFile($file_input_name)) {
            if ($request->hasFile($file_input_name)) {
                $request->validate([
                    $file_input_name => 'required|file|image|max:10140|dimensions:max_width=4096,max_height=4096',
                ]);

                $extension = $request->file($file_input_name)->extension();
                $file_name = $id . "." . $extension;
                $destination = '/public/Aboutus_photos';
                $url = 'storage/Aboutus_photos/' . $file_name;
                $request->file($file_input_name)->storeAs($destination, $file_name);

                $fields[$file_input_name] = $url;

                Text::where('id', $id)->update([$file_input_name => $url]);
            }
        }
        //Photo upload end

        return response()->json($fields);
    }

}
