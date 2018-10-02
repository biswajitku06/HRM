@extends('layout.layout')
@section('title', $pagetitle)
@section('content')
    @include('layout.content-header',['title'=> $pagetitle])
    <div class="row">
        <div class="col-lg-4 offset-lg-4 ">
            <div class="card">
                {{Form::open(['route'=>'projectSave'])}}
                <div class="card-header">
                    <div class="card-title">{{$pagetitle}}</div>
                </div>
                <div class="card-body">
                    <div class="row form-group">
                        <div class="col-sm-12">
                            <div class="form-group {{ $errors->has('name') ? 'has-danger' : '' }}">
                                <label>{{__('Name')}}</label>
                                <input type="text" class="form-control" name="name" @if(isset($project)) value="{{$project->name}}" @else value="{{old('name')}}" @endif>
                                <span class="text-danger">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col text-right">
                            @if(isset($project))<input type="hidden" name="edit_id" value="{{$project->id}}"> @endif
                            <button class="btn btn-success btn-sm pull-right" type="submit">@if(isset($project)) {{__('Update')}} @else {{__('Create')}} @endif</button>
                        </div>
                    </div>
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>

@endsection