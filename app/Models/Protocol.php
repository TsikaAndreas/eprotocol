<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Protocol extends Model
{
    use HasFactory;

    const in_prefix = 'ΓΑΒ-ΕΙΣ-';
    const out_prefix = 'ΓΑΒ-ΕΞ-';

    protected $table = 'protocols';

    protected $fillable = ['protocol_number', 'protocol', 'protocol_date', 'type', 'status', 'ingoing_protocol', 'ingoing_protocol_date',
        'creator', 'receiver', 'title', 'description', 'created_at', 'updated_at', 'canceled_at'];

    public function getProtocolTitle($type){
        if ($type == 'ingoing') {
            return 'Εισερχόμενο';
        }
        elseif ($type == 'outgoing') {
            return 'Εξερχόμενο';
        }
        return abort(404);
    }
}
