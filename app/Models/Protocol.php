<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Protocol extends Model
{
    use HasFactory;

    protected $table = 'protocols';

    protected $fillable = ['protocol_number', 'protocol', 'protocol_date', 'status', 'incoming_protocol', 'incoming_protocol_date',
        'creator', 'receiver', 'title', 'description', 'created_at', 'updated_at', 'canceled_at'];
}
