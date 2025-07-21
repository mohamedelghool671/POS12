<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\UserDashboardService;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\User\SendMessageRequest;
use App\Http\Requests\User\UpdateUserProfileRequest;
use App\Http\Requests\User\ChangeUserPasswordRequest;

class UserDashboardController extends Controller
{
    protected $userDashboardService;

    public function __construct(UserDashboardService $userDashboardService)
    {
        $this->userDashboardService = $userDashboardService;
    }

    public function index()
    {
        $data = $this->userDashboardService->getDashboardData();
        return view('user.home', $data);
    }

    public function profileDetails()
    {
        return view('user.profile');
    }

    public function profileUpdate(UpdateUserProfileRequest $request)
    {
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'image' => $request->file('image'),
            'oldImage' => $request->input('oldImage')
        ];
        $this->userDashboardService->updateProfile(Auth::user(), $data);

        Alert::success(
            __('messages.update_success'),
            __('messages.profile_updated_for_user')
        );
        return to_route('userProfileDetails');
    }

    public function changePassword()
    {
        return view('user.changeUserPassword');
    }

    public function changeUserPassword(ChangeUserPasswordRequest $request)
    {
        $result = $this->userDashboardService->changeUserPassword(Auth::user(), $request->input('newPassword'));
        if ($result) {
            Alert::success(
                __('messages.update_success'),
                __('messages.password_updated_for_user')
            );
        }
        return back();
    }

    public function contactUs()
    {
        return view('user.contact');
    }

    public function sendMessage(SendMessageRequest $request)
    {
        $userId = Auth::user()->id;
        $data = [
            'title' => $request->input('subject'),
            'message' => $request->input('message'),
        ];
        $this->userDashboardService->sendMessage(Auth::user(), $data);
        return back()->with('success', __('messages.message_sent_for_user'));
    }
}
