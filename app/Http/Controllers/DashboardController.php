<?php

namespace App\Http\Controllers;

use App\Models\DeceasedRecord;
use App\Models\Donation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Top cards
        $todayCremations = DeceasedRecord::whereDate('date_of_death', today())->count();
        $monthCremations = DeceasedRecord::whereMonth('date_of_death', now()->month)
            ->whereYear('date_of_death', now()->year)->count();

        $totalDonation = Donation::sum('amount');
        $monthDonation = Donation::whereMonth('donation_date', now()->month)
            ->whereYear('donation_date', now()->year)->sum('amount');

        // Totals
        $totalDeceased = DeceasedRecord::count();
        $totalCremations = $totalDeceased; // same in your case
        $totalDonors = Donation::distinct('donor_name')->count('donor_name');

        // Recent data
        $recentCremations = DeceasedRecord::latest()->take(5)->get();
        $recentDonations = \App\Models\Donation::latest()->take(5)->get();

        // Cremation type summary
        $wood = DeceasedRecord::where('cremation_type', 'wood')
            ->whereMonth('date_of_death', now()->month)->count();

        $electric = DeceasedRecord::where('cremation_type', 'electric')
            ->whereMonth('date_of_death', now()->month)->count();

        $gas = DeceasedRecord::where('cremation_type', 'gas')
            ->whereMonth('date_of_death', now()->month)->count();

        return view('index', compact(
            'todayCremations',
            'monthCremations',
            'totalDonation',
            'monthDonation',
            'totalDeceased',
            'totalCremations',
            'totalDonors',
            'recentCremations',
            'recentDonations',
            'wood',
            'electric',
            'gas'
        ));
    }
}
