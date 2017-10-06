<?php

/*
 * This file is part of the Slim API skeleton package
 *
 * Copyright (c) 2016-2017 Mika Tuupola
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Project home:
 *   https://github.com/tuupola/slim-api-skeleton
 *
 */

namespace App;

use App\Company;
use League\Fractal;

class CompanyTransformer extends Fractal\TransformerAbstract
{

    public function transform(Company $company)
    {
        return [
            "company_id" => (integer)$company->company_id ?: 0,
            "logo" => (string)$company->logo ?: null,
            "rating" => $company->rating ?: null,
            "name" => (string)$company->name ?: null,
            "enrolled" => (integer)$company->enrolled ?: 0,
            "type" => (integer)$company->type ?: 0,
            
        ];
    }
}
