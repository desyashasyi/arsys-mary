<?php

namespace App\Livewire\Mobile\Staff\Research\Review;

use Livewire\Component;
use App\Models\ArSys\Research;
use Livewire\WithPagination;
use Livewire\Attributes\On; 
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

    #[On('mobileStaff_ResearchReview_Idx_Refresh')] 
    public function render()
    {
        
        $researchs = Research::whereHas('reviewer', function($query){
            return $query->where('reviewer_id', Auth::user()->staff->id)
                ->where('approval_date', null);
        })
        ->whereHas('review')
        ->orderBy('student_id', 'ASC')
        ->orderBy('milestone_id', 'ASC')
        ->paginate(10);
        
        return view('livewire.mobile.staff.research.review.idx', ['researchs' => $researchs]);
    }

}
