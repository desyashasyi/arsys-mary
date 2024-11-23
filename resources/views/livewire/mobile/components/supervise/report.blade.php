<div>
    
    <x-drawer
        wire:model="addMeeting"
        title="Progress of Supervision"
        subtitle="Add meeting message"
        separator
        with-close-button
        close-on-escape
        right
        class="w-11/12 lg:w-1/3"
    >
        <div>
            @if($research)
                @if(Auth::user()->staff)
                    <i style="color: red">
                        Student did not write any meeting report
                    </i>
                @endif
            @endif
            <br>
            {{-- <x-editor wire:model.live="text" /> --}}
        </div>

        <x-slot:actions>
            <x-button wire:click="save" label="Save" class="btn-primary sm" icon="o-arrow-up-tray" />
        </x-slot:actions>
    </x-drawer>

    <b><span style="color:blue; cursor: pointer;" @click="$wire.addMeeting = true">
        <x-icon name="o-check-circle"/> Research Meeting
    </span>
    </b>
    
</div>
