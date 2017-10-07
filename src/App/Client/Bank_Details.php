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

class Bank_Details extends \Spot\Entity
{
    protected static $table = "bank_details";

    public static function fields()
    {
        return [
            "bank_id" => ["type" => "integer", "unsigned" => true, "primary" => true, "autoincrement" => true],
            "user_id" => ["type" => "integer", "unsigned" => true], 
            "holder_name" => ["type" => "string"],
            "bank_name" => ["type" => "string"],
            "ifsc" => ["type" => "string"],
            "account_number" => ["type" => "string"],
            "pan_number" => ["type" => "string"]            
        ];
    }
  // public static function relations(Mapper $mapper, Entity $entity) {
  //       return [
  //           'User' => $mapper->belongsTo($entity, 'App\User', 'user_id')
  //       ];
  //       }

   
}

