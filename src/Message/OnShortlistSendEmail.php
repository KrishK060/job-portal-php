<?php
namespace App\Message;

use App\Entity\User;

class OnShortlistSendEmail
{
     private $emailId;

    //  private $companyName;

    public function __construct(string $emailId)
    {
        $this->emailId = $emailId;
        // $this->companyName = $companyName;
    }

    public function getUserEmailId(): string
    {
        return $this->emailId;
    }

    // public function getCompanyName(): string{
    //     return $this->companyName;
    // }
}
