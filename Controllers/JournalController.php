<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use Illuminate\Http\Request;
use App\Http\Controllers\AccountController;
use App\Models\Account;
use Illuminate\Support\Arr;

class JournalController extends Controller
{
    public function index() {
        return view('index');
    }

    public function view_journals() {
        $journals = Journal::orderBy('date')->get();
        $accounts_list = AccountController::arrange_accounts();

        return view('journals')
            ->with(['journals' => $journals, 'accounts_list' => $accounts_list]);
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
            ->route('journals');
    }

    public function edit(Journal $journal) {
        $journals = Journal::orderBy('date')->get();

        return view('journals_edit')
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
                ->route('journals');
    }

    public function destroy(Journal $journal) {
        $journal->delete();

        return redirect()
            ->route('journals');
    }

    public function ledger_show(Request $request) {
        $selected_account = $request->account;
        $accounts_list = AccountController::arrange_accounts();

        // 送信された勘定科目を左側に含むレコードを抽出
        $debit_records = Journal::where('debit_accounts' , '=', $selected_account)->get();

        // 送信された勘定科目を右側に含むレコードを抽出
        $credit_records = Journal::where('credit_accounts' , '=', $selected_account)->get();

        return view('general_ledger_show')
            ->with(['selected_account' => $selected_account, 'accounts_list' => $accounts_list, 'debit_records' => $debit_records, 'credit_records' => $credit_records]);
    }

    public function BS_show() {
        $accounts_category = ['資産', '負債', '純資産'];
        $BS_table_debit = array();
        $BS_table_credit = array();

        foreach ($accounts_category as $category) {
            $category_table = array();

            array_push($category_table, [$category . 'の部', '']);

            $accounts_list = AccountController::extract_accounts($category);
            $category_sum = 0;
            foreach ($accounts_list as $account) {
                $sum = 0;

                $debit_accounts = Journal::where('debit_accounts' , '=', $account)->get();
                foreach ($debit_accounts as $record) {
                    $sum += $record->debit_price;
                }

                $credit_accounts = Journal::where('credit_accounts' , '=', $account)->get();
                foreach ($credit_accounts as $record) {
                    $sum -= $record->credit_price;
                }

                $category_sum += $sum;

                array_push($category_table, [$account, number_format(abs($sum))]);
            }

            array_push($category_table, [$category . '合計',number_format(abs($category_sum))]);

            if ($category === $accounts_category[0]) {
                foreach ($category_table as $record) {
                    array_push($BS_table_debit, $record);
                }
            }
            else {
                foreach ($category_table as $record) {
                    array_push($BS_table_credit, $record);
                }
            }
        }

        return view('balance_sheet')
            ->with(['BS_table_debit' => $BS_table_debit, 'BS_table_credit' => $BS_table_credit]);
    }

    public function PL_show() {
        $accounts_category = ['収益', '費用'];
        $PL_table = array();
        $PL_sum = 0;

        foreach ($accounts_category as $category) {
            array_push($PL_table, ['【' . $category . '】', '', '']);

            $accounts_list = AccountController::extract_accounts($category);
            $category_sum = 0;
            foreach ($accounts_list as $account) {
                $sum = 0;

                $debit_accounts = Journal::where('debit_accounts' , '=', $account)->get();
                foreach ($debit_accounts as $record) {
                    $sum += $record->debit_price;
                }

                $credit_accounts = Journal::where('credit_accounts' , '=', $account)->get();
                foreach ($credit_accounts as $record) {
                    $sum -= $record->credit_price;
                }

                $category_sum += $sum;

                array_push($PL_table, [$account, number_format(abs($sum)), '']);
            }

            $PL_sum += $category_sum;

            array_push($PL_table, [$category . '合計', '', number_format(abs($category_sum))]);
        }
        array_push($PL_table, ['利益金額', '', number_format(abs($PL_sum))]);

        return view('income_statement')
            ->with(['PL_table' => $PL_table]);
    }
}
