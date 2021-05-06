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

    public function fileUpload($protocol_id,$files){

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

    public function downloadFile($protocol,$file_id){
        $file = File::where('id',$file_id)->first();
        return $this->dir_location->download($protocol.DIRECTORY_SEPARATOR.$file->hash_name,$file->name);
    }


}
