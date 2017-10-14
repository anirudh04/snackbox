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

class Company extends \Spot\Entity
{
  protected static $table = "companies";

  public static function fields()
  {
    return [
      "company_id" => ["type" => "integer", "unsigned" => true, "primary" => true, "autoincrement" => true],
      "logo" => ["type" => "string", "unsigned" => true], 
      "about" => ["type" => "string"],
      "rating" => ["type" => "float"],
      "type" => ["type" => "string"],
      "name" => ["type" => "string"],
      "enrolled" => ["type" => "integer"],
      "email" => ["type" => "string"],
      "phone" => ["type" => "integer"],
      "timestamp" => ["type" => "datetime"],
      "password" => ["type" => "string"],
      "status" => ["type" => "boolean"],
    ];
  }

  public static function relations(Mapper $mapper, Entity $entity) {
    return [
      'Plans' => $mapper->hasMany($entity, 'App\Plan', 'company_id'),
      'User_Companies' => $mapper->hasMany($entity, 'App\User_Companies', 'company_id'),
      'Rating' => $mapper->hasMany($entity, 'App\Company_Rating', 'company_id'),
      'UserNotification' => $mapper->hasMany($entity,'App\UserNotification', 'company_id'),

      // 'My_Plans' => $mapper->hasMany($entity, 'App\My_Plans', 'company_id')
    ];
  }
}