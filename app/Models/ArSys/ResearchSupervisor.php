<?php

namespace App\Models\ArSys;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchSupervisor extends Model
{
    use HasFactory;
    protected $fillable = [];
    protected $guarded = [];
    protected $table = 'arsys_research_supervisor';

    public function staff(){
        return $this->belongsTo(Staff::class, 'supervisor_id','id' );
    }

    public function research(){
        return $this->belongsTo(Research::class, 'research_id', 'id');
    }

    public function meeting(){
        return $this->hasMany(ResearchSupervise::class, 'supervisor_id', 'id');
    }

    public function defenseSupervisorPresence(){
        return $this->hasOne(DefenseSupervisorPresence::class, 'research_supervisor_id','id');
    }

    public function finaldefenseSupervisorPresence(){
        return $this->hasOne(FinalDefenseSupervisorPresence::class, 'research_supervisor_id','id');
    }
    
}
