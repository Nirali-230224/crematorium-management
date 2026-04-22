<?php

namespace App\Models;

use App\Models\DeceasedRecord;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{

    protected $table = 'donations';
    protected $fillable = [
        'receipt_no',
        'type',
        'deceased_id',
        'donor_name',
        'mobile',
        'amount',
        'amount_in_word',
        'remarks',
        'donation_date',
        'payment_method',
        'bank_name',
    ];

    public function deceased()
    {
        return $this->belongsTo(DeceasedRecord::class, 'deceased_id');
    }
}
