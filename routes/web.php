<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    $data = array_map('str_getcsv',file(request()->mycsv)); 
    return $data[0];
    }


    return "no file has been submitted";
});