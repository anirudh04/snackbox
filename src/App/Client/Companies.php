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

class Companies extends \Spot\Entity
{
    protected static $table = "companies";

    public static function fields()
    {
        return [
            "companies_id" => ["type" => "integer", "unsigned" => true, "primary" => true, "autoincrement" => true],
            "company_logo" => ["type" => "string", "unsigned" => true], 
            "about" => ["type" => "string"],
            "rating" => ["type" => "decimal"],
            "type" => ["type" => "string"],
            "company_name" => ["type" => "string"],
            "company_email" => ["type" => "string"],
            "company_phone" => ["type" => "interger"],
            "timestamp" => ["type" => "datetime"],
            "company_password" => ["type" => "string"],
            "status" => ["type" => "boolean"],
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
