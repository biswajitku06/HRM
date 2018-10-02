<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\DailyUpdate;
use Auth;

class UserController extends Controller
{
    public function userDashboard()
    {
        $data['pagetitle']='User Dashboard';
        return view('user.dashboard',$data);
    }

    public function dailyUpdate()
    {
        $data['pagetitle']=__('Add Daily Update');
        $data['projects']=Project::orderBy('id','Asc')->get();

        return view('user.dailyupdate',$data);
    }

    public function dailyUpdateProcess(Request $request) {
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'project' => 'required',
        ];
        if(!empty($request->local_progress)) {
            $rules['local_progress'] = 'numeric|between:0,100';
        }
        if(!empty($request->server_progress)) {
            $rules['server_progress'] = 'numeric|between:0,100';
        }
        if (!empty($request->start_date)) {
            $startDate = $request->start_date;
        } else {
            $startDate = Carbon::now();
        }

        if (!empty($request->project) && $request->project != 'others') {
            $project = Project::where('id', $request->project)->first();
            if (isset($project) && $project->required_zira == 1) {
                $rules['jira_ticket'] = 'required';
            }
            $projectName = $request->project;
        } else {
            $rules['other_project'] = 'required';
            $projectName = $request->other_project;
        }
        if (!empty($request->date)) {
            $date = $request->date;
        } else {
            $date = Carbon::now();
        }

        $messages = [
            'jira_ticket.required' => __('Jira Ticket Id field can\'t be empty'),
            'title.required' => __('Title field can\'t be empty'),
            'description.required' => __('Description field can\'t be empty'),
            'project.required' => __('Project Name field can\'t be empty'),
            'other_project.required' => __('Other Project field can\'t be empty'),
            'local_progress.min' => __('Local progress length must be above 3 number'),
            'server_progress.min' => __('Server progress length must be above 3 number'),
        ];
        $this->validate($request, $rules, $messages);
        $data = [
            'user_id' => Auth::user()->id,
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'project' => $projectName,
            'start_date' => $startDate,
            'date' => $date,
            'jira_ticket' => $request->get('jira_ticket'),
            'issue' => $request->get('issue'),
            'deployed_server' => $request->get('deployed_server'),
            'server_url' => $request->get('server_url'),
            'local_progress' => $request->get('local_progress'),
            'server_progress' => $request->get('server_progress')
        ];

        if(!empty($request->edit_id)) {
            $response = DailyUpdate::where('id', $request->edit_id)->update($data);
            if($response) {
                return redirect()->back()->with('success','Daily update is Updated successfully');
            } else {
                return redirect()->back()->with('dismiss','Something went wrong . please try again');
            }
        } else {
            $response = DailyUpdate::create($data);
            if($response) {
                return redirect()->back()->with('success','Daily update is inserted successfully');
            } else {
                return redirect()->back()->with('dismiss','Something went wrong . please try again');
            }
        }
    }
}
