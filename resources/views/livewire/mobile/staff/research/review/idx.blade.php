<div>
    <x-card title="Proposal review" shadow separator>
        <div>
            <x-input wire:model.live="search" placeholder="Search student name" inline/>
            <br>
        </div>
       
        <x-table :headers="$headers" expandable-key="$research->id" :rows="$researchs" wire:model="expanded" no-headers expandable with-pagination>
 
            @scope('cell_studentName', $research)
                <b style="color:blue">{{$research->student->program->code}}.{{$research->student->number}}</b>
                <br> 
                {{ $research->student->first_name }} {{ $research->student->last_name }}
                &nbsp;=>&nbsp;
                @if($research->review)
                    @foreach($research->reviewer as $reviewer)
                        @if($reviewer->decision_id ==null)
                            {{$reviewer->staff->code}}-Not defined
                        @endif
                        @if($reviewer->decision_id == 
                            \App\Models\ArSys\ResearchReviewDecisionType::where('code', 'APP')->first()->id)
                            <x-badge value="{{$reviewer->staff->code}}-{{$reviewer->decision->description}}" class="badge-green" />

                        @endif
                        @if($reviewer->decision_id == 
                            \App\Models\ArSys\ResearchReviewDecisionType::where('code', 'RJC')->first()->id)
                                <x-badge value="{{$reviewer->staff->code}}-{{$reviewer->decision->description}}" class="badge-red" />
                            @endif
                            <br>
                    @endforeach
                @endif
                <x-menu-separator />
            @endscope
            {{-- Special `expansion` slot --}}
            @scope('expansion', $research)
                <div>
                    <b>{{$research->code}}</b>
                    <br>
                    {{$research->title}}
                    &nbsp; => &nbsp;
                    @if(\App\Models\ArSys\ResearchConfig::where('program_id', $research->student->program_id)
                        ->where('config_base_id', \App\Models\ArSys\ResearchConfigBase::where('code', 'RESEARCH_FILE')->first()->id)
                         ->first()->status == null)
                        <a href="{{$research->file}}" target = "_blank"><u style="color:blue;">File of proposal</u></a>
                    @elseif(\App\Models\ArSys\ResearchConfig::where('program_id', $research->student->program_id)
                        ->where('config_base_id', \App\Models\ArSys\ResearchConfigBase::where('code', 'RESEARCH_FILE')->first()->id)
                        ->first()->status == null) 
                        && $research->proposalFile != null)
                        @foreach ($research->proposalFile as $file)
                            @if ($research->proposalFile != null)
                                <a href="{{url('/')}}{{ Storage::disk('local')->url($file->filename)}}" target="blank"><b><u>File of proposal</u></b></a>
                            @else
                                File missing
                            @endif
                        @endforeach
                    @endif
                    @if(\App\Models\ArSys\ResearchConfig::where('program_id', $research->student->program_id)
                        ->where('config_base_id', \App\Models\ArSys\ResearchConfigBase::where('code', 'RESEARCH_FILE')->first()->id)
                        ->first()->status == 1)
                        @foreach ($research->proposalFile as $file)
                            @if ($research->proposalFile != null)
                                <a href="{{url('/')}}{{ Storage::disk('local')->url($file->filename)}}" target="blank"><b><u>File of proposal</u></b></a>
                            @else
                                File missing
                            @endif
                        @endforeach
                    @endif   
                    <x-menu-separator />
                    
                    <livewire:mobile.staff.research.review.approval :researchId="$research->id" :wire:key="'approval-'.$research->id">
                </div>
            @endscope
        </x-table>
    </x-card>
</div>
