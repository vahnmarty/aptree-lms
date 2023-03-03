<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Models\Domain as TenancyDomain;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Domain extends TenancyDomain
{
    use HasFactory;

    public function getUrl()
    {
        $protocol = isset($_SERVER['HTTPS']) ? 'https' : 'http';
        return $protocol . "://" . $this->domain;
    }
}
