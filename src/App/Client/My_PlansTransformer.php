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

use App\My_Plans;
use League\Fractal;

class My_PlansTransformer extends Fractal\TransformerAbstract
{

    protected $defaultIncludes = [

        'companies'
    ];
    



    public function transform(My_Plans $my_plans)
    {
        return [
            "plan_id" => (integer)$my_plans->plan_id ?: 0,
            "logo" => (string)$my_plans->logo ?: null,
            "status" => (string)$my_plans->status ?: null,
            "name" => (string)$my_plans->name ?: null
            
        ];
    }
}
