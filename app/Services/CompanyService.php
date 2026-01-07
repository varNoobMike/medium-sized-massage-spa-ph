<?php

namespace App\Services;

use App\Models\Company;

/* Service class for `companies` */
class CompanyService
{

    /* get the first row, which is the company */
    public function getFirstCompany()
    {
        return Company::first();
    }
    
}
