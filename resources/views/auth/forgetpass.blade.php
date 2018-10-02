@include('auth.header')

<section class="body-sign">

    <div class="center-sign">
        <div class="panel">
            <div class="col-sm-12 text-center forget-pass">
                <p class="font-weight-bold m-0"><i
                            class="fa fa-key mr-1"></i> {{__('Forget Your Password ?')}}</p>
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
                {!! Form::open(['route'=>'forgetPasswordProcess']) !!}
                <div class="form-group mb-3 {{ $errors->has('email') ? 'has-danger' : '' }}">
                    <label class='text-center'>{{__('Enter Your Email')}}</label>
                    <div class="input-group input-group-icon">
                        <input name="email" type="email" class="form-control form-control-lg"/>
                    </div>
                    <span class="text-danger">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
                </div>

                <div class="row">
                    <div class="col-sm-12 text-right">
                        <button type="submit" class="btn btn-block btn-primary btn-rounded">{{__('Submit')}}</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>
<!-- end: page -->

@include('auth.footer')