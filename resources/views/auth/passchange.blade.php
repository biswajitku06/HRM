@include('auth.header')

<section class="body-sign">
    <div class="center-sign">
        <div class="panel">
            <div class="col-sm-12 text-center forget-pass">
                <p class="font-weight-bold m-0"><i
                            class="fa fa-key mr-1"></i> {{__('Reset Your Password')}}</p>
            </div>
            <div class="card-body">
                <div class="col-sm-12">
                    @if(Session::has('dismiss'))
                        <div class="myalert alert-float alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            {{Session::get('dismiss')}}
                        </div>
                    @endif
                </div>
                <div class="">
                    {{ Form::open(['route' => ['forgetPasswordResetProcess', 'reset_code'=>$reset_code]]) }}
                    <div class="form-group mb-3 {{ $errors->has('password') ? 'has-danger' : '' }}">
                        <label class='text-center'>{{__('Type your New Password')}}</label>
                        <div class="input-group input-group-icon">
                            <input name="password" type="password" class="form-control form-control-lg"/>
                        </div>
                        <span class="text-danger">{{ $errors->has('password') ? $errors->first('password') : '' }}</span>
                    </div>
                    <div class="form-group mb-3 {{ $errors->has('password_confirmation') ? 'has-danger' : '' }}">
                        <label class='text-center'>{{__('Retype password')}}</label>
                        <div class="input-group input-group-icon">
                            <input name="password_confirmation" type="password" class="form-control form-control-lg"/>
                        </div>
                        <span class="text-danger">{{ $errors->has('password_confirmation') ? $errors->first('password_confirmation') : '' }}</span>
                    </div>

                    <button type="submit"
                            class="btn btn-block btn-primary btn-rounded">{{__('Update Password')}}  </button>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end: page -->

@include('auth.footer')