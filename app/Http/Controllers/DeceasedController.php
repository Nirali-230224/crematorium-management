<?php

namespace App\Http\Controllers;

use App\Models\DeceasedRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Scalar\String_;

class DeceasedController extends Controller
{
    // ✅ View all records
    public function index()
    {
        $records = DeceasedRecord::latest()->get();
        return view('deceased.list', compact('records'));
    }

    public function add()
    {
        $records = DeceasedRecord::orderBy('deathperson_name', 'ASC')->get();

        return view('deceased.add', compact('records'));
    }

    // ✅ Store new record
    public function store(Request $request)
    {

        $validatedata = Validator::make($request->all(), [
            'deathperson_name'  => 'required|string|max:255',
            'age'               => 'nullable|integer|min:0',
            'address'           => 'required|string',

            'reason'            =>  'required',
            'date_of_death'     => 'required|date',
            'cremation_date'    =>  'required|date',
            'death_time'        => 'nullable',

            'relative_name'     => 'required|string|max:255',
            'relative_address'  => 'nullable|string',
            'mobile'            => 'required|string|max:15',

            'cremation_type'    => 'required|string',
            'remarks'           => 'nullable|string',
        ]);

        if ($validatedata->fails()) {
            return redirect()->back()
                ->withErrors($validatedata)
                ->withInput();
        }


        DeceasedRecord::create([
            'deathperson_name'  => $request->deathperson_name,
            'age'               => $request->age,
            'address'           => $request->address,

            'reason'            => $request->reason,
            'date_of_death'     => $request->date_of_death,
            'cremation_date'    =>  $request->cremation_date,
            'death_time'        => $request->death_time,

            'relative_name'     => $request->relative_name,
            'relative_address'  => $request->relative_address,
            'mobile'            => $request->mobile,

            'cremation_type'    => $request->cremation_type,
            'remarks'           => $request->remarks,
        ]);

        return redirect()->route('deceased.index')
            ->with('success', 'Record added successfully.');
    }

    public function edit(String $id)
    {
        $record = DeceasedRecord::find($id);

        return view('deceased.edit', compact('record'));
    }

    // ✅ Update record
    public function update(Request $request, $id)
    {
        $request->validate([
            'deathperson_name'  => 'required|string|max:255',
            'age'               => 'nullable|integer|min:0',
            'address'           => 'required|string',

            'reason'            =>  'required|string',
            'cremation_date'    =>  'required|date',
            'date_of_death'     => 'required|date',
            'death_time'        => 'nullable',

            'relative_name'     => 'required|string|max:255',
            'relative_address'  => 'nullable|string',
            'mobile'            => 'required|string|max:15',

            'cremation_type'    => 'required|string',
            'remarks'           => 'nullable|string',
        ]);

        $record = DeceasedRecord::findOrFail($id);

        $record->update([
            'deathperson_name'  => $request->deathperson_name,
            'age'               => $request->age,
            'address'           => $request->address,

            'reason'            =>  $request->reason,
            'date_of_death'     => $request->date_of_death,
            'cremation_date'    =>  $request->cremation_date,
            'death_time'        => $request->death_time,

            'relative_name'     => $request->relative_name,
            'relative_address'  => $request->relative_address,
            'mobile'            => $request->mobile,

            'cremation_type'    => $request->cremation_type,
            'remarks'           => $request->remarks,
        ]);

        return redirect()->route('deceased.index')
            ->with('success', 'Record updated successfully.');
    }

    public function delete(String $id){
        $users = DeceasedRecord::findOrFail($id);

        $users->delete();

        return redirect()->route('deceased.index')->with('success','Record deleted successfully');
    }
}
