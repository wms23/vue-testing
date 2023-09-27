<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:account list', ['only' => ['index', 'show']]);
        $this->middleware('can:account create', ['only' => ['create', 'store']]);
        $this->middleware('can:account edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:account delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $accounts = Account::query()
        ->with('accountType')
            ->when($request->search, function($q, $v){
                $q->where('name', 'like', "%{$v}%");
            })
            ->orderBy('id','Desc')
            ->paginate(5);

        return Inertia::render('Admin/Account/Index', [
            'accounts' => $accounts,
            'can' => [
                'create' => Auth::user()->can('account create'),
                'edit' => Auth::user()->can('account edit'),
                'delete' => Auth::user()->can('account delete'),
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
        return Inertia::render('Admin/Account/Create',  [
            'account' => new Account(),
            'accountTypes' => $accountTypes,
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
            'account' => ['required'],
            'accountType' => ['required'],
        ])->validate();
   
        Account::create(['name'=>$request->account, 'account_type_id'=>$request->accountType]);
    
        return redirect()->route('account.index');
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function edit(Account $account)
    {
        $accountTypes = AccountType::all();
        
        return Inertia::render('Admin/Account/Edit', [
            'account' => $account,
            'accountTypes' => $accountTypes,
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
            'account' => ['required'],
            'accountType' => ['required'],
        ])->validate();
    
        Account::find($id)->update(['name'=>$request->account, 'account_type_id'=>$request->accountType]);
        return redirect()->route('account.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function destroy($id)
    {
        Account::find($id)->delete();
        return redirect()->route('account.index');
    }
}