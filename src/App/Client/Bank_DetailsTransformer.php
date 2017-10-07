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

use App\Bank_Details;
use League\Fractal;

class Bank_DetailsTransformer extends Fractal\TransformerAbstract
{

    public function transform(Bank_Details $bank_detail)
    {
        return [
            "bank_id" => (integer)$bank_detail->bank_id ?: 0,
            "user_id" => (integer)$bank_detail->user_id ?: 0,
            "holder_name" => (string)$bank_detail->holder_name ?: null,
            "bank_name" => (string)$bank_detail->bank_name ?: null,
            "ifsc" => (string)$bank_detail->ifsc ?: null,
            "account_number" => (string)$bank_detail->account_number ?: null,
            "pan_number" => (string)$bank_detail->pan_number ?: null
        ];
    }
}
