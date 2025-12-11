<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Albums;
use App\Models\Images;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;  

class ImagesController extends Controller
{
    public function albums($id) {
       $album = Albums::find($id);
       $images = $album->images()->get();
       return view("album/list", ["album" => $album, "images" => $images]);
    }

    public function album_add($id, Request $request) {
        $save =  $request->input('save');
        $image = new Images();
        $album = Albums::find($id);

        if ($save) {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'file' => 'required|image|mimes:jpeg,png,jpg,webp,avif|max:15360', 
            ],
            [
                'name.required' => "Pole Nazwa jest wymagane",
                'file.required' => "Dodanie pliku jest wymagane", 
            ]
           );

            if ($validator->fails()) {
                $image = new Images($request->all());
                return view("album/addedit", ['errors' => implode(", ", $validator->errors()->all()), 'image' => $image]);
            } else {
               $file = $request->file('file');
               $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
               $extension = $file->getClientOriginalExtension();
               $storedName = $filename . $extension;
               $path = $file->storeAs("albums/{$album->id}", $storedName, 'public');
               Images::create([
                'title'         => $request->input('name'),
                'description' => $request->file('description')? $request->file('description') : null,
                'album_id' => $id, 
                'filename'      => $file->getClientOriginalName(),
                'path'          => $path,  
                'mime_type'     => $file->getMimeType()
               ]);
               return redirect("albums/".$id)->with('success', 'Zdjęcie zostało pomyślnie dodane!');
            }
 
        }
        return view("album/addedit", ['errors' => '', 'image' => $image]);
    }


    public function album_edit($id, $aid, Request $request) {

        $save =  $request->input('save'); 
        $album = Albums::find($id);
        $image = Images::find($aid);
        if (!$image) {
            return redirect("albums/".$id)->with('error', 'Nie znaleziono zdjęcia');
        }

        if ($save) {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255', 
            ],
            [
                'name.required' => "Pole Nazwa jest wymagane", 
            ]
           );

            if ($validator->fails()) {
                $image = new Images($request->all());
                return view("album/addedit", ['errors' => implode(", ", $validator->errors()->all()), 'image' => $image, "isedit" => true]);
            } else {
  
               $image->update([
                'title'         => $request->input('name'),
                'description' => $request->file('description')? $request->file('description') : null,
               ]);

               return redirect("albums/".$id)->with('success', 'Zdjęcie zostało pomyślnie edytowane!');
            }
 
        }
        return view("album/addedit", ['errors' => '', 'image' => $image, "isedit" => true]);
    }


    public function album_delete($id, $fid) {
        $image = Images::find($fid);
        if (!$image) {
            return redirect("albums/".$id)->with('error', 'Nie znaleziono zdjęcia');
        }

        Storage::disk('public')->delete([$image->path]);
        $image->delete();
        return redirect("albums/".$id)->with('success', 'Zdjęcie został usunięte');
           
    }

}
