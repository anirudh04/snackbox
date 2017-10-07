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

use App\Company;
use League\Fractal;

class SingleCompanyTransformer extends Fractal\TransformerAbstract
{

    protected $defaultIncludes = [

        'plans'
    ];

    private $params = [];
    function __construct($params = []) 
    {
        $this->params = $params;
        $this->params['rating']=0;
        $this->params['plans']=0;
        
    }


    public function transform(Company $company)
    {


        $number = null;
        $number = $company->Plans;
        $this->params['plans']=count($number); 

        return [
            "id" => (integer)$company->company_id ?: 0,
            "logo" => (string) $company->logo?: null,
            "total plans" => (string)$this->params['plans'] ? :0,
            "about" => (string) $company->about ?: null,
            "type" => (string)$company->type ?: null,
            "name" => (string)$company->name ?: null,
            "enrolled" => (integer)$company->enrolled ?:0
        ];

    }   

    public function includeplans(Company $company) {
        $plans = $company->Plans;

        return $this->collection($plans, new CompanyPlanTransformer);
    }

    
}


