<?php



namespace App;

use App\Merchant;
use League\Fractal;

class MerchantTransformer extends Fractal\TransformerAbstract
{ 



public function transform(Merchant $merchant)
{

    return [
        "id" => (integer)$merchant->id ?: 0,
        "name" => (string)$merchant->admin_name ?: null,
        "phone" => (integer)$merchant->phone_no ?: 0,
        "vpa" => (string)$merchant->vpa ?: 0,
        "email" => (string) $merchant->email ?: 0
         ];
}
}
