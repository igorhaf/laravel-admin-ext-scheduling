<?php
/**
 * Created by PhpStorm.
 * User: idealizza
 * Date: 27/12/18
 * Time: 16:06
 */

namespace Encore\Admin\Scheduling;

use Illuminate\Database\Eloquent\Model;

class TaskResult extends Model
{
    protected $table = 'admin_scheduling_task_results';

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

}