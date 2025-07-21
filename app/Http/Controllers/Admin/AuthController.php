<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\AuthService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\Admin\ResetPasswordRequest;
use App\Http\Requests\Admin\ChangePasswordRequest;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    //change password page
    public function changePasswordPage(){
        return view('admin.password.changePassword');
    }

    public function changePassword(ChangePasswordRequest $request){
        $user = Auth::user();
        if(Hash::check($request->oldPassword, $user->password)){
            $this->authService->changePassword($user, $request->newPassword);
            Alert::success(__('messages.update_success'), __('messages.password_updated_successfully'));
            return back();
        } else {
            Alert::error(__('messages.error'), __('messages.old_password_incorrect'));
            return back();
        }
    }

    public function resetPasswordPage(){
        return view('admin.password.resetPassword');
    }

    public function resetPassword(ResetPasswordRequest $request){
        $user = User::where('email',$request->email)->first();
        if($user){
            $this->authService->resetPassword($user);
            Alert::success(__('messages.success'), __('messages.password_reset_to_default'));
        } else {
            Alert::error(__('messages.error'), __('messages.user_not_found'));
        }
        return back();
    }
}
