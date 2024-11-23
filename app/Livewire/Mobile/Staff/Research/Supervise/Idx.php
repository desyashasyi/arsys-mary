<?php

namespace App\Livewire\Mobile\Staff\Research\Supervise;

use Livewire\Component;
use App\Models\ArSys\Research;
use Livewire\WithPagination;
use Auth;
class Idx extends Component
{
    use WithPagination;
    public $search;
    public array $expanded=[];
    public $headers = [
        ['key' => 'id', 'label' => '#', 'class' => 'hidden'],
        ['key' => 'studentName', 'label' => 'Student'],
    ];
    public function render()
    {
        
       $researchs = Research::whereHas('supervisor', function($query){
                return $query->where('supervisor_id', Auth::user()->staff->id);
            })
            ->whereHas('active', function($query){
                $query->where('status', 1);
            })
            ->orderBy('milestone_id', 'DESC')
            ->paginate($perPage = 5, $columns = ['*'], $pageName = 'researchSupervisePage');

            if($this->search != null){
                $researchs = Research::whereHas('supervisor', function($query){
                        return $query->where('supervisor_id', Auth::user()->staff->id);
                    })
                    ->whereHas('active', function($query){
                        $query->where('status', 1);
                    })
                    ->whereHas('student', function($query){
                        return $query->where('first_name', 'like', '%'.$this->search.'%');
                    })
                    ->orderBy('milestone_id', 'DESC')
                    ->paginate($perPage = 1, $columns = ['*'], $pageName = 'researchSupervisePage');
            }            
 
        
        return view('livewire.mobile.staff.research.supervise.idx', ['researchs' => $researchs]);
    }
    
}
