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

class Machines extends \Spot\Entity
{
  protected static $table = "machines";

  public static function fields()
  {
    return [
      "id" => ["type" => "string", "unsigned" => true, "primary" => true, "autoincrement" => true], 
      "address" => ["type" => "string"],
      "local_admin_name" => ["type" => "string"],
      "local_admin_phone" => ["type" => "integer"],
      "upi_vpa" => ["type" => "string"],
      "latitude" => ["type" => "float"],
      "longitude" => ["type" => "float"],
      "wifi_id" => ["type" => "string"],
      "wifi_pass" => ["type" => "string"],
      "location" => ["type" => "string"],
      "area_city" => ["type" => "string"],
      "city" => ["type" => "string"],
      "pincode" => ["type" => "integer"]
        ];
  }

  public static function relations(Mapper $mapper, Entity $entity) {
    return [
      'Machine_Items' => $mapper->hasMany($entity, 'App\Machine_Items', 'id'),
      'User_Companies' => $mapper->hasMany($entity, 'App\User_Companies', 'company_id'),
      'Rating' => $mapper->hasMany($entity, 'App\Company_Rating', 'company_id'),
      'UserNotification' => $mapper->hasMany($entity,'App\UserNotification', 'company_id'),

      // 'My_Plans' => $mapper->hasMany($entity, 'App\My_Plans', 'company_id')
    ];
  }
}