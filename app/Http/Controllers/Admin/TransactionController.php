<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Business;
use App\Models\Account;
use App\Models\AccountType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:transaction list', ['only' => ['index', 'show']]);
        $this->middleware('can:transaction create', ['only' => ['create', 'store']]);
        $this->middleware('can:transaction edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:transaction delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $transactions = Transaction::query()
            ->with('accountType','account','business')
            ->when($request->search, function ($q, $v) {
                $q->where('transaction_type', 'like', "%{$v}%");
            })
            ->orderBy('id', 'Desc')
            ->paginate(5);

            $accounts = Account::all();
            $accountTypes = AccountType::all();
            $businesses = Business::all();   

        return Inertia::render('Admin/Transaction/Index', [
            'transactions' => $transactions,
            'accounts' => $accounts,
            'accountTypes' => $accountTypes,
            'businesses' => $businesses,
            'can' => [
                'create' => Auth::user()->can('transaction create'),
                'edit' => Auth::user()->can('transaction edit'),
                'delete' => Auth::user()->can('transaction delete'),
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        $accountTypes = AccountType::all();
        $businesses = Business::all();
        return Inertia::render('Admin/Account/Create',  [
            'transaction' => new Transaction(),
            'accountTypes' => $accountTypes,
            'businesses' => $businesses,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'business' => ['required'],
            'account' => ['required'],
            'accountType' => ['required'],
            'transactionType' => ['required'],
            'amount' => ['required'],
        ])->validate();
            
        Transaction::create([
            'business_id' => $request->business, 
            'account_id' => $request->account, 
            'account_type_id' => $request->accountType,
            'account_type_id' => $request->accountType,
            'transaction_type' => $request->transactionType,
            'amount' => $request->amount,
            'description' => $request->description,
        ]);

        return redirect()->route('transaction.index');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function edit(Transaction $transaction)
    {
        $accountTypes = AccountType::all();
        $businesses = Business::all();

        return Inertia::render('Admin/Transaction/Edit', [
            'transaction' => $transaction,
            'accountTypes' => $accountTypes,
            'businesses' => $businesses,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        Validator::make($request->all(), [
            'business' => ['required'],
            'account' => ['required'],
            'accountType' => ['required'],
            'transaction_type' => ['required'],
            'amount' => ['required'],
        ])->validate();

        Transaction::find($id)->update([
            'business_id' => $request->business, 
            'account_id' => $request->account, 
            'account_type_id' => $request->accountType,
            'account_type_id' => $request->accountType,
            'transaction_type' => $request->transactionType,
            'amount' => $request->amount,
            'description' => $request->description,
        ]);
        return redirect()->route('transaction.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function destroy($id)
    {
        Transaction::find($id)->delete();
        return redirect()->route('transaction.index');
    }
}
