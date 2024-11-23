<?php

namespace App\Livewire\Mobile\Components\Supervise;

use Livewire\Component;
use App\Models\ArSys\Research;

class Report extends Component
{
    public $research;
    public $researchId;
    public $addMeeting;
    public $content;
    public function render()
    {
        if($this->researchId){
            $this->research = Research::find($this->researchId);
        }
        return view('livewire.mobile.components.supervise.report');
    }

    public function mount($researchId){
        $this->researchId = $researchId;
    }

    public function save(){
        dd($this->text);
    }
}
