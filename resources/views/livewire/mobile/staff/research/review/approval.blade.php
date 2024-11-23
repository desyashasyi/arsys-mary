<div>
    @php
        $options = [
            ['id' => 1, 'name' => 'Approve'],
            ['id' => 2, 'name' => 'Reject'],
        ];
    @endphp
    <x-radio label="Select desicion" :options="$options" wire:click="refreshApproval" wire:model.live="approval" />
</div>
