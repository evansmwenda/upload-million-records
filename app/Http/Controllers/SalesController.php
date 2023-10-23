<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessSalesCsv;
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
            $data = file(request()->mycsv);
            
            //chunking files
            $chunks = array_chunk($data,1000);

            $header = [];
            foreach ($chunks as $key => $chunk) {
                $data = array_map('str_getcsv',$chunk); 
                if($key === 0){
                    $header = $data[0];
                    unset($data[0]);
                }

                if($key == 2){
                    $header= [];
                }
                ProcessSalesCsv::dispatch($header,$data);
            }
            return "Stored";
        }
        return "no file has been submitted";
    }


    public function test(){
        dd("test has failed");
    }
}
