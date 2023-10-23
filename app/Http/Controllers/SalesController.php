<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SalesController extends Controller
{
    public function index(){
        return view('upload-file');
    }

    public function upload(Request $request){
        if(request()->has('mycsv')){
            $file = $request->file('mycsv');
            // dd(request()->mycsv);
    
            // $data = array_map('str_getcsv',file(request()->mycsv)); 
            $data = file(request()->mycsv);
            
            
            //chunking files
            $chunks = array_chunk($data,1000);
            // Storage::disk('local')->makeDirectory('temp/user1');
            $pathy = "temp/user1";
            if(!Storage::exists($pathy)) {
                $response = Storage::makeDirectory($pathy); //creates directory
            }


            //convert chunk into file
            foreach($chunks as $key => $chunk){
                $name = "tmp{$key}.csv";
                $path = storage_path("app/temp/user1");
                $full = $path."/".$name;
                file_put_contents($full,$chunk);
            }
            return 'Done';
        }
        return "no file has been submitted";
    }

    public function storeData(){
        $path = storage_path("app/temp/user1");
        $files = glob("$path/*.csv");

        $header = [];
        foreach ($files as $key => $file) {
            $data = array_map('str_getcsv',file($file)); 
            if($key === 0){
                $header = $data[0];
                unset($data[0]);
            }

            foreach ($data as $sale) {
                $saleData = array_combine($header,$sale);
                Sales::create($saleData);
            }

            unlink($file);
            
            
        }
        return "Stored";
        
    }

    public function test(){
        dd("test has failed");
    }
}
