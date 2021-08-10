<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\SendEmailDemo;
use Config;
use Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $emailData;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($emailData)
    {
        $this->emailData = $emailData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        /* $emailData = array(
            'name' => $name,
            'email' => $email['email']

        ); */
        $emailData=$this->emailData;
       // echo "<pre>"; print_r($emailData); die('here');

        //$email = new SendEmailDemo();
      //  echo "<pre>"; print_r($email); die('sd');
      $emailFrom =  Config::get('constants.EMAIL_FROM');
        //Mail::to($email['email'])->send($email);
        Mail::send('email.expense_submit', $confirmed = array('user_info' => $emailData), function ($message) use ($emailData, $emailFrom) {
            $message->to($emailData['email'])->from($emailFrom, 'BudgetApp')
                ->subject('BudgetApp – Expense for approval.');
        });
        //return $this->subject('Test Mail using Queue in Larvel 8')
          //  ->view('email.demo');
      //  Mail::to($this->send_mail)->send($email);
    }
}
