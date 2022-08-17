<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function view_accounts() {
        // $accounts = Account::all();
        $accounts = Account::orderBy('category')->get();

        return view('accounts')
            ->with(['accounts' => $accounts]);
    }

    public function create(Request $request) {
        Account::create([
            'name' => $request->name,
            'category' => $request->category,
        ]);

        return redirect()
            ->route('accounts');
    }

    public function edit(Account $account) {
        // $accounts = Account::all();
        $accounts = Account::orderBy('category')->get();

        return view('accounts_edit')
            ->with(['account' => $account, 'accounts' => $accounts]);
    }

    public function update(Request $request, Account $account) {
        $account->name = $request->name;
        $account->category = $request->category;

        $account->save();

        return redirect()
            ->route('accounts');
    }

    public function destroy(Account $account) {
        $account->delete();

        return redirect()
            ->route('accounts');
    }

    public function view_ledger() {
        $accounts_list = $this->arrange_accounts();

        return view('general_ledger')
            ->with(['accounts_list' => $accounts_list]);
    }

    public static function arrange_accounts() {
        $accounts_category = ['費用', '収益', '資産', '負債', '純資産'];
        $accounts_list = array();

        foreach ($accounts_category as $category) {
            $category_start_text = '--- ' . $category . ' ---';
            $category_end_text = '';

            array_push($accounts_list, $category_start_text);

            $accounts = Account::where('category', '=', $category)->get();
            foreach ($accounts as $account) {
                array_push($accounts_list, $account->name);
            }

            array_push($accounts_list, $category_end_text);
        }

        return ($accounts_list);
    }

    public static function extract_accounts(string $category) {
        $accounts_list = array();

        $accounts = Account::where('category', '=', $category)->get();
        foreach ($accounts as $account) {
            array_push($accounts_list, $account->name);
        }

        return ($accounts_list);
    }
}
