<?php


namespace App\Services;


use App\Models\File;
use App\Models\Protocol;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\Models\Activity;

class FileManager
{
    private $dir_location;

    public function __construct()
    {
        $this->dir_location = Storage::disk('custom');
    }

    /**
     * A function that saves the uploaded files in the database
     * and the physical file in the directory that is provided
     * @param $protocol
     * @param $files
     * @return array|array[]
     */
    public function fileUpload($protocol, $files) {

        $uploaded = array();
        $errors = array();
        foreach ($files as $key => $file){
            $stored = $this->dir_location->putFile($protocol->id,$file);
            if ($stored) {
                $tmp = new File;
                $tmp->name = $file->getClientOriginalName();
                $tmp->hash_name = $file->hashName();
                $tmp->mime = $file->getClientMimeType();
                $tmp->extension = $file->getClientOriginalExtension();
                $tmp->protocol_id = $protocol->id;
                $tmp->save();

                array_push($uploaded,$tmp);
            } else {
                $errors['file.'.$key] = trans('message.file_save_error', ['file' => $file->getClientOriginalName()]);
            }
        }
        $file_ids = collect($uploaded)->map(function ($item) {
            return $item->id;
        });

        // Activity Log
        activity('add-files')->causedBy(auth()->user()->getAuthIdentifier())
            ->performedOn($protocol)
            ->withProperty('files', json_encode($file_ids))
            ->log(auth()->user()->getFullName() . ' added '. count($files) . ' files');

        if (!empty($errors)) {
            return ['error' => $errors];
        }
        return $uploaded;
    }

    /**
     * A function that finds the selected file and downloads it
     * @param $protocol_id
     * @param $file_id
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function downloadFile($protocol_id, $file_id) {
        $file = File::where('id',$file_id)->first();
        return $this->dir_location->download($protocol_id.DIRECTORY_SEPARATOR.$file->hash_name,$file->name);
    }


    /**
     * A function that finds the file and deletes it
     * from the database and the physical directory
     * @param $protocol_id
     * @param $file_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteFile($protocol_id, $file_id) {
        $file = File::where('id',$file_id)->first();
        if ($file === null){
            return response()->json(['error' => true, 'message' => __('message.file_no_found')]);
        }
        $delete = $this->dir_location->delete($protocol_id.DIRECTORY_SEPARATOR.$file->hash_name);
        if ($delete)
        {
            File::where('id',$file_id)->first()->delete();

            // Activity Log
            activity('delete-file')->causedBy(auth()->user()->getAuthIdentifier())
                ->performedOn($file)
                ->withProperties(['protocol' => $protocol_id, 'file_name' => $file->name])
                ->log(auth()->user()->getFullName() . ' deleted a file.');

            return response()->json(['success' => true, 'message' => __('message.delete_file_success')]);
        }
        return response()->json(['error' => true, 'message' => __('message.delete_file_error')]);
    }


}
