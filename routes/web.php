<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/upload',function(){
    return view('upload-file');
});

Route::post('/upload',function(Request $request){
    if(request()->has('mycsv')){
        $file = $request->file('mycsv');

        $data = array_map('str_getcsv',file(request()->mycsv)); 
        $header = $data[0];
        dd($header);
        unset($data[0]);
        return $data;


        // echo("path->".$file->getRealPath());
        // dd("\nname->".$file->getClientOriginalName());
        // $data = file($file);
        // dd($data);
        // dd(request()->mycsv);

        // $rules = array(
        //     'attachment' => 'mimes:jpeg,png,jpg,gif,pdf|max:1000',
        // );
        // $messages = array(
        //     'attachment' => ' Image need Less then 1Mb.',
        // );

        // $validator = Validator::make($request->all(), $rules, $messages);

        // if ($validator->fails()){
        //     dd("validator has failed");
        // }else{
        //     dd("validator was successfull");
        // }


        // echo '<br>';
        // echo '<br>';echo '<br>';echo '<br>';
   
      //Display File Name
    //   echo 'File Name: '.$file->getClientOriginalName();
    //   echo '<br>';
   
    //   //Display File Extension
    //   echo 'File Extension: '.$file->getClientOriginalExtension();
    //   echo '<br>';
   
    //   //Display File Real Path
    //   echo 'File Real Path: '.$file->getRealPath();
    //   echo '<br>';

    //   $path = $request->file('mycsv')->store('avatars');
 
    //     return $path;
   
    //   //Display File Size
    //   echo 'File Size: '.$file->getSize();
    //   echo '<br>';
   
    //   //Display File Mime Type
    //   echo 'File Mime Type: '.$file->getMimeType();
    //   echo '<br>';
   

    //   Move Uploaded File
    //   $destinationPath = 'uploads';
    //   $file->move($destinationPath,$file->getClientOriginalName());
    
    }


    return "no file has been submitted";
});