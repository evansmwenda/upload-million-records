<?php

namespace App\Jobs;

use App\Models\Sales;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Throwable;

class ProcessSalesCsv implements ShouldQueue
{
    use Batchable,Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $header;
    public $data;

    /**
     * Create a new job instance.
     */
    public function __construct($header,$data)
    {
        $this->header = $header;
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        
        foreach ($this->data as $sale) {
            $saleData = array_combine($this->header,$sale);
            Sales::create($saleData);
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(Throwable $exception): void
    {
        // Send user notification of failure, etc...
    }
}
