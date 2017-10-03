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
            "uid" => (string)$company->uid ?: null,
            "order" => (integer)$company->order ?: 0,
            "title" => (string)$company->title ?: null,
            "completed" => !!$company->completed
        ];
    }
}
