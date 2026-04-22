<?php

namespace App\Exports;

use App\Models\DeceasedRecord;
use Maatwebsite\Excel\Concerns\FromCollection;

class DeceasedExport implements FromCollection
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = DeceasedRecord::query();

        if ($this->request->name) {
            $query->where('deathperson_name', 'like', '%' . $this->request->name . '%');
        }

        if ($this->request->date_of_death) {
            $query->whereDate('date_of_death', $this->request->date_of_death);
        }

        if ($this->request->cremation_type) {
            $query->where('cremation_type', $this->request->cremation_type);
        }

        if ($this->request->age) {
            $query->where('age', $this->request->age);
        }

        return $query->select(
            'deathperson_name',
            'age',
            'date_of_death',
            'cremation_type'
        )->get();
    }
}
?>