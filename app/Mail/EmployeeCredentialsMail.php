<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmployeeCredentialsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $employee;

    public function __construct($employee)
    {
        $this->employee = $employee;
    }

    public function build()
    {
        return $this->view('emails.employee-credentials')
            ->with([
                'name' => $this->employee['name'],
                'email' => $this->employee['email'],
                'password' => $this->employee['password'],
            ]);
    }
}
