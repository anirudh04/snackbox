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

use Spot\EntityInterface;
use Spot\MapperInterface;
use Spot\EventEmitter;
use Tuupola\Base62;
use Psr\Log\LogLevel;

class My_Plans extends \Spot\Entity
{
    protected static $table = "my_plans";

    public static function fields()
    {
        return [
            "plan_reg_id" => ["type" => "integer", "unsigned" => true, "primary" => true, "autoincrement" => true],
            "plan_id" => ["type" => "integer", "unsigned" => true], 
            "user_id" => ["type" => "integer","unsigned"=>true],
            "company_id" => ["type" => "integer","unsigned"=>true],
            "status" => ["type" => "string"],
            "timestamp" => ["type" => "datetime"],
            "amount" => ["type" => "integer"],
            
            ];
    }
}
   