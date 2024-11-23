<?php

namespace App\Models\ArSys;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventSession extends Model
{
    use HasFactory;
    protected $fillable = [];
    protected $guarded = [];
    protected $table = 'arsys_event_session';
}
