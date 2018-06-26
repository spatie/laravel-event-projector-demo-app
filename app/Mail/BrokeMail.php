<?php

namespace App\Mail;

use App\Account;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BrokeMail extends Mailable
{
    use Queueable, SerializesModels;

    /** @var \App\Mail\Account */
    public $account;

    public function __construct(Account $account)
    {
        $this->account = $account;
    }

    public function build()
    {
        return $this
            ->subject('Sorry your are broke!')
            ->view('mails.broke');
    }
}
