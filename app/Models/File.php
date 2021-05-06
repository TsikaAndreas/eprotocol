<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['protocol_id','name','hash_name','extension','mime','created_at','updated_at'];

    public function scopeGetHashName($query,$file_id){
        return $query->where('name','=', $file_id);
    }

    public function scopeGetFile($query,$file_id){
        return $query->where('id','=',$file_id)->first();
    }

    public function scopeGetFiles($query,$protocol_id){
        $files = $query->where('protocol_id','=',$protocol_id)->get()->all();
        if (empty($files)){
            return false;
        }
        return $files;
    }
}
