<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Browser;
use Auth;
class SsoUpi extends Component
{
    public function render()
    {
        return view('livewire.auth.sso-upi');
    }

    public function mount()
    {
        //$userCode = '197608272009121001';
        $userCode = cas()->user();
        if (is_null(User::where('sso', $userCode)->first())){
            if (strlen($userCode) > 7){
                $user = User::create([
                    'sso' => $userCode,
                ]);
                $user->attachRole('staff');

                if(!is_null($user->staff)){
                    User::where('sso', $userCode)->update([
                        'name' => $user->staff->code,
                    ]);

                    Staff::where('sso', $userCode)->update([
                        'user_id' => $user->id,
                    ]);
                }
            }else{
               
                $user = User::create([
                    'name' => 's'.$userCode,
                    'sso' => $userCode,
                ]);
                $user->attachRole('student');
            }
        }

        $user = User::where('sso', $userCode)->first();

        
        if(($user->email == null || $user->email == "")){
            return redirect()->route('arsys.auth.email',['userCode' => $userCode]);
        }
        
        Auth::login($user);
        if(strlen(Auth::user()->sso) == 4 ){
            return redirect()->route('admin');
        }elseif(strlen(Auth::user()->sso) > 7){
            if(Browser::isMobile()){
                return redirect()->route('mobile.staff');
            }else{
                return redirect()->route('mobile.staff');
                //return redirect()->route('staff');
            }
        }else{
            return redirect()->route('student');
        }
      
    }
}
