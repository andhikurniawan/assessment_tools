<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TrackRecordInputPeriodMail extends Mailable
{
    use Queueable, SerializesModels;

    public $tr_input_data;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data_tr_input)
    {
        $this->tr_input_data = $data_tr_input;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('web.assessment.bubat@gmail.com', 'Admin HR Bubat Web Assessment')->subject('Periode Input Data Track Record')->markdown('emails.training-record-input-period')->with('data', $this->tr_input_data);
    }
}
