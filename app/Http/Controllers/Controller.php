<?php

namespace App\Http\Controllers;

use App\Classes\Settings;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $settings;

    public function __construct(Settings $_settings){
        $this->settings = $_settings;
    }


    protected function toggleState($model)
    {
        if (isset($model->status) && $model->status == '1') return $this->disable($model);

        if (isset($model->enabled) && $model->enabled == '1') return $this->disable($model);

        return $this->enable($model);
    }

    private function enable($model)
    {
        if(isset($model->status))  $model->status = '1';

        if(isset($model->enabled))  $model->enabled = '1';

        $model->save();

        return $model;
    }

    private function disable($model)
    {
        if(isset($model->status)) $model->status = '0';

        if(isset($model->enabled)) $model->enabled = '0';

        $model->save();
        return $model;
    }

}
