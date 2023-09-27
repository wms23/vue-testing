<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccountType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;

class AccountTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:account-type list', ['only' => ['index', 'show']]);
        $this->middleware('can:account-type create', ['only' => ['create', 'store']]);
        $this->middleware('can:account-type edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:account-type delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $accountTypes = (new AccountType)->newQuery();
        // $accountTypes->latest();
        // $accountTypes = $accountTypes->paginate(5);
       
        $accountTypes = AccountType::query()
            ->when($request->search, function($q, $v){
                $q->where('name', 'like', "%{$v}%");
            })
            ->orderBy('id','Desc')
            ->paginate(5);

        return Inertia::render('Admin/AccountType/Index', [
            'accountTypes' => $accountTypes,
            'can' => [
                'create' => Auth::user()->can('account-type create'),
                'edit' => Auth::user()->can('account-type edit'),
                'delete' => Auth::user()->can('account-type delete'),
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
        return Inertia::render('Admin/AccountType/Create',  [
            'accountType' => new AccountType(),
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
            'name' => ['required'],
        ])->validate();
   
        AccountType::create($request->all());
    
        return redirect()->route('account-type.index');
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function edit(AccountType $accountType)
    {
        return Inertia::render('Admin/AccountType/Edit', [
            'accountType' => $accountType
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
            'name' => ['required']
        ])->validate();
    
        AccountType::find($id)->update($request->all());
        return redirect()->route('account-type.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function destroy($id)
    {
        AccountType::find($id)->delete();
        return redirect()->route('account-type.index');
    }
}