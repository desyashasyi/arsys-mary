<div>
    @if($research)
        <div class="row">
            <div class="col-sm-12">
                @if($research->predefenseApproval->isNotEmpty() 
                    || $research->finaldefenseApproval->isNotEmpty()
                    || $research->seminarApproval->isNotEmpty())
                    <i class="fas fa-spinner"></i>
                    <b><x-icon name="o-check-badge"/>Research Approval </b>
                    <br>
                    @if($research->predefenseApproval->isNotEmpty())
                        @foreach($research->predefenseApproval as $index => $approval)
                            {{$index+1}}. {{$approval->staff->code}}-Pre defense&nbsp;
                                @if(Auth::user()->staff)
                                    @if($approval->staff->id == Auth::user()->staff->id)
                                        @if($approval->decision == null)
                                            <x-icon label="Approved" name="o-check-badge" class="cursor-pointer text-gray-600" wire:click="predefenseApproval({{$approval->id}})" spinner />
                                        @else
                                            <span style="color:green; cursor: pointer;" wire:click="predefenseApproval({{$approval->id}})"><i class="fas fa-md fa-check-circle"></i> Approved</span>
                                        @endif
                                    @else
                                        @if($approval->decision == null)
                                            <span style="color:gray; cursor: pointer;"><i class="fas fa-md fa-check-circle"></i> Approved ({{$approval->updated_at}})</span>
                                        @else
                                            <span style="color:green; cursor: pointer;"><i class="fas fa-md fa-check-circle"></i> Approved ({{$approval->updated_at}})</span>
                                        @endif
                                    @endif
                                @endif

                                @if(Auth::user()->student)
                                    @if($approval->decision == null)
                                        <span style="color:gray;"><i class="fas fa-md fa-check-circle"></i> Approved</span>
                                    @else
                                        <span style="color:green;"><i class="fas fa-md fa-check-circle"></i> Approved</span>
                                    @endif
                                @endif
                            <br>
                        @endforeach
                    @endif

                    @if($research->finaldefenseApproval->isNotEmpty())
                        @foreach($research->finaldefenseApproval as $index => $approval)
                            {{$index+1}}. {{$approval->staff->code}}-Final defense&nbsp;
                                @if(Auth::user()->staff)
                                    @if($approval->staff->id == Auth::user()->staff->id)
                                        @if($approval->decision == null)
                                            <span style="color:gray; cursor: pointer;" wire:click="finaldefenseApproval({{$approval->id}})"><i class="fas fa-md fa-check-circle"></i> Approved</span>
                                        @else
                                            <span style="color:green; cursor: pointer;" wire:click="finaldefenseApproval({{$approval->id}})"><i class="fas fa-md fa-check-circle"></i> Approved</span>
                                        @endif
                                    @else
                                        @if($approval->decision == null)
                                            <span style="color:gray;"><i class="fas fa-md fa-check-circle"></i> Approved</span>
                                        @else
                                            <span style="color:green;"><i class="fas fa-md fa-check-circle"></i> Approved</span>
                                        @endif
                                    @endif
                                @endif

                                @if(Auth::user()->student)
                                    @if($approval->decision == null)
                                        <span style="color:gray;"><i class="fas fa-md fa-check-circle"></i> Approved</span>
                                    @else
                                        <span style="color:green;"><i class="fas fa-md fa-check-circle"></i> Approved</span>
                                    @endif
                                @endif
                            <br>
                        @endforeach
                    @endif
                    @if($research->seminarApproval->isNotEmpty())
                        @foreach($research->seminarApproval as $index => $approval)
                            {{$index+1}}. {{$approval->staff->code}}-Seminar&nbsp;
                                @if(Auth::user()->staff)
                                    @if($approval->staff->id == Auth::user()->staff->id)
                                        @if($approval->decision == null)
                                            - 
                                            <span class="cursor-pointer text-gray-200" wire:click="seminarApproval({{$approval->id}})">
                                                <x-icon name="o-check-circle"  /> Approved ({{\carbon\Carbon::parse($approval->updated_at)->format('d/m/Y')}})
                                            </span>
                                        @else
                                            - 
                                            <span class="cursor-pointer text-green-600" wire:click="seminarApproval({{$approval->id}})">
                                                <x-icon name="o-check-circle"  /> Approved ({{\carbon\Carbon::parse($approval->updated_at)->format('d/m/Y')}})
                                            </span>
                                        @endif
                                    @else
                                        @if($approval->decision == null)
                                            <span style="color:gray; cursor: pointer;"><i class="fas fa-md fa-check-circle"></i> Approved ({{$approval->updated_at}})</span>
                                        @else
                                            <span style="color:green; cursor: pointer;"><i class="fas fa-md fa-check-circle"></i> Approved ({{$approval->updated_at}})</span>
                                        @endif
                                    @endif
                                @endif

                                @if(Auth::user()->student)
                                    @if($approval->decision == null)
                                        <span style="color:gray;"><i class="fas fa-md fa-check-circle"></i> Approved</span>
                                    @else
                                        <span style="color:green;"><i class="fas fa-md fa-check-circle"></i> Approved</span>
                                    @endif
                                @endif
                            <br>
                        @endforeach
                    @endif
                @endif
            </div>
        </div>
    @endif
</div>
