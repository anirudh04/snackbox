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

use App\Tutorial;
use League\Fractal;

class TutorialTransformer extends Fractal\TransformerAbstract
{

    public function transform(Tutorial $tutorial)
    {
        return [
            "id" => (integer)$tutorial->tutorial_id ?: 0,
            "name" => (string)$tutorial->tutorial_name ?: null,
            "link" => (string)$tutorial->tutorial_link ?: null
            ]
        ];
    }
}
