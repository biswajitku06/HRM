<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Userinfo;
use Illuminate\Support\Facades\Validator;
use Hash;

class UserController extends Controller
{
    public function userProfile($userid)
    {
        $data['pagetitle'] = __('User Profile');
        $data['user'] = User::where(['id' => $userid])->first();
        return view('user.userprofile', $data);
    }

    public function editProfile($id)
    {
        $data['pagetitle'] = __('Edit User Profile');
        $data['user'] = User::where(['id' => $id])->first();
        return view('user.updateprofile', $data);
    }

    public function passChange($id)
    {
        $data['pagetitle'] = __('User Password Change');
        $data['id'] =$id;
        return view('user.passchange',$data);
    }

    public function updateProfileProcess(Request $request)
    {
        $message = '';
        $rules = [
            'first_name' => 'required|max:256',
            'last_name' => 'required|max:256',
            'designation' => "required"
        ];

        $this ->validate($request, $rules);

        if (!empty($request->edit_id))
            $userdata = User::findOrFail($request->edit_id);

        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'mobile' => $request->mobile,
            'designation' => $request->designation
        ];

        if (!empty($request->image)) {
            $old_img = '';
            if (isset($userdata)) {
                $old_img = $userdata->image;
            }
            $data['image'] = fileUpload($request->file('image'), path_user_image(), $old_img);
        }

        if (!empty($request->edit_id)) {
            User::where(['id' => $request->edit_id])->update($data);
            $where = [
                'user_id' => $request->edit_id,
            ];

            $insert = [
                'city' => $request->city,
                'sex' => $request->get('sex', 1),
                'country' => $request->country,
                'street1' => $request->street1,
                'street2' => $request->street2,
                'state' => $request->state,
                'zip' => $request->zip,
            ];
            Userinfo::updateOrCreate($where,$insert);
            $message=__('User Updated Successfully');

        }
        return redirect()->back()->with('success',$message);


    }

    public function savePass(Request $request)
    {
        $rules=[
            'old_password' => 'required',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required'
        ];

        $this->validate($request,$rules);
        $user=User::where(['id'=>$request->edit_id])->first();

        $old_password=$request->old_password;

        if(Hash::check($old_password,$user['password']))
        {
           // $user->password=bcrypt($request->password);
            $user['password']=bcrypt($request->password);
            $user->save();
            return redirect()->back()->with(['success'=>__('Update Successfully.')]);
        }
        else
            return redirect()->back()->with(['dismiss'=>__('Incorrect old password !')]);
    }
}
