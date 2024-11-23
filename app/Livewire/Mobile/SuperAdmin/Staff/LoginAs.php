<?php

namespace App\Livewire\Mobile\SuperAdmin\Staff;

use Livewire\Component;
use App\Models\ArSys\Staff;
use App\Models\User;
use Illuminate\Support\Collection;
use Auth;
class LoginAs extends Component
{
    // Selected option
    public ?int $user_searchable_id = null;
 
    // Options list
    public Collection $usersSearchable;

    public $users;

    public function render()
    {
        return view('livewire.mobile.super-admin.staff.login-as');
    }

    public function mount()
    {
        // Fill options when component first renders
        $this->search();
    }
 
    // Also called as you type
    public function search(string $value = '')
    {
        // Besides the search results, you must include on demand selected option
        $selectedOption = Staff::where('id', $this->user_searchable_id)->get();
        $this->staffs = $selectedOption;
        $this->usersSearchable = Staff::query()
            ->where('first_name', 'like', "%$value%")
            ->orwhere('code', 'like', "%$value%")
            ->take(1)
            ->orderBy('first_name')
            ->get()
            ->merge($selectedOption);     // <-- Adds selected option
    }

    public function loginAs($staffId){
        Auth::login(User::where('sso', Staff::find($staffId)->sso)->first());
        return redirect()->route('mobile.staff');
    }
}
