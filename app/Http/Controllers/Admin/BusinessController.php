<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;

class BusinessController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:business list', ['only' => ['index', 'show']]);
        $this->middleware('can:business create', ['only' => ['create', 'store']]);
        $this->middleware('can:business edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:business delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $businesses = Business::query()
            ->when($request->search, function($q, $v){
                $q->where('name', 'like', "%{$v}%");
            })
            ->orderBy('id','Desc')
            ->paginate(5);

        return Inertia::render('Admin/Business/Index', [
            'businesses' => $businesses,
            'can' => [
                'create' => Auth::user()->can('business create'),
                'edit' => Auth::user()->can('business edit'),
                'delete' => Auth::user()->can('business delete'),
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
        return Inertia::render('Admin/Business/Create',  [
            'business' => new Business(),
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
   
        Business::create($request->all());
    
        return redirect()->route('business.index');
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function edit(Business $business)
    {
        return Inertia::render('Admin/Business/Edit', [
            'business' => $business
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
    
        Business::find($id)->update($request->all());
        return redirect()->route('business.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function destroy($id)
    {
        Business::find($id)->delete();
        return redirect()->route('business.index');
    }
}