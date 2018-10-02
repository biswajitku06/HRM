@extends('layout.layout')
@section('title', $pagetitle)
@section('content')
    @include('layout.content-header',['title'=> $pagetitle])
    <div class="row">
        <div class="col">
            <div class="card">
                {{Form::open(['route'=>'userSave'])}}
                <div class="card-header">
                    <div class="card-title">{{$pagetitle}}</div>
                </div>
                <div class="card-body">
                    <div class="row form-group">
                        <div class="col-sm-6">
                            <div class="form-group {{ $errors->has('first_name') ? 'has-danger' : '' }}">
                                <label>{{__('First Name')}}</label>
                                <input type="text" class="form-control" name="first_name" @if(isset($user)) value="{{$user->first_name}}" @else value="{{old('first_name')}}" @endif>
                                <span class="text-danger">{{ $errors->has('first_name') ? $errors->first('first_name') : '' }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group {{ $errors->has('last_name') ? 'has-danger' : '' }}">
                                <label>{{__('Last Name')}}</label>
                                <input type="text" class="form-control" name="last_name" @if(isset($user)) value="{{$user->last_name}}" @else value="{{old('last_name')}}" @endif>
                                <span class="text-danger">{{ $errors->has('last_name') ? $errors->first('last_name') : '' }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group {{ $errors->has('email') ? 'has-danger' : '' }}">
                                <label>{{__('Email Address')}}</label>
                                @if(isset($user))
                                    <span class="form-control">{{$user->email}}</span>
                                @else
                                    <input type="email" class="form-control" name="email"  value="{{old('email')}}">
                                @endif
                                <span class="text-danger">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group {{ $errors->has('mobile') ? 'has-danger' : '' }}">
                                <label>{{__('Mobile')}}</label>
                                <input type="text" class="form-control number-only no-regx" name="mobile" @if(isset($user)) value="{{$user->mobile}}" @else value="{{old('mobile')}}" @endif>
                                <span class="text-danger">{{ $errors->has('mobile') ? $errors->first('mobile') : '' }}</span>
                            </div>
                        </div>
                        @if(!isset($user))
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('password') ? 'has-danger' : '' }}">
                                    <label>{{__('Password')}}</label>
                                    <input type="password" class="form-control" name="password">
                                    <span class="text-danger">{{ $errors->has('password') ? $errors->first('password') : '' }}</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group {{ $errors->has('password_confirmation') ? 'has-danger' : '' }}">
                                    <label>{{__('Retype Password')}}</label>
                                    <input type="password" class="form-control" name="password_confirmation">
                                    <span class="text-danger">{{ $errors->has('password_confirmation') ? $errors->first('password_confirmation') : '' }}</span>
                                </div>
                            </div>
                        @endif
                        <div class="col-sm-6">
                            <div class="form-group {{ $errors->has('designation') ? 'has-danger' : '' }}">
                                <label>{{__('Designation')}}</label>
                                <input type="text" class="form-control" name="designation" @if(isset($user)) value="{{$user->designation}}" @else value="{{old('designation')}}" @endif>
                                <span class="text-danger">{{ $errors->has('designation') ? $errors->first('designation') : '' }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group {{ $errors->has('role') ? 'has-danger' : '' }}">
                                <label>{{__('User Role')}}</label>
                                <select class="form-control" name="role">
                                    <option value="">Select Role</option>
                                    @foreach(role() as $key => $value)
                                        <option @if(isset($user) && $user->role == $key) selected @endif value="{{$key}}"<?php if (old('role') != null) {
                                            echo e(' selected');}?>>{{$value}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">{{ $errors->has('role') ? $errors->first('role') : '' }}</span>
                            </div>
                        </div>
                        @if(isset($user))
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('Country')}}</label>
                                    <input type="text" class="form-control" name="country" @if(isset($user) && isset($user->userinfo->country)) value="{{$user->userinfo->country}}" @else value="{{old('country')}}" @endif>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('City')}}</label>
                                    <input type="text" class="form-control" name="city" @if(isset($user) && isset($user->userinfo->city)) value="{{$user->userinfo->city}}" @else value="{{old('city')}}" @endif>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('Street1')}}</label>
                                    <input type="text" class="form-control" name="street1" @if(isset($user) && isset($user->userinfo->street1)) value="{{$user->userinfo->street1}}" @else value="{{old('street1')}}" @endif>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('Street2')}}</label>
                                    <input type="text" class="form-control" name="street2" @if(isset($user) && isset($user->userinfo->street2)) value="{{$user->userinfo->street2}}" @else value="{{old('street2')}}" @endif>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('State')}}</label>
                                    <input type="text" class="form-control" name="state" @if(isset($user) && isset($user->userinfo->state)) value="{{$user->userinfo->state}}" @else value="{{old('state')}}" @endif>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('Zip code')}}</label>
                                    <input type="text" class="form-control" name="zip" @if(isset($user) && isset($user->userinfo->zip)) value="{{$user->userinfo->zip}}" @else value="{{old('zip')}}" @endif>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>{{__('Gender')}}</label>
                                    <select class="form-control" name="sex">
                                        @foreach(gender() as $key => $value)
                                            <option @if(isset($user) && isset($user->userinfo->sex) && $user->userinfo->sex == $key) selected @endif value="{{$key}}"<?php if (old('sex') != null) {
                                                echo e(' selected');}?>>{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col text-right">
                            @if(isset($user))<input type="hidden" name="edit_id" value="{{$user->id}}"> @endif
                            <button class="btn btn-success btn-sm pull-right" type="submit">@if(isset($user)) {{__('Update')}} @else {{__('Create')}} @endif</button>
                        </div>
                    </div>
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>

@endsection