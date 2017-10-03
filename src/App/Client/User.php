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

use Spot\EntityInterface as Entity;
use Spot\EventEmitter;
use Spot\MapperInterface as Mapper;
use Tuupola\Base62;

class User extends \Spot\Entity
{
    protected static $table = "user";

    public static function fields()
    {
        return [
            "user_id" => ["type" => "integer", "unsigned" => true, "primary" => true, "autoincrement" => true],
            "user_name" => ["type" => "string"], 
            "college" => ["type" => "string"],
            "gender" => ["type" => "string"],
            "email" => ["type" => "string"],
            "type" => ["type" => "string"],
            "phone"=>["type"=>"integer"],
            "address" => ["type" => "string"],
            "cv" => ["type" => "string"],
            "timestamp" => ["type" => "datetime"],
             "status" => ["type" => "boolean"],
            ];
    }

     public static function relations(Mapper $mapper, Entity $entity) {
        return [
        'Review' => $mapper->hasMany($entity, 'App\Reviews', 'user_id'),
        'Question' => $mapper->hasMany($entity, 'App\Discussion_Questions', 'user_id'),
        'Answer' => $mapper->hasMany($entity, 'App\Discussion_Answers', 'user_id')
        
        ];
    }
}
