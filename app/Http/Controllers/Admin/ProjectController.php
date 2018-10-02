<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function projectList()
    {
        $data['pagetitle']=__('Project List');
        $data['search_string']='';
        if(isset($_GET['q']))
        {
            $data['search_string']=$_GET['q'];
        }
        $data['items']=Project::where(['status'=>1]);
        if(!empty($data['search_string'])) {
            $search_token = explode(' ', $data['search_string']);

            foreach ($search_token as $search) {
                $data['items'] = $data['items']->where(function ($query) use ($search) {

                    $query->where('name', 'LIKE' . '%' . $search . '%');

                });
            }
        }
        $data['items'] = $data['items']->paginate(PAGINATE_SMALL);
        return view('admin.project.list', $data);
    }

    public function addProject()
    {
        $data['pagetitle']=__('Project add');
        return view('admin.project.addEdit',$data);

    }

    public function projectEdit($id)
    {
        $data['pagetitle']=__('Edit project');
        if(!empty($id) && is_numeric($id))
        {
            $data['project']=Project::findorFail($id);
            return view('admin.project.addEdit',$data);
        }
    }

    public function saveProject(Request $request)
    {
        $message='';


        $rules=[
            'name'=>'required'
        ];
        $messages=[
            'name.required'=>'name can not be empty'
        ];
        $this->validate($request,$rules,$messages);
        $data=[
            'name'=>$request->name
        ];

        if(!empty($request->edit_id))
        {
            Project::where(['id'=>$request->edit_id])->update($data);
            $message=__('Project Updated successfully');
        }
        else
        {
            Project::create($data);
            $message=__('Projectc saved successfully');
        }
        return redirect()->back()->with('success', $message);
    }

    public function projectDelete($id){
        if(isset($id) && is_numeric($id)){
            Project::where(['id'=>$id])->delete();
            return redirect()->back()->with(['success'=>__('Deleted Successfully')]);
        } else {
            return redirect()->back()->with(['success'=>__('Project not found')]);
        }
    }
}
