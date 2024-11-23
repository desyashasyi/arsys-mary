<div>
    <x-card title="In Progress" shadow separator>
        <div>
            <x-input wire:model.live="search" placeholder="Search student name" inline/>
            <br>
        </div>
       
        <x-table :headers="$headers" :rows="$researchs" wire:model="expanded" no-headers expandable with-pagination>
 
            @scope('cell_studentName', $research)
                <b style="color:blue">{{$research->student->program->code}}.{{$research->student->number}}</b>
                <br>
                {{ $research->student->first_name }} {{ $research->student->last_name }}
            @endscope
            {{-- Special `expansion` slot --}}
            @scope('expansion', $research)
                <div>
                    <b>{{$research->code}}</b>
                    <br>
                    {{$research->title}}
                    <x-menu-separator />
                    <livewire:mobile.staff.research.supervise.approval :researchId="$research->id" :wire:key="'approval-'.$research->id">
                    <x-menu-separator />
                    <livewire:mobile.components.supervise.report :researchId="$research->id" :wire:key="'approval-'.$research->id">
                </div>
            @endscope
        </x-table>
    </x-card>
</div>
