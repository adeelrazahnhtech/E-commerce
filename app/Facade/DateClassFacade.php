<?php 
namespace App\Facade;
use Illuminate\Support\Facades\Facade;

class DateClassFacade extends Facade{
    protected static function getFacadeAccessor(){  // it overrides static function of facade
        return 'dateclass';
    }
}