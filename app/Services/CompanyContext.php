<?php

namespace App\Services;

use App\Models\Company;

class CompanyContext
{
    
    public static function getCompanyID()
    {
        return Company::first()->id;
    }

    
}
