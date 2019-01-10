<?php
/**
 * Created by PhpStorm.
 * User: idealizza
 * Date: 27/12/18
 * Time: 16:06
 */

namespace Encore\Admin\Scheduling;


use Illuminate\Database\Eloquent\Model;

class TaskFrequency extends Model
{
    protected $table = 'admin_scheduling_task_frequencies';

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
    public function frequencyParameter()
    {
        return $this->hasMany(FrequencyParameter::class);
    }

}