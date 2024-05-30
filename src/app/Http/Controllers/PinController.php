<?php

namespace App\Http\Controllers;

use App\Exports\VotingExport;
use App\Models\Pin;
use App\Models\Voting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class PinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pins = Pin::All();
        // dd($pins->voting()->count());
        return view('pin.index', compact('pins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pin = new Pin();
        $pin->pin = $request->pin;
        $pin->name = $request->name;
        $pin->capacity = $request->capacity;
        $pin->save();

        return redirect()->route('pin.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pin = Pin::find($id);
        $pin->delete();

        return response()->json(['success' => 'Data deleted successfully']);
    }

    public function report(string $pin)
    {
        $voting = Voting::join('pin', 'pin.id', '=', 'voting.pin_id')->where('pin.pin', $pin)
            ->select('option', Voting::raw('count(*) as total'))
            ->groupBy('option')->get();

        $result['candidate'] = $voting->pluck('option')->toArray();
        $result['candidate'] = array_map(function ($candidate) {
            return Voting::CANDIDATE[$candidate]["name"];
        }, $result['candidate']);
        $result['total'] = $voting->pluck('total')->toArray();

        $pin = Pin::where('pin', $pin)->first();

        return view('pin.report', compact('voting', 'result', 'pin'));
    }

    public function export($pin)
    {
        return Excel::download(new VotingExport($pin), 'VotingReport.xlsx');
    }
}
