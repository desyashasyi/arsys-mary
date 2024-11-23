<div>
    <x-menu-sub title="Research" icon="o-sparkles">
        <x-menu-item title="Supervise" icon="o-archive-box" link="/mobile/staff/research/supervise" />
        <x-menu-item title="Review" icon="o-wifi" link="/mobile/staff/research/review" />
    </x-menu-sub>
    <x-menu-sub title="Event" icon="o-sparkles">
        <x-menu-item title="Pre-defense" icon="o-wifi" link="/mobile/staff/event/pre-defense" />
        <x-menu-item title="Final-defense" icon="o-archive-box" link="/mobile/staff/event/final-defense" />
    </x-menu-sub>
    @if(Auth::user()->hasRole('super_admin'))
        <livewire:menu.super-admin-mobile>
    @endif{{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
</div>
