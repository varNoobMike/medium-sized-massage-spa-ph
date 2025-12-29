<?php

namespace App\Services;

use App\Models\Company;

class CompanyContextService
{
    // for seeding
    public static function getCompanyID()
    {
        return Company::first()->id;
    }
}
