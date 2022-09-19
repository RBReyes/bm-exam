<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AppSetting;
use App\Models\Category;
use App\Models\City;
use App\Models\Plan;
use App\Models\ThingToDo;


class GuestController extends Controller
{

    public function getGuide($id){
        $data = Plan::where('id',$id)
        ->get();
        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $data
        ]);

    }
    public function  viewPlan($id){
        $data = Plan::where('id',$id)
        ->first();

        return view('guest.plan',[
            'kes'=>$data,

            'city'=>$this->city(),
            'plan'=>$this->plan(),
            'cat'=>$this->category(),
        ]);


    }

    public function  viewToDo($id){

        $data = Category::with('todo.city')
        ->where('id',$id)
        ->first();
        return view('guest.to-do',[
            'kes'=>$data,
            'city'=>$this->city(),
            'plan'=>$this->plan(),
            'cat'=>$this->category(),
        ]);


    }

    public function  viewCity($id){

        $data = City::with('todo.city')
        ->where('id',$id)
        ->first();
        return view('guest.city',[
            'kes'=>$data,
            'city'=>$this->city(),
            'plan'=>$this->plan(),
            'cat'=>$this->category(),
        ]);


    }


    public function  viewSubToDo($id){

        $data = ThingToDo::with(['category','city'])
        ->where('id',$id)
        ->first();
        return view('guest.thing-to-do',[
            'kes'=>$data,
            'city'=>$this->city(),
            'plan'=>$this->plan(),
            'cat'=>$this->category(),
        ]);


    }


    
   

    public function landing(){
      
        return view('admin.app-setting');
    }
    public function city(){
        return City::where('status',1)->orderBy('name','asc')->get();
    }

    public function plan(){
        return Plan::where('status',1)->orderBy('name','asc')->get();
    }

    public function category(){
        return Category::with('todo')->where('status',1)->orderBy('name','asc')->get();
    }
    public function guestHome(){
        $city= City::where('status',1)->orderBy('name','asc')->get();
        $plan= Plan::where('status',1)->orderBy('name','asc')->get();
        $cat= Category::with('todo')->where('status',1)->orderBy('name','asc')->get();
        return view('guest.home',[
            'city'=>$city,
            'plan'=>$plan,
            'cat'=>$cat,
        ]);
    }
  
    public function logout(){
        Auth::logout();
        return redirect()->route('landing');
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        
        if (Auth::attempt($credentials)) {
            // $request->session()->regenerate();
            return redirect()->route('landing');
        }
        else{
            return back()->withErrors([
                'status' => 'error',
                'message' => 'Invalid Credentials.'
            ]);

        }
    }
}
