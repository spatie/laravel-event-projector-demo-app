<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BigAmountAddedMail extends Mailable
{
    use Queueable, SerializesModels;

    /** @var \App\Mail\Account */
    public $account;

    /** @var int */
    public $amount;

    public function __construct(Account $account, int $amount)
    {
        $this->account = $account;

        $this->amount = $amount;
    }

    public function build()
    {
        return $this
            ->subject('A big amount was added!')
            ->view('mails.bigAmountAdded');
    }
}
