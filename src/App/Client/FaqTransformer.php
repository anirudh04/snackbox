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

use App\Faq;
use League\Fractal;

class FaqTransformer extends Fractal\TransformerAbstract
{

    public function transform(Faq $faq)
    {
        return [
            "faq_id" => (integer)$faq->faq_id ?: 0,
            "question" => (string)$faq->question ?: null,
            "answer" => (string)$faq->answer ?: null
            ]
        ];
    }
}
