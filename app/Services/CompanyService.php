<?php

namespace App\Services;

use App\Models\Company;

class CompanyService
{

    // the one and only company
    public function getOne()
    {
        return Company::first();
    }
    
}
