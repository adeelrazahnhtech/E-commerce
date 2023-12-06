<?php 
namespace App\Facade;

// use Carbon\Carbon;

class DateClass{
    public function dateFormatYMD($date){
        // return Carbon::createFromFormat('m/d/Y',$date)->format('Y-m-d');
        return date('Y-m-d', strtotime($date));
    }

    public function doSomething()
    {
        return 'Doing something amazing!';
    }
}