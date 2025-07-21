<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\RoleChangeService;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class RoleChangeController extends Controller
{
    protected $roleChangeService;

    public function __construct(RoleChangeService $roleChangeService)
    {
        $this->roleChangeService = $roleChangeService;
    }

    // قائمة الأدمنز (resource index)
    public function index(Request $request)
    {
        $searchKey = $request->input('searchKey');
        $result = $this->roleChangeService->adminList($searchKey);
        return view('admin.roleChange.adminList', $result);
    }

    // حذف أدمن (resource destroy)
    public function destroy(User $user)
    {
        $this->roleChangeService->deleteAdminAccount($user);
        Alert::success(__('messages.delete_success'), __('messages.admin_account_deleted_successfully'));
        return back();
    }

    // تحويل أدمن إلى يوزر
    public function changeUserRole(User $user)
    {
        $this->roleChangeService->changeUserRole($user);
        Alert::success(__('messages.change_user_account_success'), __('messages.user_account_changed_successfully'));
        return back();
    }

    // تحويل يوزر إلى أدمن
    public function changeAdminRole(User $user)
    {
        $this->roleChangeService->changeAdminRole($user);
        Alert::success(__('messages.change_admin_account_success'), __('messages.admin_account_changed_successfully'));
        return back();
    }

    // قائمة المستخدمين العاديين
    public function userList(Request $request)
    {
        $searchKey = $request->input('searchKey');
        $result = $this->roleChangeService->userList($searchKey);
        return view('admin.roleChange.userList', $result);
    }
}
