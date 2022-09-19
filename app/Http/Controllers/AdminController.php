<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppSetting;
use App\Models\Category;
use App\Models\City;
use App\Models\Plan;
use App\Models\ThingToDo;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function appSetting(){
        return view('admin.app-setting');
    }
    public function category(){
        return view('admin.category');
    }
    public function city(){
        return view('admin.city');
    }

    public function guideline(){
        return view('admin.plan');
    }
    public function toDo(){
        return view('admin.to-do');
    }

    public function getAppSetting(Request $request){
        $data="";
        if($request->trig=="load"){
            $data= AppSetting::orderBy('type','asc')
            ->paginate(5);
        }

        if($request->trig=="search"){
            $data= AppSetting::where('id',$request->id)
            ->paginate(5);
        }

        return response()->json([
        'status' => true,
        'message' => 'success',
        'data' => $data
    ]);
    }

    public function getToDo(Request $request){
        $data="";
        if($request->trig=="load"){
            $data= ThingToDo::with('city','category')
            ->orderBy('name','asc')
            ->paginate(10);
        }

        if($request->trig=="search"){
            $data= ThingToDo::with('city','category')
            ->where('id',$request->id)
            ->paginate(10);
        }

       
        return response()->json([
        'status' => true,
        'message' => 'success',
        'data' => $data
    ]);
    }


    public function getData(Request $request){
        $category= category::where('status',1)
        ->orderBy('name','Asc')
        ->get();

        $city= City::where('status',1)
        ->orderBy('name','Asc')
        ->get();

        return response()->json([
        'status' => true,
        'message' => 'success',
        'category' => $category,
        'city' => $city,
    ]);
    }


    
    public function getCity(Request $request){
        $data="";
        if($request->trig=="load"){
            $data= City::orderBy('name','asc')
            ->paginate(5);
        }

        if($request->trig=="search"){
            $data= City::where('id',$request->id)
            ->paginate(5);
        }

        return response()->json([
        'status' => true,
        'message' => 'success',
        'data' => $data
    ]);
    }

    public function getGuideline(Request $request){
        $data="";
        if($request->trig=="load"){
            $data= Plan::orderBy('name','asc')
            ->paginate(5);
        }

        if($request->trig=="search"){
            $data= Plan::where('id',$request->id)
            ->paginate(5);
        }

        return response()->json([
        'status' => true,
        'message' => 'success',
        'data' => $data
    ]);
    }

    public function getCategory(Request $request){
        $data="";
        if($request->trig=="load"){
            $data= category::orderBy('name','asc')
            ->paginate(5);
        }

        if($request->trig=="search"){
            $data= category::where('id',$request->id)
            ->paginate(5);
        }

        return response()->json([
        'status' => true,
        'message' => 'success',
        'data' => $data
    ]);

    }

    public function saveSetting(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                'type' => 'required',
                'status' => 'required',
                
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => 'Invalid data', 'errors' => $validator->messages()], 200);
        }

        $k = AppSetting::updateOrCreate(['id'=>$request->id],
        [
            'type'=>$request->type,
            'key'=>$request->key,
            'status'=>$request->status
        ]);

        if ($k) {
            return response()->json([
                'status' => true,
                'message' => 'Application setting has been successfully saved!'
            ]);
        }

    }
    public function generateRandomString($length = 5)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }

    public function saveCity(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'description' => 'required',
                'longitude' => 'required',
                'latitude' => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => 'Invalid data', 'errors' => $validator->messages()], 200);
        }

        $banner = "";
        if ($request->banner) {
            $namex = $this->generateRandomString() . time();
            $banner = $namex . '.' . $request->banner->getClientOriginalExtension();
            $request->banner->move(public_path('storage/city'), $banner);
        }


        $k = City::updateOrCreate(['id'=>$request->id],
        [
            'name'=>$request->name,
            'description'=>$request->description,
            'longitude'=>$request->longitude,
            'latitude'=>$request->latitude,
            'status'=>$request->status,
        ]);


        if($banner){
            City::updateOrCreate(['id'=>$k->id],
            [
                'banner'=>$banner
            ]);
        }

        if ($k) {
            return response()->json([
                'status' =>true,
                'message' => 'City has been successfully saved!'
            ]);
        }
    }

    public function saveCategory(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'description' => 'required',
                
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => 'Invalid data', 'errors' => $validator->messages()], 200);
        }

        $banner = "";
        if ($request->banner) {
            $namex = $this->generateRandomString() . time();
            $banner = $namex . '.' . $request->banner->getClientOriginalExtension();
            $request->banner->move(public_path('storage/category'), $banner);
        }

        $add_banner = "";
        if ($request->add_banner) {
            $namex = $this->generateRandomString() . time();
            $add_banner = $namex . '.' . $request->add_banner->getClientOriginalExtension();
            $request->add_banner->move(public_path('storage/category'), $add_banner);
        }


        $k = Category::updateOrCreate(['id'=>$request->id],
        [
            'name'=>$request->name,
            'description'=>$request->description,
            'status'=>$request->status,
        ]);


        if($banner){
            Category::updateOrCreate(['id'=>$k->id],
            [
                'banner'=>$banner
            ]);
        }

        if($add_banner){
            Category::updateOrCreate(['id'=>$k->id],
            [
                'add_banner'=>$add_banner
            ]);
        }


        if ($k) {
            return response()->json([
                'status' =>true,
                'message' => 'Category has been successfully saved!'
            ]);
        }
    }

    public function saveGuide(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'description' => 'required',
                
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => 'Invalid data', 'errors' => $validator->messages()], 200);
        }

        $banner = "";
        if ($request->banner) {
            $namex = $this->generateRandomString() . time();
            $banner = $namex . '.' . $request->banner->getClientOriginalExtension();
            $request->banner->move(public_path('storage/guide'), $banner);
        }

        $add_banner = "";
        if ($request->add_banner) {
            $namex = $this->generateRandomString() . time();
            $add_banner = $namex . '.' . $request->add_banner->getClientOriginalExtension();
            $request->add_banner->move(public_path('storage/guide'), $add_banner);
        }


        $k = Plan::updateOrCreate(['id'=>$request->id],
        [
            'name'=>$request->name,
            'description'=>$request->description,
            'status'=>$request->status,
        ]);


        if($banner){
            Plan::updateOrCreate(['id'=>$k->id],
            [
                'banner'=>$banner
            ]);
        }

        if($add_banner){
            Plan::updateOrCreate(['id'=>$k->id],
            [
                'add_banner'=>$add_banner
            ]);
        }


        if ($k) {
            return response()->json([
                'status' =>true,
                'message' => 'Guideline has been successfully saved!'
            ]);
        }
    }

    public function saveToDo(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'description' => 'required',
                'category_id' => 'required',
                'city_id' => 'required',
                
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => 'Invalid data', 'errors' => $validator->messages()], 200);
        }

        $banner = "";
        if ($request->banner) {
            $namex = $this->generateRandomString() . time();
            $banner = $namex . '.' . $request->banner->getClientOriginalExtension();
            $request->banner->move(public_path('storage/todo'), $banner);
        }

        $add_banner = "";
        if ($request->add_banner) {
            $namex = $this->generateRandomString() . time();
            $add_banner = $namex . '.' . $request->add_banner->getClientOriginalExtension();
            $request->add_banner->move(public_path('storage/todo'), $add_banner);
        }


        $k = ThingToDo::updateOrCreate(['id'=>$request->id],
        [
            'name'=>$request->name,
            'description'=>$request->description,
            'status'=>$request->status,
            'category_id'=>$request->category_id,
            'city_id'=>$request->city_id,
        ]);


        if($banner){
            ThingToDo::updateOrCreate(['id'=>$k->id],
            [
                'banner'=>$banner
            ]);
        }

        if($add_banner){
            ThingToDo::updateOrCreate(['id'=>$k->id],
            [
                'add_banner'=>$add_banner
            ]);
        }


        if ($k) {
            return response()->json([
                'status' =>true,
                'message' => 'Things to do has been successfully saved!'
            ]);
        }
    }

}
