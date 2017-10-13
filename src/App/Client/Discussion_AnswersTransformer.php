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

use App\Discussion_Answers;
use League\Fractal;

class Discussion_AnswersTransformer extends Fractal\TransformerAbstract
{

    public function transform(Discussion_Answers $discussion_answers)
    {
        return [
            "id" => (integer)$discussion_answers->answer_id?: 0,
            "answer" => (string)$discussion_answers->answer ?: null,
            "user_name" => (string)$discussion_answers->Owner['user_name'] ?: null
            
        ];
    }
}
