<div>
    <x-card title="Login As (Staff)" shadow separator>
        <x-choices
        label="Searchable + Single + Debounce + Min chars"
        wire:model="user_searchable_id"
        :options="$usersSearchable"
        search-function="search"
        debounce="300ms" {{-- Default is `250ms`--}}
        min-chars="2" {{-- Default is `0`--}}
        single
        searchable>

        @scope('item', $staffs)
            <x-list-item :item="$staffs">
                <x-slot:avatar>
                    <x-icon name="o-user" class="bg-orange-100 p-2 w-8 h8 rounded-full" />
                </x-slot:avatar>
                <x-slot:value>
                    {{$staffs->code}}
                </x-slot:value>
                <x-slot:sub-value>
                    {{$staffs->first_name}} {{$staffs->last_name}}
                </x-slot:sub-value>
                <x-slot:actions>
                <x-icon name="o-check-badge" class="cursor-pointer text-green-600" wire:click="loginAs({{$staffs->id}})" spinner />
                </x-slot:actions>
            </x-list-item>
        @endscope
 
        {{-- Selection slot--}}
        @scope('selection', $staff)
            {{ $staff->code }} | {{ $staff->first_name }} {{ $staff->last_name }} 
        @endscope
       
        </x-choices>
    </x-card>
</div>
