<?php

namespace App\Http\Controllers;

use App\Exports\DeceasedExport;
use App\Models\DeceasedRecord;
use App\Models\Donation;
use App\Models\DonationExport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class ReportController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        $totalDonations = Donation::sum('amount');
        $totalDeceased = DeceasedRecord::count();

        $todayDonations = Donation::whereDate('donation_date', today())->sum('amount');
        $todayDeceased = DeceasedRecord::whereDate('created_at', today())->count();

        return view('reports.dashboard', compact(
            'totalDonations',
            'totalDeceased',
            'todayDonations',
            'todayDeceased'
        ));
    }

    private function applyDonationFilters($query, $request)
    {
        // Existing filters
        if ($request->payment_method) {
            $query->where('payment_method', $request->payment_method);
        }

        if ($request->donor_name) {
            $query->where('donor_name', 'like', '%' . $request->donor_name . '%');
        }

        if ($request->type) {
            $query->where('type', $request->type);
        }

        // 🔥 Date logic (same as deceased)
        if ($request->from_date && $request->to_date) {
            $query->whereBetween('donation_date', [
                $request->from_date,
                $request->to_date
            ]);
        } else {

            if ($request->date_filter == 'daily') {
                $query->whereDate('donation_date', now());
            }

            if ($request->date_filter == 'monthly') {
                $query->whereMonth('donation_date', now()->month)
                    ->whereYear('donation_date', now()->year);
            }

            if ($request->date_filter == 'yearly') {
                $query->whereYear('donation_date', now()->year);
            }
        }

        return $query;
    }

    // Donation Report
    public function donationReport(Request $request)
    {
        $query = Donation::with('deceased');

        $query = $this->applyDonationFilters($query, $request);

        $donations = $query->orderBy('donation_date', 'desc')
            ->paginate(10)
            ->withQueryString();

        $total = $query->sum('amount');

        return view('reports.donation', compact('donations', 'total'));
    }

    public function donationPDF(Request $request)
    {
        $query = Donation::query();

        $query = $this->applyDonationFilters($query, $request);

        $donations = $query->get();
        $total = $donations->sum('amount');

        $pdf = PDF::loadView('reports.pdf.donation_pdf', compact('donations', 'total'));

        return $pdf->download('donation_report.pdf');
    }

    public function donationExcel(Request $request)
    {
        return Excel::download(new DonationExport($request), 'donation_report.xlsx');
    }




    //deceased report

    private function applyDeceasedFilters($query, $request)
    {
        if ($request->name) {
            $query->where('deathperson_name', 'like', '%' . $request->name . '%');
        }

        if ($request->cremation_type) {
            $query->where('cremation_type', $request->cremation_type);
        }

        if ($request->age) {
            $query->where('age', $request->age);
        }

        // ✅ Custom date range (priority)
        if ($request->from_date && $request->to_date) {
            $query->whereBetween('date_of_death', [
                $request->from_date,
                $request->to_date
            ]);
        } else {

            if ($request->date_filter == 'daily') {
                $query->whereDate('date_of_death', now());
            }

            if ($request->date_filter == 'monthly') {
                $query->whereMonth('date_of_death', now()->month)
                    ->whereYear('date_of_death', now()->year);
            }

            if ($request->date_filter == 'yearly') {
                $query->whereYear('date_of_death', now()->year);
            }

            if ($request->date_of_death) {
                $query->whereDate('date_of_death', $request->date_of_death);
            }
        }

        return $query;
    }

    public function deceasedReport(Request $request)
    {
        $query = DeceasedRecord::query();

        $query = $this->applyDeceasedFilters($query, $request);

        $deceased = $query->orderBy('date_of_death', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('reports.deceased', compact('deceased'));
    }


    public function deceasedPDF(Request $request)
    {
        $query = DeceasedRecord::query();

        $query = $this->applyDeceasedFilters($query, $request);

        $deceased = $query->get();

        $pdf = PDF::loadView('reports.pdf.deceased_pdf', compact('deceased'));

        return $pdf->download('deceased_report.pdf');
    }

    public function deceasedExcel(Request $request)
    {
        return Excel::download(new DeceasedExport($request), 'deceased_report.xlsx');
    }
}
