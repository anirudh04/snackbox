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

use App\Machine_Items;
use League\Fractal;

class Machine_ItemsTransformer extends Fractal\TransformerAbstract
{

    public function transform(Machine_Items $machine_items)
    {


        return [
            "id" => (integer)$machine_items->id ?: 0,
            "name" => (string)$machine_items->name ?: null,
            "row_tag" => (string)$machine_items->row_tag ?: null,
            "price" => (integer)$machine_items->price ?: 0,
            "left_units" => (integer)$machine_items->left_units ?: 0,
            "tot_units" => (integer)$machine_items->tot_units ?: 0
        ];
    }
}
