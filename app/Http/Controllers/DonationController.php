<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\Deceased;
use App\Models\DeceasedRecord;

class DonationController extends Controller
{
    public function index()
    {
        $donations = Donation::with('deceased')->latest()->get();
        return view('donation.index', compact('donations'));
    }

    public function add()
    {
        $deceased = DeceasedRecord::latest()->get();
        return view('donation.create', compact('deceased'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:after_death,open',
            'amount' => 'required|numeric|min:1',
            'donor_name' => 'required|string|max:255',
            'mobile' => 'nullable|digits:10',
        ]);

        $last = Donation::latest()->first();
        $nextId = $last ? $last->id + 1 : 1;

        $receiptNo = 'DON-' . date('Y') . '-' . str_pad($nextId, 5, '0', STR_PAD_LEFT);

        $donation = Donation::create([
            'receipt_no' => $receiptNo,
            'type' => $request->type,
            'deceased_id' => $request->type == 'after_death' ? $request->deceased_id : null,
            'donor_name' => $request->donor_name,
            'mobile' => $request->mobile,
            'amount' => $request->amount,
            'amount_in_word' => $request->amount_in_word,
            'remarks' => $request->remarks,
            'donation_date' => $request->donation_date,
            'payment_method' => $request->payment_method,
            'bank_name' => $request->bank_name,
        ]);

        // return redirect()->route('donation.index')->with('success', 'Donation added successfully.');

        return redirect()->route('donation.receipt', $donation->id);
    }

    public function edit($id)
    {
        $donation = Donation::findOrFail($id);
        $deceased = DeceasedRecord::latest()->get();

        return view('donation.edit', compact('donation', 'deceased'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|in:after_death,open',
            'amount' => 'required|numeric|min:1',
            'donor_name' => 'required|string|max:255',
            'mobile' => 'nullable|digits:10',
        ]);

        $donation = Donation::findOrFail($id);

        $donation->update([
            'type' => $request->type,
            'deceased_id' => $request->type == 'after_death' ? $request->deceased_id : null,
            'donor_name' => $request->donor_name,
            'mobile' => $request->mobile,
            'amount' => $request->amount,
            'amount_in_word' => $request->amount_in_word,
            'remarks' => $request->remarks,
            'donation_date' => $request->donation_date,
            'payment_method' => $request->payment_method,
            'bank_name' => $request->bank_name,
        ]);

        return redirect()->route('donation.index')
            ->with('success', 'Donation updated successfully.');
    }

    public function delete($id)
    {
        $donation = Donation::findOrFail($id);
        $donation->delete();

        return redirect()->route('donation.index')
            ->with('success', 'Donation deleted successfully.');
    }

    public function getDeceased($id)
    {
        $data = DeceasedRecord::find($id);

        return response()->json($data);
    }

    public function receipt($id)
    {
        $donation = Donation::with('deceased')->findOrFail($id);

        if ($donation->type == 'open') {
            return view('donation.openreceipt', compact('donation'));
        } else {
            return view('donation.receipt', compact('donation'));
        }
    }

    public function receiptThermal($id)
    {
        $donation = Donation::findOrFail($id);
        return view('donation.receipt_thermal', compact('donation'));
    }
}
