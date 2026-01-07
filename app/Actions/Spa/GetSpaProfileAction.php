<?php

namespace App\Actions\Spa;

use App\Models\Spa;


class GetSpaProfileAction
{

    /**
     * Get spa profile by joining spa with company
     * 
     */
    public function run()
    {
        return Spa::with('company')
            ->first();
    }
}
