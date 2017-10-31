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

use App\Machines;
use League\Fractal;

class MachinesTransformer extends Fractal\TransformerAbstract
{ 



public function transform(Machines $machines)
{

    return [
        "id" => (integer)$machines->id ?: 0,
        "area_city" => (string)$machines->area_city ?: null,
        "area" => (string)$machines->area ?: null,
        "left_units" => (integer) $machines->left_units ?: 0,
        "tot_units" => (integer) $machines->tot_units ?: 0
    ];
}
}
