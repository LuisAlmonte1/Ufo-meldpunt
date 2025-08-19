<?php

namespace App\Http\Controllers;

use App\Models\UfoReport;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create(UfoReport $report)
    {
        // Check if user owns this report or is admin
        if (auth()->user()->id !== $report->user_id && !auth()->user()->hasRole('admin')) {
            return redirect()->route('reports.my-reports')->with('error', 'U kunt alleen uw eigen meldingen ondersteunen.');
        }

        return view('payments.create', compact('report'));
    }

    public function store(Request $request, UfoReport $report)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1|max:100'
        ]);

        // For now, we'll simulate a successful payment
        // Later you can integrate with Mollie when you have an API key
        
        $report->update([
            'is_paid' => true,
            'support_fee' => $validated['amount']
        ]);
        
        return redirect()->route('payments.return', $report)
            ->with('success', 'Bedankt voor uw donatie van €' . $validated['amount'] . '!');
    }

    public function return(UfoReport $report)
    {
        return view('payments.return', compact('report'));
    }

    public function webhook(Request $request)
    {
        // This will handle Mollie webhooks later
        return response()->json(['status' => 'OK']);
    }
}