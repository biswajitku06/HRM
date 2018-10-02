<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyUpdate extends Model
{
    protected $table='daily_updates';
    protected $fillable = [
        'user_id', 'title', 'description', 'project', 'local_progress',
        'deployed_server', 'server_progress', 'server_url', 'issue', 'jira_ticket', 'start_date','status'
    ];

    public function user()
    {
        $this->belongsTo('App\User');
    }

    public function projectInfo()
    {
        return $this->belongsTo('App\Models\Project','project');
    }
}
