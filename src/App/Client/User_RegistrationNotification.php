<?php



namespace App;

use Spot\EntityInterface as Entity;
use Spot\EventEmitter;
use Spot\MapperInterface as Mapper;
use Tuupola\Base62;

class User_RegistrationNotification extends \Spot\Entity
{
  protected static $table = "user_registrationnotification";

  public static function fields()
  {
    return [
      "ur_id" => ["type" => "integer", "unsigned" => true, "primary" => true, "autoincrement" => true],
      "user_reg_notification" => ["type" => "string", "unsigned" => true],
      "user_id" => ["type" => "integer"]
      
       ];
  }

  public static function relations(Mapper $mapper, Entity $entity) {
    return [
      'User' => $mapper->belongsTo($entity, 'App\User', 'user_id'),
      // 'My_Plans' => $mapper->belongsTo($entity, 'App\My_Plans', 'plan_reg_id')      
      // 'My_Plans' => $mapper->hasMany($entity, 'App\My_Plans', 'company_id')
    ];
  }
}