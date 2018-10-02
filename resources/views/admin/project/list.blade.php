@extends('layout.layout')
@section('title', $pagetitle)
@section('content')
    @include('layout.content-header',['title'=> $pagetitle])
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                        <a href="{{route('projectAdd')}}" class="btn btn-success ml-1" data-toggle="tooltip" title="" data-original-title="{{__('Add New Project')}}"><i class="fa fa-plus-circle"></i></a>
                    </div>
                    <div class="card-title">{{__('Project')}}</div>
                </div>
                <div class="card-body">
                    <div class="header-right">
                        <form action="" class="search nav-form">
                            <div class="input-group input-search">
                                <input type="search" class="form-control" name="q" id="q" value="{{$search_string}}" placeholder="{{__('common.search')}}...">
                                <span class="input-group-btn">
								<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
							</span>
                            </div>
                        </form>
                    </div>
                    <table class="table table-striped table-bordered table-hover dt-responsive dt-custom" width="100%">
                        <thead>
                        <tr>
                            <th class="all">{{ __('Name') }}</th>
                            <th class="desktop">{{ __('Reqired Zira') }}</th>
                            <th class="all" width="10%">{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($items[0]))
                            @foreach($items as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td><div class="form-group">
                                            {{ Form::open(['route' => ['setZiraRequired'], 'files' => true]) }}
                                            <div class="can-toggle">
                                                <input type="hidden" name="required_zira" value="0">
                                                <input id="a" type="checkbox" name="required_zira"
                                                       value="1" {{ $item->required_zira == '1' ? ' checked' : '' }}>
                                                <label for="a">
                                                    <div class="can-toggle__switch" data-checked="On" data-unchecked="Off"></div>
                                                </label>
                                            </div>
                                            {{ Form::close() }}
                                        </div>
                                        {{ $item->required_zira }}</td>
                                    <td>

                                        <div class="btn-group btn-group-sm" role="group" aria-label="User Actions">
                                            <a href="{{route('projectEdit',$item->id)}}" class=" mb-1 mt-1 mr-1  btn btn-primary"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{__('Edit')}}"></i></a>
                                            <a  class="mb-1 mt-1 mr-1 modal-basic btn btn-danger" href="#{{$item->id}}" style="cursor:pointer;" ><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{__('Delete')}}"></i></a>
                                            <div id="{{$item->id}}" class="modal-block modal-header-color modal-block-danger mfp-hide">
                                                <section class="card">
                                                    <header class="card-header">
                                                        <h2 class="card-title">{{__('Delete Project')}}!</h2>
                                                    </header>
                                                    <div class="card-body">
                                                        <div class="modal-wrapper">
                                                            <div class="modal-icon">
                                                                <i class="fa fa-times-circle"></i>
                                                            </div>
                                                            <div class="modal-text">
                                                                <h4>{{__('Delete')}}</h4>
                                                                <p>{{__('Are you sure want to delete this Project ?')}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <footer class="card-footer">
                                                        <div class="row">
                                                            <div class="col-md-12 text-right">
                                                                <a href="{{route('projectDelete',$item->id)}}" class="btn btn-primary">{{__('Yes')}}</a>
                                                                <button class="btn btn-danger modal-dismiss">{{__('No')}}</button>
                                                            </div>
                                                        </div>
                                                    </footer>
                                                </section>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-7">
                            <div class="float-left">
                                {!! $items->total() !!} {{ __(' of total').' '. $items->total() }}
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="float-right">
                                {!! $items->render() !!}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $('.dt-custom').dataTable(
            {
                "columnDefs":
                    [{
                        "orderable": false,
                        "bSortable": false,
                        "targets": [3],
                    }],
                "bPaginate": false,
                "searching":false,
                "bInfo":false
            });
    </script>
@endsection