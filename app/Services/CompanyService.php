<?php

namespace App\Services;

use App\Models\Company;

class CompanyService
{
    // is for seeding also and so is set to 'static'
    public static function getCompany()
    {
        return Company::first();
    }
}
