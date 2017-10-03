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

class Activity_Around_You extends \Spot\Entity
{
    protected static $table = "activity_around_you";

    public static function fields()
    {
        return [
            "aau_id" => ["type" => "integer", "unsigned" => true, "primary" => true, "autoincrement" => true],
            "plan_id" => ["type" => "integer","unsigned"=>true], 
            "user_id" => ["type" => "integer","unsigned"=>true], 
            "type"=>["type"=>"string"],
            "company_id" => ["type" => "integer","unsigned"=>true], 
             "timestamp" => ["type" => "datetime"],
            
            ];
    }

    public static function events(EventEmitter $emitter)
    {
        $emitter->on("beforeInsert", function (EntityInterface $entity, MapperInterface $mapper) {
            $entity->uid = (new Base62)->encode(random_bytes(9));
        });

        $emitter->on("beforeUpdate", function (EntityInterface $entity, MapperInterface $mapper) {
            $entity->updated_at = new \DateTime();
        });
    }
    public function timestamp()
    {
        return $this->updated_at->getTimestamp();
    }

    public function etag()
    {
        return md5($this->uid . $this->timestamp());
    }

    public function clear()
    {
        $this->data([
            "order" => null,
            "title" => null,
            "completed" => null
        ]);
    }
}