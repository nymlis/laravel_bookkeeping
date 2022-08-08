<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Journal;

class JournalController extends Controller
{
    public function index() {
        $journals = Journal::orderBy('date')->get();

        return view('index')
            ->with(['journals' => $journals]);
    }

    public function create(Request $request) {
        Journal::create([
            'date' => $request->date,
            'debit_accounts' => $request->debit_accounts,
            'debit_price' => $request->debit_price,
            'credit_accounts' => $request->credit_accounts,
            'credit_price' => $request->credit_price,
            'summary' => $request->summary,
        ]);

        return redirect()
            ->route('journals.index');
    }

    public function edit(Journal $journal) {
        $journals = Journal::orderBy('date')->get();

        return view('edit')
            ->with(['journal' => $journal, 'journals' => $journals]);
    }

    public function update(Request $request, Journal $journal) {
            $journal->date = $request->date;
            $journal->debit_accounts = $request->debit_accounts;
            $journal->debit_price = $request->debit_price;
            $journal->credit_accounts = $request->credit_accounts;
            $journal->credit_price = $request->credit_price;
            $journal->summary = $request->summary;

            $journal->save();

            return redirect()
                ->route('journals.index');
    }

    public function destroy(Journal $journal) {
        $journal->delete();

        return redirect()
            ->route('journals.index');
    }
}
