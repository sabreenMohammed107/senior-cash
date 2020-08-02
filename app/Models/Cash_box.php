<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cash_box extends Model
{
    protected $fillable = [
        'name', 'open_balance',
       'balance_start_date', 'current_balance','note',
      
   ];
}
