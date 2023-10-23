<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessSalesCsv;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SalesController extends Controller
{
    public function index(){
        return view('upload-file');
    }

    public function upload(Request $request){
        if(request()->has('mycsv')){
            // $validator = Validator::make($request->all(), [
            //     'file' => 'max:50120', //5MB
            // ]);

            $data = file(request()->mycsv);
            
            //chunking files
            $chunks = array_chunk($data,1000);

            $header = [];

            $batch = Bus::batch([])->dispatch();
            foreach ($chunks as $key => $chunk) {
                $data = array_map('str_getcsv',$chunk); 
                if($key === 0){
                    $header = $data[0];
                    unset($data[0]);
                }

                // if($key == 2){
                //     $header= [];
                // }
                $batch->add(new ProcessSalesCsv($header,$data));
            }
            return $batch;
        }
        return "no file has been submitted";
    }


    public function batch(){
        $batchId = request('id');
        return Bus::findBatch($batchId);
    }
}
