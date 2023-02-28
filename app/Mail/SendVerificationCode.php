<?php

namespace App\Mail;

use App\Models\Setting;
use App\Models\SmtpSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendVerificationCode extends Mailable
{
    use Queueable, SerializesModels;

    public $email;

    public $password;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $password)
    {
        $this->email    = $email;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $smtpSettings     = SmtpSetting::first();
        $parentalPassword = Setting::first();
        $login_link       = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/user/login";
        return $this->from($smtpSettings->email ?? '')->subject('Login Credentials')->view('emails.verificationCode', [
            'email'             => $this->email,
            'password'          => $this->password,
            'parental_password' => $parentalPassword->parental_password,
            'system_name'       => $parentalPassword->system_name,
            'login_link'        => $login_link,
        ]);
    }
}
