<?php

namespace App\Services;

use App\Models\Company;


class CompanyService
{

    /* get the first row, which is the company */
    public function getFirstCompany()
    {
        return Company::first();
    }
    
}
