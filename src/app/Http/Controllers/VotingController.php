<?php

namespace App\Http\Controllers;

use App\Models\Pin;
use App\Models\Voting;
use Illuminate\Http\Request;

class VotingController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $input_pin = $request->pin;
        $pin = Pin::where('pin', $input_pin)->first();
        $option = Voting::CANDIDATE;
        if (!$pin) {
            return view('home')->with('warning', 'Please enter a valid pin');
        }
        if ($pin->voting()->count() >= $pin->capacity) {
            return view('home')->with('warning', 'Voting telah penuh');
        }
        return view('voting.index', compact('pin', 'option'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $voting = new Voting();
        $voting->pin_id = $request->pin;
        $voting->option = $request->option;
        $voting->save();
        return view('home')->with('success', 'Voting berhasil !');
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
        //
    }
}
