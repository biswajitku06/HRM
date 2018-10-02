@include('auth.header')

<section class="body-sign">

    <div class="center-sign">
        <div class="panel">
            <div class="col-sm-12 text-center forget-pass">
                <p class="font-weight-bold m-0"><i
                            class="fa fa-key mr-1"></i> {{__('Forget Your Password')}}</p>
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

                <div class="col-sm-12">
                    @if(Session::has('success'))
                        <div class="myalert alert-float alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            {{Session::get('success')}}
                        </div>
                    @endif
                </div>
                <div class="row">
                    <p class="font-weight-bold text-center">
                        {{__('You will receive an email with further instructions if your account exists. Please check your email')}}
                    </p>
                </div>
                <a href= {{ route('login') }}>
                    <button type="submit" class="btn btn-block btn-primary btn-rounded">{{__('Back')}}  </button>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- end: page -->

@include('auth.footer')