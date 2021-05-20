<?php


namespace App\Services;


use App\Models\File;
use Illuminate\Support\Facades\Storage;

class FileManager
{
    private $dir_location;

    public function __construct()
    {
        $this->dir_location = Storage::disk('custom');
    }

    public function fileUpload($protocol_id,$files) {

        $uploaded = array();
        foreach ($files as $file){

            $stored = $this->dir_location->putFile($protocol_id,$file);
            if ($stored) {
                $tmp = new File;
                $tmp->name = $file->getClientOriginalName();
                $tmp->hash_name = $file->hashName();
                $tmp->mime = $file->getClientMimeType();
                $tmp->extension = $file->getClientOriginalExtension();
                $tmp->protocol_id = $protocol_id;
                $tmp->save();

                array_push($uploaded,$tmp);
            }else
            {
                return ['error' => 'An error occurred during the upload.'];
            }
        }
        return $uploaded;
    }

    public function downloadFile($protocol_id, $file_id) {
        $file = File::where('id',$file_id)->first();
        return $this->dir_location->download($protocol_id.DIRECTORY_SEPARATOR.$file->hash_name,$file->name);
    }

    public function deleteFile($protocol_id, $file_id) {
        $file = File::where('id',$file_id)->first();
        if ($file === null){
            return response()->json(['error' => true, 'message' => 'Sorry, we couldn\'t find your file! Please contact the administrator for additional information.']);
        }
        $delete = $this->dir_location->delete($protocol_id.DIRECTORY_SEPARATOR.$file->hash_name);
        if ($delete)
        {
            File::where('id',$file_id)->first()->delete();
            return response()->json(['success' => true, 'message' => 'The File: '.$file->name.' was deleted successfully!']);
        }
        return response()->json(['error' => true, 'message' => 'Couldn\'t delete the File: '.$file->name.'!']);
    }


}
