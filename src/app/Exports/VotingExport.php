<?php

namespace App\Exports;

use App\Models\Voting;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VotingExport implements FromCollection, WithHeadings
{
    protected $pin;

    public function __construct($pin)
    {
        $this->pin = $pin;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $voting = Voting::join('pin', 'pin.id', '=', 'voting.pin_id')->where('pin.pin', $this->pin)
        ->select('option as candidate', Voting::raw('count(*) as total'))
        ->groupBy('option')->get();

        $voting->transform(function ($item) {
            $item->candidate = Voting::CANDIDATE[$item->candidate]["name"];
            return $item;
        });

        return $voting;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ["Candidate", "Total"];
    }
}
