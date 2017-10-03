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

use App\Discussion_Questions;
use League\Fractal;

class Discussion_QuestionsTransformer extends Fractal\TransformerAbstract
{
    protected $defaultIncludes = [
        'answers'
    ];


    public function transform(Discussion_Questions $discussion_questions)
    {
        return [
            "id" => (integer)$discussion_questions->question_id?: 0,
            "question" => (string)$discussion_questions->question ?: null,
            "user_name" => (string)$discussion_questions->Owner['user_name'] ?: null,

        ];
    }

    public function includeanswers(Discussion_Questions $discussion_questions) {
        $answers = $discussion_questions->Answers;
        return $this->collection($answers, new Discussion_AnswersTransformer);
    }
}
