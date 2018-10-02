<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        $data['pagetitle']=__('Dashboard');
        return view('admin.index',$data);
    }


    public function userList()
    {
        $data['pagetitle'] = __('Active User List');
        $data['search_string'] = '';
        if (isset($_GET['q'])) {
            $data['search_string'] = $_GET['q'];
        }
        $data['items'] = User::where(['activestatus' => 1 ]);

        if (!empty($data['search_string'])) {
            $search_token = explode(' ', $data['search_string']);
            foreach ($search_token as $search) {
                $data['items'] = $data['items']->where(function ($query) use ($search) {
                    $query->where('first_name', 'LIKE', '%' . $search . '%')
                        ->orWhere('last_name', 'LIKE', '%' . $search . '%')
                        ->orWhere('designation', 'LIKE', '%' . $search . '%')
                        ->orWhere('email', 'LIKE', '%' . $search . '%');
                });
            }
        }

        $data['items'] = $data['items']->paginate(PAGINATE_SMALL);
        return view('admin.user.list', $data);


    }

    public function addUser()
    {
        $data['pagetitle']=__('Add New User');
        return view('admin.user.addEdit',$data);
    }

    public function userEdit($id)
    {
        $data['pagetitle']=__('Edit User');
        if(!empty($id) && is_numeric($id))
        {
            $data['user']=User::findOrFail($id);
            return view('admin.user.addEdit',$data);
        }
    }

    public function saveUser(Request $request)
    {
        $message = '';
        $rules = [
            'first_name' => 'required|max:256',
            'last_name' => 'required|max:256',
            'designation' => 'required',
            'role' => 'required'
        ];
        if (!empty($request->edit_id)) {
            if (!empty($request->password)) {
                $rules['password'] = 'required|confirmed|min:6';
            }
        } else {
            $rules['email'] = 'required|email|max:256|unique:users,email';
            $rules['password'] = 'required|confirmed|min:6';
            $rules['password_confirmation'] = 'required|min:6';
        }
        $this->validate($request, $rules);
        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'mobile' => $request->mobile,
            'designation' => $request->designation,
            'reset_code' => md5($request->get('email').uniqid().randomString(5)),
            'role' => $request->role,
            'activestatus' => $request->get('activestatus',1),
        ];
        if (!empty($request->edit_id)) {
            if (!empty($request->password)) {
                $data['password'] = bcrypt($request->password);
            }
        } else {
            $data['email'] = $request->email;
            $data['password'] = bcrypt($request->password);
        }

        if (!empty($request->edit_id)) {
            User::where(['id' => $request->edit_id])->update($data);
            $where = [
                'user_id' => $request->edit_id
            ];
            $insert = [
                'city' => $request->city,
                'sex' => $request->get('sex',1),
                'country' => $request->country,
                'street1' => $request->street1,
                'street2' => $request->street2,
                'state' => $request->state,
                'zip' => $request->zip,

            ];
            $updated = UserInfo::updateOrCreate($where, $insert);
            $message = __('User is Updated Successfully');
        } else {
            User::create($data);
            $message = __('User is Created Successfully');
        }

        return redirect()->back()->with('success', $message);
    }


    public function userDelete($id)
    {
        if(isset($id) && is_numeric($id)){
            User::where(['id'=>$id])->delete();
            return redirect()->back()->with(['success'=>__('Deleted Successfully')]);
        } else {
            return redirect()->back()->with(['success'=>__('User not found')]);
        }
    }

}
