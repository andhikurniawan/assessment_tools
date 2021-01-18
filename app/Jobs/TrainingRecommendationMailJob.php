<?php

namespace App\Jobs;

use App\Mail\TrainingRecommendationMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class TrainingRecommendationMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email_tr_data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email_tr_data)
    {
        // dd($email_tr_data);
        $this->email_tr_data = $email_tr_data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email_tr_data['email'], $this->email_tr_data['name'])->send(new TrainingRecommendationMail($this->email_tr_data));
        
    }
}
