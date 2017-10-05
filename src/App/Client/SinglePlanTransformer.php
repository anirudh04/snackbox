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

class SinglePlanTransformer extends Fractal\TransformerAbstract
{

    protected $defaultIncludes = [

        'reviews',
        'discussions'

    ];
    
    public function transform(Plan $plan)
    {

        return [
            "id" => (integer)$plan->plan_id ?: 0,
            "about" => (string) $plan->about?: null,
            "training" => (string) $plan->training_kit ?: null,
            "difficulty" => (string)$plan->difficulty ?: null,
            "name" => (string)$plan->name ?: null,
            "price_per_product" => (integer)$plan->price_per_product ?: 0,
            "earn_per_conversion" => (string)$plan->earn_per_conversion ?: null,
             "conversion" => (string)$plan->conversion ?: null
        ];
    }

    public function includereviews(Plan $plan) {
        $reviews = $plan->Reviews;

        return $this->collection($reviews, new ReviewsTransformer);
    }

    public function includediscussions(Plan $plan) {
        $discussion = $plan->Discussion;

        return $this->collection($discussion, new Discussion_QuestionsTransformer);
    }
}
