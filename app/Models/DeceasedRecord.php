<?php

namespace App\Models;

use App\Models\Donation;
use Illuminate\Database\Eloquent\Model;

class DeceasedRecord extends Model

{

    protected $table = 'deceased_records';

    protected $fillable = [
        'deathperson_name',
        'age',
        'address',
        'reason',
        'date_of_death',
        'cremation_date',
        'death_time',
        'relative_name',
        'relative_address',
        'mobile',
        'cremation_type',
        'remarks'
    ];

    public function donations()
    {
        return $this->hasMany(Donation::class,'deceased_id');
    }
}
