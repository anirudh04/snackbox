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


     private $params = [];
    function __construct($params = []) 
    {
        $this->params = $params;
        $this->params['left_units'] = 0;
        $this->params['rating']=0;
        $this->params['plans']=0;
        
    }

    public function transform(Machines $machines)
    {


        $appreciates = null;
        $appreciates = $machines->left_units;
        $this->params['left_units'] =  count($appreciates);

        $number = null;
        $number = $machines->Plans;
        $this->params['plans']=count($number);

        return [
            "id" => (integer)$machines->id ?: 0,
            "area_city" => (string)$machines->area_city ?: null,
            "area" => $machines->area ?: null,
            "name" => (string)$machines->name ?: null,
            "left_units" => (integer) $this->params['left_units'] ?: 0,
            
            
        ];
    }
}
