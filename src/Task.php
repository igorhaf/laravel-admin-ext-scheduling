<?php
/**
 * Created by PhpStorm.
 * User: idealizza
 * Date: 27/12/18
 * Time: 16:06
 */

namespace Encore\Admin\Scheduling;


use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'admin_scheduling_tasks';

    public function taskFrequencies()
    {
        return $this->hasMany(TaskFrequency::class);
    }

    public function taskResults()
    {
        return $this->hasMany(TaskResult::class);
    }


}