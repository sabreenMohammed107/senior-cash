<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Financial_entry extends Model
{
    protected $fillable = [
        'trans_type_id', 'entry_date', 'debit', 'credit', 'cash_box_id',
      'notes'
       
    ];
}
