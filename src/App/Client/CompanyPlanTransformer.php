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

use App\Plan;
use League\Fractal;

class CompanyPlanTransformer extends Fractal\TransformerAbstract
{

    private $params = [];

    function __construct($params = []) {
        $this->params = $params;
        $this->params['likes'] = 0;
    }

    public function transform(Plan $plan)
    {

        $appreciates = null;
        $appreciates = $plan->Likes;
        $this->params['likes'] =  count($appreciates);

        return [
            "id" => (integer)$plan->plan_id ?: 0,
            "likes" => (integer) $this->params['likes'] ?: 0,
            "price_of_product" => (string)$plan->price_of_product ?: null,
            "difficulty" => (string)$plan->difficulty ?: null,
            "name" => (string)$plan->name ?: null

        ];
    }
}
