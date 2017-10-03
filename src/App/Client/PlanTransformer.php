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

class PlanTransformer extends Fractal\TransformerAbstract
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
            "logo" => (string) $plan->Company['logo'] ?: null,
            "converison" => (string)$plan->conversion ?: null,
            "difficulty" => (string)$plan->difficulty ?: null,
            "name" => (string)$plan->plan_name ?: 0

        ];
    }
}
