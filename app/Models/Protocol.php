<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Protocol extends Model
{
    const CANCELED = 'Canceled';
    const ACTIVE = 'Active';

    const IN_PREFIX = 'ΓΑΒ-ΕΙΣ-';
    const OUT_PREFIX = 'ΓΑΒ-ΕΞ-';
    const INCOMING = 'incoming';
    const OUTGOING = 'outgoing';

    protected $table = 'protocols';

    protected $fillable = ['protocol', 'protocol_date', 'type', 'status', 'incoming_protocol', 'incoming_protocol_date',
        'creator', 'receiver', 'title', 'description', 'created_at', 'updated_at', 'canceled_at'];

    static array $protocol_status = [
        'Active' => 'success',
        'Canceled' => 'danger'
    ];

    public function getProtocolType($type){
        if ($type == self::INCOMING) {
            return self::INCOMING;
        }
        elseif ($type == self::OUTGOING) {
            return self::OUTGOING;
        }
        return abort(500);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    public function scopeCanceled($query) {
        $query->where('status',self::CANCELED);
    }
    public function scopeActive($query) {
        $query->where('status',self::ACTIVE);
    }
    public function scopeIncoming($query) {
        $query->where('type',self::INCOMING);
    }
    public function scopeOutgoing($query) {
        $query->where('type',self::OUTGOING);
    }
}
