@include('auth.header')

<section class="body-sign">
    <div class="center-sign">
        <a href="/" class="logo float-left">
            <img @if(!empty($adm_setting['logo'])) src="{{path_image().$adm_setting['logo']}}"
                 @else src="{{asset('asset/img/logo.jpg')}}" @endif height="54" alt="HRM"/>
        </a>

        <div class="panel card-sign">
            <div class="card-title-sign mt-3 text-right">
                <h2 class="title text-uppercase font-weight-bold m-0"><i class="fa fa-user mr-1"></i> {{__('Sign In')}}
                </h2>
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
                {!! Form::open(['route'=>'postlogin']) !!}
                <div class="form-group mb-3 {{ $errors->has('email') ? 'has-danger' : '' }}">
                    <label>{{__('Email')}}</label>
                    <div class="input-group input-group-icon">
                        <input name="email" type="text" class="form-control form-control-lg"/>
                        <span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-user"></i>
										</span>
									</span>
                    </div>
                    <span class="text-danger">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
                </div>

                <div class="form-group mb-3 {{ $errors->has('password') ? 'has-danger' : '' }}">
                    <div class="clearfix">
                        <label class="float-left">{{__('Password')}}</label>
                    </div>
                    <div class="input-group input-group-icon">
                        <input name="password" type="password" class="form-control form-control-lg"/>
                        <span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-lock"></i>
										</span>
									</span>
                    </div>
                    <span class="text-danger">{{ $errors->has('password') ? $errors->first('password') : '' }}</span>
                </div>

                <div class="row">
                    <div class="col-sm-12 text-right">
                        <button type="submit" class="btn btn-primary mt-2">{{__('Sign In')}}</button>
                    </div>
                </div>
                {!! Form::close() !!}
                <p class="text-center"><a href="{{route('passchange')}}">{{__('Lost Password?')}}</a></p>
                <p class="text-center">Don't have an account yet? <a href="{{route('register')}}">Register Now!</a></p>
            </div>
        </div>

        <p class="text-center text-muted mt-3 mb-3">@if(!empty($adm_setting['copyright_text'])) {{$adm_setting['copyright_text']}}
            "@endif</p>
    </div>
</section>
<!-- end: page -->

@include('auth.footer')