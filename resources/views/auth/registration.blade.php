@include('auth.header')

<section class="body-sign">

    <div class="center-sign">

        <div class="panel card-sign">
            <div class="card-title-sign mt-3 text-left">
                <h2 class="title text-uppercase font-weight-bold m-0"><i
                            class="fa fa-user mr-1"></i> {{__('Registration')}}</h2>
            </div>

            <div class="card-body">

                {!! Form::open(['route'=>'register']) !!}

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3 {{ $errors->has('first_name') ? 'has-danger' : '' }}">
                            <div class="input-group">
                                <input name="first_name" type="text" placeholder="First Name" class="form-control"/>
                            </div>
                            <span class="text-danger">{{ $errors->has('first_name') ? $errors->first('first_name') : '' }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3 {{ $errors->has('last_name') ? 'has-danger' : '' }}">
                            <div class="input-group">
                                <input name="last_name" type="text" placeholder="Last Name" class="form-control"/>
                            </div>
                            <span class="text-danger">{{ $errors->has('last_name') ? $errors->first('last_name') : '' }}</span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-3 {{ $errors->has('username') ? 'has-danger' : '' }}">
                            <div class="input-group">
                                <input name="username" type="text" placeholder="UserName" class="form-control"/>
                            </div>
                            <span class="text-danger">{{ $errors->has('username') ? $errors->first('username') : '' }}</span>
                        </div>
                        <div class="form-group mb-3 {{ $errors->has('email') ? 'has-danger' : '' }}">
                            <div class="input-group">
                                <input name="email" type="email" placeholder="Email" class="form-control"/>
                            </div>
                            <span class="text-danger">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
                        </div>
                        <div class="form-group mb-3 {{ $errors->has('password') ? 'has-danger' : '' }}">
                            <div class="input-group">
                                <input name="password" type="password" placeholder="Password" class="form-control"/>
                            </div>
                            <span class="text-danger">{{ $errors->has('password') ? $errors->first('password') : '' }}</span>
                        </div>
                        <div class="form-group mb-3 {{ $errors->has('conpassword') ? 'has-danger' : '' }}">
                            <div class="input-group">
                                <input name="conpassword" type="password" placeholder="Confirm Password"
                                       class="form-control "/>
                            </div>
                            <span class="text-danger">{{ $errors->has('conpassword') ? $errors->first('conpassword') : '' }}</span>
                        </div>
                        <div class="form-group mb-3 {{ $errors->has('designation') ? 'has-danger' : '' }}">
                            <div class="input-group">
                                <input name="designation" type="text" placeholder="Designation" class="form-control"/>
                            </div>
                            <span class="text-danger">{{ $errors->has('designation') ? $errors->first('designation') : '' }}</span>
                        </div>

                    </div>
                    <div class="col-md-12 text-left">
                        <button type="submit" class="btn btn-primary mt-2">{{__('Register')}}</button>
                    </div>
                </div>
                {!! Form::close() !!}

            </div>
        </div>

    </div>
</section>
<!-- end: page -->

@include('auth.footer')