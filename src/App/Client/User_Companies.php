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
use App\User;
use App\Company;

class User_Companies extends \Spot\Entity
{
    protected static $table = "user_companies";

    public static function fields()
    {
        return [
            "user_company_id" => ["type" => "integer", "unsigned" => true, "primary" => true, "autoincrement" => true],
            "company_id" => ["type" => "integer","unsigned"=>true],
            "user_id" => ["type" => "integer","unsigned"=>true],
            "timestamp" => ["type" => "datetime"],
            
        ];
      }

    //     public static function relations(Mapper $mapper, Entity $entity) {
    // return [
    //   'Companies' => $mapper->hasManyThrough($entity, 'App\Companies','App\User','company_id','user_id')
    //   // 'User' => $mapper->belongsTo($entity, 'App\User', 'user_id')
    //   // // 'User_Companies' => $mapper->hasMany($entity, 'App\User_Companies', 'company_id'),
    //   // 'My_Plans' => $mapper->hasMany($entity, 'App\My_Plans', 'company_id')
    // ];
    // } 
    

  }

    