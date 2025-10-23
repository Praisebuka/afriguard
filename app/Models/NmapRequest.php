<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class NmapRequest extends Model
{
    protected $table = 'nmap_requests';

    protected $fillable = [ 'user_id', 'target', 'status', 'output_file', 'result', 'started_at', ];

    protected $dates = [ 'started_at', 'completed_at', 'created_at', ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}