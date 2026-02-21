<?php
namespace App\Http\Traits;

use App\Providers\RouteServiceProvider;

trait AuthTrait {

    public function checkGuard($request) {
        
        return match($request->type) {
            'student' => 'student',
            'parent'  => 'parent',
            'teacher' => 'teacher',
            default   => 'web',
        };
    }

    public function redirect($request){
        
        if($request->type == 'student'){ 
            return redirect()->intended(RouteServiceProvider::STUDENT); 
        }
        elseif ($request->type == 'parent'){ 
            return redirect()->intended(RouteServiceProvider::PARENT); 
        }
        elseif ($request->type == 'teacher'){ 
            return redirect()->intended(RouteServiceProvider::TEACHER); 
        }
        
        return redirect()->intended(RouteServiceProvider::HOME);
    }
}