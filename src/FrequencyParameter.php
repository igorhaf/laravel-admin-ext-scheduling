<?php
/**
 * Created by PhpStorm.
 * User: idealizza
 * Date: 27/12/18
 * Time: 16:06
 */

namespace Encore\Admin\Scheduling;


use Illuminate\Database\Eloquent\Model;

class FrequencyParameter extends Model
{
    protected $table = 'admin_scheduling_frequency_parameters';

    public function taskFrequency()
    {
        return $this->belongsTo(TaskFrequency::class);
    }

}