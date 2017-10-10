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

class UserNotification extends \Spot\Entity
{
  protected static $table = "usernotifications";

  public static function fields()
  {
    return [
      "un_id" => ["type" => "integer", "unsigned" => true, "primary" => true, "autoincrement" => true],
      "un_notification" => ["type" => "string", "unsigned" => true], 
      "plan_reg_id" => ["type" => "integer"],
      "user_id" => ["type" => "integer"]
       ];
  }

  public static function relations(Mapper $mapper, Entity $entity) {
    return [
      'User' => $mapper->belongsTo($entity, 'App\User', 'user_id'),
      'My_Plans' => $mapper->belongsTo($entity, 'App\My_Plans', 'plan_reg_id')      
      // 'My_Plans' => $mapper->hasMany($entity, 'App\My_Plans', 'company_id')
    ];
  }
}