<?php

namespace App\Models\ArSys;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchLog extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = [];
    protected $table = 'arsys_research_log';
}
