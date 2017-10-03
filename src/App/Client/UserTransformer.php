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

use App\User;
use League\Fractal;

class UserTransformer extends Fractal\TransformerAbstract
{

    public function transform(User $user)
    {
        return [
            "uid" => (string)$user->uid ?: null,
            "order" => (integer)$user->order ?: 0,
            "title" => (string)$user->title ?: null,
            "completed" => !!$user->completed,
            "links"        => [
                "self" => "/users/{$user->uid}"
            ]
        ];
    }
}
