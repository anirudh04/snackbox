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

use App\User_Companies;
use League\Fractal;

class User_CompaniesTransformer extends Fractal\TransformerAbstract
{

    public function transform(User_Companies $user_companies)
    {
        return [
            "id" => (string)$user_companies->user_company_id ?: null,
            "order" => (integer)$user_companies->order ?: 0,
            "title" => (string)$user_companies->title ?: null,
            "completed" => !!$user_companies->completed,
            "links"        => [
                "self" => "/user_companiess/{$user_companies->uid}"
            ]
        ];
    }
}
