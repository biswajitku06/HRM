@extends('layout.layout')
@section('title', $pagetitle)
@section('content')
    @include('layout.content-header',['title'=> $pagetitle])
    <div class="row">
        <div class="col-lg-4 offset-lg-4">
            <div class="card">
                {{Form::open(['route'=>'passChangeSave'])}}
                <div class="card-header">
                    <div class="card-title">{{$pagetitle}}</div>
                </div>
                <div class="card-body">
                    <div class="row form-group">

                        <div class="col-sm-12">
                            <div class="form-group {{ $errors->has('old_password') ? 'has-danger' : '' }}">
                                <label>{{__('Old Password')}}</label>
                                <input type="password" class="form-control" required name="old_password">
                                <span class="text-danger">{{ $errors->has('old_password') ? $errors->first('old_password') : '' }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('password') ? 'has-danger' : '' }}">
                                <label>{{__('Password')}}</label>
                                <input type="password" class="form-control" name="password">
                                <span class="text-danger">{{ $errors->has('password') ? $errors->first('password') : '' }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('password_confirmation') ? 'has-danger' : '' }}">
                                <label>{{__('Confirm Password')}}</label>
                                <input type="password" class="form-control" name="password_confirmation">
                                <span class="text-danger">{{ $errors->has('password_confirmation') ? $errors->first('password_confirmation') : '' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col text-right">
                            @if(isset($id))<input type="hidden" name="edit_id" value="{{$id}}"> @endif
                            <button class="btn btn-success btn-sm pull-right"
                                    type="submit">{{__('Change')}}</button>
                        </div>
                    </div>
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>

@endsection