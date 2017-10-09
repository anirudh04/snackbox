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

class User_DetailTransformer extends Fractal\TransformerAbstract
{

    public function transform(User $user)
    {
        return [
            "id" => (integer)$user->user_id ?: null,
            "user_name" => (string)$user->user_name ?: null,
            "college" => (string)$user->college ?: null,
            "email" => (string)$user->email ?: null,
            "phone" => (integer)$user->phone ?: 0,
            "gender" => (string)$user->gender ?: null,
            "address" => (string)$user->address ?: null,
            "cv" => (string)$user->cv ?: null,
            "degree" => (string)$user->degree ?: null,
            
        ];
    }
}
