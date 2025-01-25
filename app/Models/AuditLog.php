<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $fillable = [
        'user_id', 'event', 'model', 'old_data', 'new_data', 'ip_address',
    ];

    //define user relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
