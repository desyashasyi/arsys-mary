<?php

namespace App\Livewire\Mobile\Staff\Research\Supervise;

use Livewire\Component;
use App\Models\ArSys\Research;
use App\Models\ArSys\DefenseApproval;
use App\Models\ArSys\ResearchMilestone;
use App\Models\ArSys\ResearchLog;
use App\Models\ArSys\ResearchLogType;
use Carbon\Carbon;
use Auth;
class Approval extends Component
{
    public $research;
    public $researchId;
    //protected $listeners = ['refreshApproval_ArSysComponentsResearchApproval' => '$refresh'];
    public function render()
    {
        $this->research = Research::find($this->researchId);
        return view('livewire.mobile.staff.research.supervise.approval');
    }
    public function mount($researchId){
        $this->researchId = $researchId;
    }
    public function seminarApproval($approvalId){
        if(DefenseApproval::find($approvalId)->decision == null){
            DefenseApproval::find($approvalId)->update([
                'decision' => 1,
                'approval_date' => Carbon::now(),
            ]);
            /**
             * Send notification to student that Pre-defense request has been approved
             */
            $research = Research::find(DefenseApproval::find($approvalId)->research_id);
            $text = 'Hi '.$research->student->first_name.', '.DefenseApproval::find($approvalId)->staff->code.
                    ' has approved your request of your seminar approval';
            //$this->emit('sendMessage_ArSysComponentsTelegramSendMessage', DefenseApproval::find($approvalId)->staff->user->id, $text);
        }else{
            DefenseApproval::find($approvalId)->update([
                'decision' => null,
                'approval_date' => null,
            ]);
        }
        if(!(Research::find($this->researchId)
            ->seminarApproval->contains('decision', null))){
            Research::find($this->researchId)->update([
                'milestone_id' => ResearchMilestone::where('code', 'Seminar')
                                ->where('phase', 'Approved')->where('sequence', 6)->first()->id,
            ]);
            if(is_null(Research::find($this->researchId)->SEMAPPROVED)){
                ResearchLog::create([
                    'research_id' => DefenseApproval::find($approvalId)->research_id,
                    'loger_id' => Auth::user()->id,
                    'type_id' => ResearchLogType::where('code','SEMAPPROVED')->first()->id,
                    'message' => ResearchLogType::where('code','SEMAPPROVED')->first()->description,
                    'status' => 1,
                ]);
            }
        }else{
              //Decrement milestone
            Research::find($this->researchId)->update([
                'milestone_id' => ResearchMilestone::where('code', 'Seminar')
                                ->where('phase', 'Submitted')->where('sequence', 5)->first()->id,
            ]);
        }
    }
}
