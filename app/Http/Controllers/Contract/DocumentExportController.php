<?php

namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class DocumentExportController extends Controller
{
    public function generateContract()
    {

        $user = auth()->user();

        $createdAt = $user->created_at ? $user->created_at->toDateTimeString() : '';

        $contractInformation = [
            'Current date' => Carbon::now()->toDateTimeString(),
            'Name' => $user->name,
            'Email' => $user->email,
            'Created at' => $createdAt
        ];

        $pdf = app()->make('dompdf.wrapper');
        $pdf->loadView('Contract.generate-contract-pdf', compact('contractInformation'));

        return $pdf->download('contract.pdf');
    }

}
