<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index(){
        return view('upload-file');
    }

    public function store(Request $request){
        if(request()->has('mycsv')){
            $file = $request->file('mycsv');
            // dd(request()->mycsv);
    
            // $data = array_map('str_getcsv',file(request()->mycsv)); 
            $data = file(request()->mycsv);
            $header = $data[0];
            unset($data[0]);
            

            //chunking files
            $chunks = array_chunk($data,1000);
            //convert chunk into file
            foreach($chunks as $key => $chunk){
                $name = "/tmp{$key}.csv";
                $path = resource_path('temp');
                file_put_contents($path . $name, $chunk);
            }

            // dd($chunks[0]);
            // dd(count($chunks));



            // foreach($data as $sale){
            //     $saleData = (array_combine($header,$sale));
            //     Sales::create($saleData);
            // }
            return 'Done';
    
    
            // echo("path->".$file->getRealPath());
            // dd("\nname->".$file->getClientOriginalName());
            // $data = file($file);
            // dd($data);
            // dd(request()->mycsv);

        
        }
        return "no file has been submitted";
    }
}
