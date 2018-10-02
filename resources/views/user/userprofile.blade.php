@extends('layout.layout')
@section('title', $pagetitle)
@section('content')
@include('layout.content-header',['title'=> $pagetitle])
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                    @if(Auth::user()->role == 2)
                    <a href="{{route('profileUpdate', Auth::user()->id )}}" class="btn btn-success ml-1"
                       data-toggle="tooltip" title="" data-original-title="{{__('Edit Profile')}}"><i
                            class="fa fa-edit">{{__('Edit Profile')}}</i></a>
                    <a href="{{route('passChange', Auth::user()->id)}}" class="btn btn-success ml-1"
                       data-toggle="tooltip" title="" data-original-title="{{__('Change Password')}}"><i
                            class="fa fa-key">{{__('Change Password')}}</i></a>
                    @endif
                </div>
                <div class="card-title">{{__('Profile')}}</div>
            </div>
            <div class="card-body">
                @if (isset($user))
                <div class="row">
                    <div class="col-md-3 text-center">
                        <a  class="profile-img">
                            <img class="img-rounded"
                                 @if(!empty($user->image)) src="{{asset(path_user_image().$user->image)}}"
                            @else src="{{asset('asset/img/user-profile.png')}}" @endif width="200"
                            height="200" alt="Porto Admin"/>
                        </a>

                        <p class="mt-2"><span
                                class="font-weight-bold">{{ $user->first_name.' '.$user->last_name }}</span>
                        </p>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-9">
                        <ul class="list-group update-wrapper">
                            <li class="list-group-item">{{ __('Email') }}<span class="dotted-style">:</span>
                                <span class="update-details">{{ $user->email }}</span>
                            </li>
                            <li class="list-group-item">{{ __('Designation') }} <span
                                    class="dotted-style">:</span> <span
                                    class="update-details">{{ $user->designation }}</span>
                            </li>
                            <li class="list-group-item">{{ __('Mobile') }}<span class="dotted-style">:</span>
                                <span class="update-details">{{ $user->mobile }}</span>
                            </li>
                            <li class="list-group-item">{{ __('Role') }}<span class="dotted-style">:</span>
                                <span class="update-details">
                                        @foreach(role() as $key => $value) @if(isset($user) && $user->role == $key) {{$value}} @endif @endforeach</span>
                            </li>
                            <li class="list-group-item">{{ __('Gender') }}<span class="dotted-style">:</span>
                                <span class="update-details">
                                        @foreach(gender() as $key => $value) @if(isset($user->userinfo->sex) && $user->userinfo->sex == $key) {{$value}} @endif @endforeach</span>
                            </li>
                            <li class="list-group-item">{{ __('Country') }}<span class="dotted-style">:</span>
                                <span class="update-details"> @if(isset($user->userinfo->country)) {{ $user->userinfo->country }} @endif</span>
                            </li>
                            <li class="list-group-item">{{ __('City') }}<span class="dotted-style">:</span>
                                <span class="update-details"> @if(isset($user->userinfo->city)) {{ $user->userinfo->city }} @endif</span>
                            </li>
                            <li class="list-group-item">{{ __('State') }}<span class="dotted-style">:</span>
                                <span class="update-details"> @if(isset($user->userinfo->state)) {{ $user->userinfo->state }} @endif</span>
                            </li>
                            <li class="list-group-item">{{ __('Street 1') }}<span class="dotted-style">:</span>
                                <span class="update-details"> @if(isset($user->userinfo->street1)) {{ $user->userinfo->street1 }} @endif</span>
                            </li>
                            <li class="list-group-item">{{ __('Street 2') }}<span class="dotted-style">:</span>
                                <span class="update-details"> @if(isset($user->userinfo->street2)) {{ $user->userinfo->street2 }} @endif</span>
                            </li>
                            <li class="list-group-item">{{ __('Zip Code') }}<span class="dotted-style">:</span>
                                <span class="update-details"> @if(isset($user->userinfo->zip)) {{ $user->userinfo->zip }} @endif</span>
                            </li>
                            <li class="list-group-item">{{__('Join Date') }} <span class="dotted-style">:</span>
                                <span class="update-details">{{ $user->created_at }}</span></li>
                        </ul>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>

</script>
@endsection