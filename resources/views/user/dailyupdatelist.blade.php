@extends('layout.layout')
@section('title', $pagetitle)
@section('content')
    @include('layout.content-header',['title'=> $pagetitle])

    <div class="row">
        <div class="col-xl-12">
            <section class="card card-featured-left card-featured-tertiary mb-3">
                <div class="card-header">
                    <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                        <a href="{{route('dailyUpdate')}}" class="btn btn-success ml-1" data-toggle="tooltip" title="" data-original-title="{{__('Add New')}}"><i class="fa fa-plus-circle"></i></a>
                    </div>
                    <div class="card-title">{{ $pagetitle }}</div>
                </div>
                <div class="card-body">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover dispaly" id="table">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    @if(Auth::user()->role == USER_ROLE_ADMIN)
                                        <th>Dev Name</th>
                                    @endif
                                    <th>Title</th>
                                    <th>Project</th>
                                    <th>description</th>
                                    <th>Start Date</th>
                                    <th>Created_at</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                {{--@forelse ($dailyUpdates as $dailyUpdate)
                                    <tr>
                                        <td>{{ $dailyUpdate ->date }}</td>
                                        <td>{{ $dailyUpdate ->title }}</td>
                                        <td>{{ $dailyUpdate ->project }}</td>
                                        <td>{{ $dailyUpdate ->description }}</td>
                                        <td>{{ $dailyUpdate ->start_date}}</td>
                                        <td>{{ $dailyUpdate ->created_at}}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group" aria-label="User Actions">
                                            <a href="{{route('singleDailyUpdate', $dailyUpdate->id)}}" class="mb-1 mt-1 mr-1  btn btn-primary"  data-toggle="tooltip" data-placement="top" title=""
                                                    data-original-title="view" style="padding: 0px 2px 5px;"><i class="fa fa-eye"></i></a>
                                            <a href="{{route('editDailyUpdate', $dailyUpdate->id)}}" class="mb-1 mt-1 mr-1  btn btn-primary"  data-toggle="tooltip" data-placement="top" title=""
                                               data-original-title="Edit" style="padding: 0px 2px 5px;"><i
                                                        class="fa fa-edit"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse--}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $('#table').DataTable({
            processing:true,
            serverSide:true,
            pageLength:10,
            bLengthChange:true,
            responsive: true,
            ajax:'{{route('dailyUpdateList')}}',
            order:[3,'desc'],
            autoWidth:false,
            columns:[
                {"data":"date"},
                    @if(Auth::user()->role == USER_ROLE_ADMIN){"data":"user_id"},@endif
                {"data":"title"},
                {"data":"project"},
                {"data":"description"},
                {"data":"start_date"},
                {"data":"created_at"},
                {"data":"actions",orderable:false,searchable:false},
            ]
        });
    </script>
@endsection
