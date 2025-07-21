<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\Admin\StoreAdminRequest;
use App\Http\Requests\Admin\UpdateProfileRequest;

class ProfileController extends Controller
{
    //profile details
    public function profileDetails(){
           return view('admin.profile.details');
    }

    //create admin account
    public function createAdminAccount(){
        return view('admin.profile.createAdminAcct');
    }

    //create new admin account
    public function create(StoreAdminRequest $request){
        $adminAccount = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'provider' => 'simple'
        ];

        User::create($adminAccount);
        Alert::success(__('messages.success'), __('messages.new_admin_account_created_successfully'));
        return back();
    }


    //profile update
    public function update(UpdateProfileRequest $request){
        $adminData = $this -> requestAdminData($request);


        if($request->hasFile('image')){
            //delete old image
            $oldImageName = $request->oldImage;
            if($request->oldImage != null){
                if(file_exists(public_path('adminProfile/'.$request->oldImage))){
                    unlink(public_path('adminProfile/'.$request->oldImage));
                }
            }
            //upload new image
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path(). '/adminProfile/' , $fileName);
            $adminData['profile'] = $fileName;
        }
        else{
            $adminData['profile']= $request->oldImage;
        }


        // dd($adminData);
        User::where('id',Auth::user()->id)->update($adminData);
        Alert::success(__('messages.update_success'), __('messages.profile_updated_successfully'));
        return back();

    }

    //direct account Profile
    public function accountProfile($id){
        $account = User::where('id',$id)->first();
        return view('admin.profile.accountProfile',compact('account'));
    }


    //request admin data
    private function requestAdminData($request){

        // dd($request->all()) ;
        $data =[];
        if(Auth::user()->name != null){
            $data['name'] =Auth::user()->provider == 'simple' ? $request->name : Auth::user()->name;
        }else{
            $data['nickname'] =Auth::user()->provider == 'simple' ? $request->name : Auth::user()->name;
        }

        $data['email'] = Auth::user()->provider == 'simple' ? $request->email : Auth::user()->email;
        $data['phone'] =$request->phone;
        $data['address'] =$request->address;

        return $data;
    }

}
