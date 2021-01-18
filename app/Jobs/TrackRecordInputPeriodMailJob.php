<?php

namespace App\Jobs;

use App\Mail\TrackRecordInputPeriodMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class TrackRecordInputPeriodMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data_tr;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email_tr_input_data)
    {
        $this->data_tr = $email_tr_input_data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->data_tr['email'], $this->data_tr['name'])->send(new TrackRecordInputPeriodMail($this->data_tr));
        
    }
}
