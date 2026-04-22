<?php

use App\Models\Donation;
use Maatwebsite\Excel\Concerns\FromCollection;

class DonationExport implements FromCollection
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = Donation::query();

        if ($this->request->payment_method) {
            $query->where('payment_method', $this->request->payment_method);
        }

        if ($this->request->donor_name) {
            $query->where('donor_name', 'like', '%' . $this->request->donor_name . '%');
        }

        if ($this->request->type) {
            $query->where('type', $this->request->type);
        }

        if ($this->request->from_date && $this->request->to_date) {
            $query->whereBetween('donation_date', [
                $this->request->from_date,
                $this->request->to_date
            ]);
        } else {

            if ($this->request->date_filter == 'daily') {
                $query->whereDate('donation_date', now());
            }

            if ($this->request->date_filter == 'monthly') {
                $query->whereMonth('donation_date', now()->month)
                    ->whereYear('donation_date', now()->year);
            }

            if ($this->request->date_filter == 'yearly') {
                $query->whereYear('donation_date', now()->year);
            }
        }

        return $query->get();
    }
}

?>