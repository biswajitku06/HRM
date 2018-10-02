@extends('layout.layout')
@section('title', $pagetitle)
@section('content')
    @include('layout.content-header',['title'=> $pagetitle])

    <div class="row">
        <div class="col-xl-12">
            <section class="card card-featured-left card-featured-tertiary mb-3">
                <div class="card-body">
                    {!! Form::open(['route'=>'dailyUpdateProcess']) !!}
                    <div class="row form-group">
                        <div class="col-sm-6">
                            <div class="form-group {{ $errors->has('title') ? 'has-danger' : '' }}">
                                <label>{{__('Title')}}</label>
                                <input type="text"  class="form-control" name="title" @if(isset($dailyUpdate)) value ="{{ $dailyUpdate->title }}" @endif>
                                <span class="text-danger">{{ $errors->has('title') ? $errors->first('title') : '' }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group {{ $errors->has('project') ? 'has-danger' : '' }}">
                                <label>{{__('Project')}}</label>
                                <select class="form-control"  name="project" id="project">
                                    <option value="">Select Project</option>
                                    @if(isset($projects[0]))
                                        @foreach($projects as $project)
                                            <option @if(isset($dailyUpdate) && ($dailyUpdate->project == $project->id)) selected  @endif value="{{$project->id}}"> {{ $project->name }}</option>
                                        @endforeach
                                    @endif
                                    <option value="others">Others</option>
                                </select>
                                <span class="text-danger">{{ $errors->has('project') ? $errors->first('project') : '' }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('other_project') ? 'has-danger' : '' }}">
                                <input type="text" class="form-control" placeholder="Enter Other Project Name" name="other_project" id="others" hidden @if(isset($dailyUpdate)) value="{{$dailyUpdate->project}}" @endif>
                                <span class="text-danger">{{ $errors->has('other_project') ? $errors->first('other_project') : '' }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group {{ $errors->has('description') ? 'has-danger' : '' }}">
                                <label>{{__('Description')}}</label>
                                <textarea class="form-control"  name="description"> @if(isset($dailyUpdate)) {{ $dailyUpdate->description }} @endif</textarea>
                                <span class="text-danger">{{ $errors->has('description') ? $errors->first('description') : '' }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>{{__('Facing any issue or problem')}}</label>
                                <textarea class="form-control" name="issue"> @if(isset($dailyUpdate)) {{ $dailyUpdate->issue }} @endif</textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group {{ $errors->has('Progress % in Local') ? 'has-danger' : '' }}">
                                <label>{{__('Progress % in Local')}}</label>
                                <input type="text" class="form-control number-only no-regx" name="local_progress"
                                       @if(isset($dailyUpdate)) value="{{ $dailyUpdate->local_progress }}" @endif>
                                <span class="text-danger">{{ $errors->has('local_progress') ? $errors->first('local_progress') : '' }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group {{ $errors->has('server_progress') ? 'has-danger' : '' }}">
                                <label>{{__('Progress % in Server')}}</label>
                                <input type="text" class="form-control number-only no-regx" name="server_progress"
                                       @if(isset($dailyUpdate)) value="{{ $dailyUpdate->server_progress }}" @endif>
                                <span class="text-danger">{{ $errors->has('server_progress') ? $errors->first('server_progress') : '' }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>{{__('Deployed Server (if any)')}}</label>
                                <input type="text" class="form-control" name="deployed_server" @if(isset($dailyUpdate)) value="{{ $dailyUpdate->deployed_server }}" @endif>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>{{__('Server link to test (if any)')}}</label>
                                <input type="text" class="form-control" name="server_url" @if(isset($dailyUpdate)) value="{{ $dailyUpdate->server_url }} " @endif>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>{{__('Jira Ticket Id')}}</label>
                                <input type="text" class="form-control {{ $errors->has('jira_ticket') ? 'has-danger' : '' }}" name="jira_ticket" @if(isset($dailyUpdate)) value="{{ $dailyUpdate->jira_ticket }}" @endif>
                                <span class="text-danger">{{ $errors->has('jira_ticket') ? $errors->first('jira_ticket') : '' }}</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>{{__('Start Date')}}</label>
                                <input type="date"  class="form-control" name="start_date" @if(isset($dailyUpdate)) value="{{ $dailyUpdate->start_date }}" @endif>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>{{__('Date')}}</label>
                                <input type="date"  class="form-control" name="date" @if(isset($dailyUpdate)) value="{{ $dailyUpdate->date }}" @endif>
                            </div>
                        </div>
                        <div class="col-md-12 text-left">
                            @if(isset($dailyUpdate)) <input type="hidden" name="edit_id" value="{{ $dailyUpdate->id }}"> @endif
                            <button type="submit" class="btn btn-primary mt-2">{{__('Submit')}}</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </section>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $('#project').change(function () {
            $("#others").show();
            var c = $('#project :selected').text();
            var d = $('#project :selected').val();
            if (d == 'others') {
                $("#others").attr("hidden", false);
            } else {
                $("#others").attr("hidden", true);
            }

        });

        var url = window.location.pathname.split( '/' );
        if (url[1] == 'edit-daily-update') {
            if ($('#project :selected').val() == '') {
                $('#project option').each(function() {
                    if($(this).val() == 'others') {
                        $(this).prop("selected", true);
                    }
                });
                $('#others').attr("hidden", false);
            }
        }
    </script>
@endsection
