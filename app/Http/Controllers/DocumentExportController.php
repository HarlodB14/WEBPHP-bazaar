<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
