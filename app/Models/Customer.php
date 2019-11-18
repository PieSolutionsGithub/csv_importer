<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
	protected $fillable = [
		'user_id','invoice_number','invoice_amount','due_on','invoice_sell_amount'
	];
	
}
