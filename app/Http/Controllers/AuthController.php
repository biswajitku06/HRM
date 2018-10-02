<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;;
use Illuminate\Support\Facades\Auth;
use App\User;
use Mail;
use Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.signin');
    }

    public function registration()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'conpassword' => 'required|min:8|same:password',
            'designation' => 'required'
        ];

        $messages = [
            'first_name.required' => __('First Name field can\'t be empty'),
            'last_name.required' => __('Last Name field can\'t be empty'),
            'password.required' => __('Password field can\'t be empty'),
            'designation.required' => __('Password field can\'t be empty'),
            'password.min' => __('Password length must be above 8 characters.'),
            //'password.regex' => __('Password must be consist of one Uppercase, one Lowercase, one Special Character and one Number!'),
            'email.required' => __('Email field can\'t be empty'),
            'email.unique' => __('Email Address already exists'),
            'email.email' => __('Invalid Email.'),
        ];
        $this->validate($request, $rules, $messages);

        $user = [
            'email' => $request->get('email'),
            'designation' => $request->get('designation'),
            'password' => Hash::make($request->get('password')),
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'reset_code' => md5($request->get('email') . uniqid() . randomString(5)),
            'activestatus' => $request->get('activestatus', 1),
            'role' => $request->get('role', 2),
        ];

        $response = User::create($user);
        if ($response) {
            return redirect()->route('login')->with('success', 'Registration Successful. Please login to your account');
        } else {
            return redirect()->back()->with('dismiss', 'Something went wrong . please try again');
        }

    }

    public function postlogin(Request $request)
    {
        $rules = [
          'email'=>'required|email',
          'password'=>'required'
        ];

        $messages =[
            'email.email'=>__('Invalid Email.'),
            'email.required'=>__('Your Email must be required'),
            'password.required'=>__('Your password must be needed')
        ];

        $this->validate($request,$rules,$messages);

        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            if(Auth::user()->role==2)
            {
                return redirect()->route('userDashboard')->with(['success'=>__('Login successfull')]);
            }
            else if(Auth::user()->role==1)
            {
                return redirect()->route('adminDashboard')->with(['success'=>__('Login  successfull')]);
            }
            else
            {
                Auth::logout();
                return redirect()->back()->with(['dismiss'=>__('please give your valid information')]);
            }
        }
        else
        {
            return redirect()->back()->with(['dismiss'=>__('Email or password are not matched')]);
        }

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function passchange()
    {
        return view('auth.forgetpass');
    }

    public function forgetpasswordprocess(Request $request)
    {
        $rules=[
            'email'=>'required'
        ];
        $messages=[
            'email.required'=>'Your email must requird'
        ];
        $email=$request->email;
        $validator=Validator::make($request->all(),$rules,$messages);
        if($validator->fails())
            return redirect()->back()->withInput();
        else
        {
            $user=User::where(['email'=>$email])->first();
            if($user)
            {
                $userName=$user->first_name.' '.$user->last_name;
                $userEmail=$user->email;
                $subject = __('Forget Password | HRM');
                $defaultmail = 'info@squaredbyte.com';
                $defaultname = 'HRM';
                $sentmail = Mail::send('email.forgetpass', ['data' => $user],
                    function ($message) use ($userName, $userEmail, $subject, $defaultmail, $defaultname) {
                        $message->to($userEmail, $userName)->subject($subject)->replyTo(
                            $defaultmail, $defaultname
                        );
                    }
                );

                if(count(Mail::failures())>0)
                {
                    return redirect()->back();

                }
                else
                {
                    return redirect()->route('forgetPasswordReset')->with(['success'=>__('Email send successfully')]);
                }
            }
            else
            {
                return redirect()->back()->with(['dismiss'=>__('your email is not correct')]);
            }
        }
    }

    public function forgetpasswordreset()
    {
        return view('auth.forgetpassreset');
    }

    public function forgetPasswordChange($reset_code)
    {
        $data['reset_code'] = $reset_code;
        $user = User::where(['reset_code' => $reset_code])->first();
        if ($user) {
            return view('auth.passchange', $data);
        } else {
            return redirect()->route('login')->with(['dismiss' => __('Invalid request!')]);
        }
    }
    public function forgetPasswordResetProcess(Request $request, $reset_code)
    {
        $rules = [
            'password' => 'required|min:6',
            'password_confirmation' => 'required|min:6|same:password',
        ];

        $messages = [
            'password.required' => __('Password Field can not be Empty'),
            'password.min' => __('Password length must be above 6 characters.'),
            'password.regex' => __('Password must be consist of one Uppercase, one Lowercase, one Special Character and one Number!'),
            'password_confirmation.required' => __('Confirm Password Field can not be Empty!')
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $user = User::where(['reset_code' => $reset_code])->first();
            if ($user) {
                $update_password['reset_code'] = md5($user->email . uniqid() . randomString(5));
                $update_password['password'] = Hash::make($request->password);

                $updated = User::where(['id' => $user->id, 'reset_code' => $user->reset_code])->update($update_password);

                if ($updated) {
                    return redirect()->route('login')->with(['success' => __('Password successfully Changed')]);
                } else {
                    return redirect()->back()->with(['dismiss' => __('Password not Changed try again')]);
                }
            } else {
                return redirect()->route('login')->with(['dismiss' => __('Password not Changed try again')]);
            }
        }
    }
}
