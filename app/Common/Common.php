<?php
namespace App\Common;
use Illuminate\Support\Facades\Session;

trait Common{

    public function sendFlashMessage($result , $model , $action): void
    {
        if($result){
            Session::flash('message' ,"$model $action Successfully");
            Session::flash('alert-class' , 'alert-success');
        }else{
            Session::flash('message' , "$model Not $action");
            Session::flash('alert-class' , 'alert-danger');
        }
    }
}
