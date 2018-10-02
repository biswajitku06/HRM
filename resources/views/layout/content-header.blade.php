<header class="page-header">
    <h2>{{$title}}</h2>

    <div class="right-wrapper text-right">
        <ol class="breadcrumbs">
            <li>
                <a href="{{route('userDashboard')}}">
                    <i class="fa fa-home"></i>
                </a>
            </li>
            <li><span>{{$title}}</span></li>
        </ol>

        <a class="sidebar-right-toggle"></a>
    </div>
</header>
{{--@if(Session::has('success'))
    <div class="myalert alert-float alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        {{Session::get('success')}}
    </div>
@endif

@if(Session::has('dismiss'))
    <div class="myalert alert-float alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        {{Session::get('dismiss')}}
    </div>
@endif--}}
