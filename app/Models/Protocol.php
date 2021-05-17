<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Protocol extends Model
{
    const CANCELED = 'Canceled';
    const ACTIVE = 'Active';

    const IN_PREFIX = 'ΓΑΒ-ΕΙΣ-';
    const OUT_PREFIX = 'ΓΑΒ-ΕΞ-';
    const INGOING = 'ingoing';
    const OUTGOING = 'outgoing';

    protected $table = 'protocols';

    protected $fillable = ['protocol_number', 'protocol', 'protocol_date', 'type', 'status', 'ingoing_protocol', 'ingoing_protocol_date',
        'creator', 'receiver', 'title', 'description', 'created_at', 'updated_at', 'canceled_at'];

    public function getProtocolType($type){
        if ($type == self::INGOING) {
            return self::INGOING;
        }
        elseif ($type == self::OUTGOING) {
            return self::OUTGOING;
        }
        return abort(500);
    }
}
