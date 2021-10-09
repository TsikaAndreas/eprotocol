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
        $errors = array();
        foreach ($files as $key => $file){
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
            } else {
                $errors['file.'.$key] = trans('message.file_save_error', ['file' => $file->getClientOriginalName()]);
            }
        }
        if (!empty($errors)) {
            return ['error' => $errors];
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
            return response()->json(['error' => true, 'message' => __('message.file_no_found')]);
        }
        $delete = $this->dir_location->delete($protocol_id.DIRECTORY_SEPARATOR.$file->hash_name);
        if ($delete)
        {
            File::where('id',$file_id)->first()->delete();
            return response()->json(['success' => true, 'message' => __('message.delete_file_success')]);
        }
        return response()->json(['error' => true, 'message' => __('message.delete_file_error')]);
    }


}
