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

use App\Reviews;
use League\Fractal;

class ReviewsTransformer extends Fractal\TransformerAbstract
{

    public function transform(Reviews $reviews)
    {
        return [
            "review_id" => (integer)$reviews->review_id ?: 0,
            "plan_id" => (integer)$reviews->order ?: 0,
            "user_name" => (string)$reviews->Owner['user_name'] ?: null,
            "message" => (string)$reviews->message ?: null,
            "title" => (string)$reviews->name ?: null,
        ];
    }
}
