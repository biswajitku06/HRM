<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\DailyUpdate;
use App\Models\Project;

class DailyUpdateController extends Controller
{
    public function dailyUpdateList(Request $request)
    {
        $data['pagetitle'] = __('My daily Update List');
        if(Auth::user()->role == USER_ROLE_ADMIN) {
            $data['dailyUpdates'] = DailyUpdate::orderBy('id', 'DESC');
        } else {
            $data['dailyUpdates'] = DailyUpdate::where('user_id',Auth::user()->id)->orderBy('id', 'DESC');
        }
        if ($request->ajax()) {
            return datatables()->of($data['dailyUpdates'])

                ->addColumn('user_id',function($dailyUpdate) {
                    return $dailyUpdate->user->first_name . ' ' . $dailyUpdate->user->last_name;
                })
                ->addColumn('project',function($dailyUpdate) {
                    if(isset($dailyUpdate->projectInfo->name)){
                        return $dailyUpdate->projectInfo->name;
                    } else {
                        return $dailyUpdate->project;
                    }
                })
                ->addColumn('actions', function ($dailyUpdate) {
                    return '<div class="btn-group btn-group-sm" role="group" aria-label="User Actions">
                            <a href="' . route('singleDailyUpdate', encrypt($dailyUpdate->id)) . '" class="mb-1 mt-1 mr-1  btn btn-primary"  data-toggle="tooltip" data-placement="top" title=""
                                data-original-title="view" style="padding: 0px 2px 5px;"><i class="fa fa-eye"></i></a>
                             <a href="' . route('editDailyUpdate', encrypt($dailyUpdate->id)) . '" class="mb-1 mt-1 mr-1  btn btn-primary"  data-toggle="tooltip" data-placement="top" title=""
                                data-original-title="Edit" style="padding: 0px 2px 5px;"><i class="fa fa-edit"></i></a>
                        </div>';
                })->rawColumns(['actions'])
                ->make(true);
            //return datatables($dailyUpdates)->make(true);
        }

        return view ('user.dailyupdatelist', $data);
    }

    public function singleDailyUpdate($id) {
        $data['pagetitle'] = __('My daily Update');
        if(isset($id)) {
            try {
                $updateid = decrypt($id);
            } catch (\Exception $e) {
                return redirect()->back();
            }
        }
        $data['dailyUpdate'] = DailyUpdate::where('id', $updateid)->first();

        return view ('user.singledailyupdate', $data);
    }
}
