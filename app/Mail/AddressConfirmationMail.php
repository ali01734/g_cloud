<?php

namespace nataalam\Mail;


use Mail;

class AddressConfirmationMail
{
    /**
     * @var \nataalam\Models\User The recipient
     */
    private $user;

    /**
     * AddressConfirmationMail constructor.
     * @param $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    public function send()
    {
        $user = $this->user;

        Mail::send(
            'emails.confirmation',
            [ 'user' => $user ],
            function ($m) use ($user) {
                $m->from(env('NOREPLY_ADDRESS'), trans('strings.nataalam'));
                $m
                    ->to($user->email, $user->name)
                    ->subject(trans('strings.emailConfirmation'));
            }
        );
    }
}