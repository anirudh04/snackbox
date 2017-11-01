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

use App\Machine_Orders;
use League\Fractal;

class Machine_OrdersTransformer extends Fractal\TransformerAbstract
{

    public function transform(Machine_Orders $machine_orders)
    {


        return [
            "id" => (integer)$machine_orders->id ?: 0,
            "name" => (string)$machine_orders->name ?: null,
            "row_tag" => (string)$machine_orders->row_tag ?: null,
            "price" => (integer)$machine_orders->price ?: 0,
            "left_units" => (integer)$machine_orders->left_units ?: 0,
            "tot_units" => (integer)$machine_orders->tot_units ?: 0
        ];
    }
}
