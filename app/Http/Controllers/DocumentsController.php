<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Documents;
use App\Models\DocumentsTypes;
use App\Models\Yachts;
use App\Models\Crew;
use App\Models\Cruises;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage; 

class DocumentsController extends Controller
{

    private function getParent($type, $id) {
       if (!in_array($type, ["yachts", "crew", "cruises"])) {
          return redirect("yachts")->with('error', 'Brak obsługi dokumentów');
       }

       switch ($type) {
          case "yachts":
            $parent = Yachts::find($id);  
            break;
          case "cruises":
            $parent = Cruises::find($id);  
            break;   
         case "crew":
            $parent = Crew::find($id);  
            break;            
       }
 
       if (!$parent) {
            switch ($type) {
                case "yachts":
                      return redirect("yachts")->with('error', 'Problem z obsługą dokuemntów dla '.$type." id: ".$id);
                    break;
                case "crew":
                      return redirect("crew")->with('error', 'Problem z obsługą dokuemntów dla '.$type." id: ".$id); 
                    break;   
                case "cruises":
                      return redirect("cruises")->with('error', 'Problem z obsługą dokuemntów dla '.$type." id: ".$id); 
                    break;                               
            }
       }
       return $parent;
    }

    public function list($type, $id) {
       $parent = $this->getParent($type, $id);
       if (!$parent) {
          return redirect("yachts")->with('error', 'Problem z obsługą dokuemntów dla '.$type." id: ".$id);
       }
       $documents = $parent->documents()->with("type")->get();
       return view("documents/list", ["parent" => $parent, "documents" => $documents, 'type' => $type]);

    }

    public function add($type, $id, Request $request) {
        $save =  $request->input('save');
        $document = new Documents();
        $parent = $this->getParent($type, $id);
       if (!$parent) {
          return redirect("yachts")->with('error', 'Problem z obsługą dokuemntów dla '.$type." id: ".$id);
       }        
        $types = DocumentsTypes::all(); 

        if ($save) {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'file' => 'required|mimes:pdf,doc,xml,txt|max:30360', 
                'type_id' => 'required|integer',
                'issued_at' => 'nullable|date',
                'expires_at' => 'nullable|date'
            ],
            [
                'name.required' => "Pole Nazwa jest wymagane",
                'file.required' => "Dodanie pliku jest wymagane",
                'type_id.required' => "Pole Typ dokumentu jest wymgany", 
            ]
           );

            if ($validator->fails()) {
                $document = new Documents($request->all());
                return view("documents/addedit", ['errors' => implode(", ", $validator->errors()->all()), 'doc' => $document, 'types' => $types]);
            } else {
               $file = $request->file('file');
               $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
               $extension = $file->getClientOriginalExtension();
               $storedName = $filename . "_". rand(1000, 9000)."." . $extension;
               $path = $file->storeAs("documents/{$type}/{$parent->id}", $storedName, 'public');
               $parent->documents()->create([
                'title'         => $request->input('name'),
                'notes' => $request->file('notes')? $request->file('notes') : null,
                'type_id' =>  $request->input('type_id'),
                'file_size' => $file->getSize(),
                'filename'      => $file->getClientOriginalName(),
                'path'          => $path,  
                'mime_type'     => $file->getMimeType(),
                'issued_at' =>  $request->input('issued_at')??  null,
                'expires_at' =>  $request->input('expires_at')?? null,
               ]);
               return redirect("/".$type."/documents/".$id)->with('success', 'Dokument został pomyślnie dodany!');
            }
 
        }
        return view("documents/addedit", ['errors' => '', 'doc' => $document, 'types' => $types]);
    }


    public function edit($type, $id, $fid, Request $request) {
        $save =  $request->input('save');
        $document = Documents::find($fid);
 
        $parent = $this->getParent($type, $id);
       if (!$parent) {
          return redirect("yachts")->with('error', 'Problem z obsługą dokuemntów dla '.$type." id: ".$id);
       }        
        if (!$document) {
            return redirect("/".$type."/documents/".$id)->with('error', 'Nie znaleziono dokumentu');
        }        
        $types = DocumentsTypes::all(); 

        if ($save) {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255', 
                'type_id' => 'required|integer',
                'issued_at' => 'nullable|date',
                'expires_at' => 'nullable|date'
            ],
            [
                'name.required' => "Pole Nazwa jest wymagane", 
                'type_id.required' => "Pole Typ dokumentu jest wymgany", 
            ]
           );

            if ($validator->fails()) {
                $document = new Documents($request->all());
                return view("documents/addedit", ['errors' => implode(", ", $validator->errors()->all()), 'doc' => $document, 'types' => $types, "isedit" => true]);
            } else {
 
               $document->update([
                'title'         => $request->input('name'),
                'notes' => $request->file('notes')? $request->file('notes') : null,
                'type_id' =>  $request->input('type_id'), 
                'issued_at' =>  $request->input('issued_at')??  null,
                'expires_at' =>  $request->input('expires_at')?? null,
               ]);
               return redirect("/".$type."/documents/".$id)->with('success', 'Dokument został pomyślnie edytowany!');
            }
 
        }
        return view("documents/addedit", ['errors' => '', 'doc' => $document, 'types' => $types, "isedit" => true]);


    }

    public function  delete($type, $id, $fid) {
        $document = Documents::find($fid);
        if (!$document) {
            return redirect("/".$type."/documents/".$id)->with('error', 'Nie znaleziono dokumentu');
        }

        Storage::disk('public')->delete([$document->path]);
        $document->delete();
        return redirect("/".$type."/documents/".$id)->with('success', 'Dokument został usunięty');
           
    }


}
