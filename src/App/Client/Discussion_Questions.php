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

class Discussion_Questions extends \Spot\Entity
{
    protected static $table = "discussion_questions";

    public static function fields()
    {
        return [
            "question_id" => ["type" => "integer", "unsigned" => true, "primary" => true, "autoincrement" => true],
            "plan_id" => ["type" => "integer","unsigned"=>true], 
            "user_id" => ["type" => "integer","unsigned"=>true], 
            "question" => ["type" => "string"],
            "timestamp" => ["type" => "datetime"],
            
            ];
    }

    public static function relations(Mapper $mapper, Entity $entity) {
        return [

        'Plan' => $mapper->belongsTo($entity, 'App\Plan', 'plan_id'),
        'Answers' => $mapper->hasMany($entity, 'App\Discussion_Answers', 'question_id'),
        'Owner' => $mapper->belongsTo($entity, 'App\User', 'user_id')

        ];
    }
}
