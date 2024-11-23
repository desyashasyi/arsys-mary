<?php

namespace App\Livewire\Mobile\Staff\Research\Review;

use Livewire\Component;
use App\Models\ArSys\ResearchReview;
use App\Models\ArSys\ResearchReviewDecisionType;
use Auth;
class Approval extends Component
{
    public $approval;
    public $researchId;
    public function render()
    {
        if($this->approval == 1){
            ResearchReview::where('research_id',$this->researchId)
                ->where('reviewer_id', Auth::user()->staff->id)->update([
                    'decision_id' => ResearchReviewDecisionType::where('code', 'APP')->first()->id,
            ]);
            
        }else{
            ResearchReview::where('research_id',$this->researchId)
            ->where('reviewer_id', Auth::user()->staff->id)->update([
                'decision_id' => ResearchReviewDecisionType::where('code', 'RJC')->first()->id,
            ]);
            
        }
        return view('livewire.mobile.staff.research.review.approval');
    }

    public function mount($researchId){
        $this->researchId = $researchId;
        $this->approval = ResearchReview::where('research_id',$this->researchId)->first()->decision_id;

    }

    public function refreshApproval(){
        $this->dispatch('mobileStaff_ResearchReview_Idx_Refresh');
    }

}
