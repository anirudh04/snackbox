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

class Business_Admin extends \Spot\Entity
{
  protected static $table = "business_admin";

  public static function fields()
  {
    return [
      "id" => ["type" => "integer", "unsigned" => true, "primary" => true, "autoincrement" => true],
      "admin_name" => ["type" => "string"], 
      "phone_no" => ["type" => "integer"],   
      "admin_email" => ["type" => "string"],
      "password" => ["type" => "string"]
    ];
  }

  public static function relations(Mapper $mapper, Entity $entity) {
    return [
      'Reviews' => $mapper->hasMany($entity, 'App\Reviews', 'user_id'),
      'Question' => $mapper->hasMany($entity, 'App\Discussion_Questions', 'user_id'),
      'Answer' => $mapper->hasMany($entity, 'App\Discussion_Answers', 'user_id'),
      'Company_Rating' => $mapper->hasMany($entity, 'App\Company_Rating', 'user_id'),
      'User_Companies' => $mapper->hasMany($entity, 'App\User_Companies', 'user_id'),
      'My_Plans' => $mapper->hasMany($entity,'App\My_Plans','user_id'),
      'User_Notification' => $mapper->hasMany($entity,'App\UserNotification','user_id'),
      // 'Bank_Details' => $mapper->belongsTo($entity, 'App\Bank_Details', 'user_id')
           ];

  }
}
