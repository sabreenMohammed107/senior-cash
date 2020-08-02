<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Financial_entry;
use App\Models\Cash_box;
use App\Models\Finan_trans_type;
use File;
use DB;
use Log;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
class CashOperationController extends Controller
{
    protected $object;

    protected $viewName;
    protected $routeName;
    protected $message;
    protected $errormessage;

    public function __construct(Financial_entry $object)
    {
        // $this->middleware('auth');

        $this->object = $object;
        $this->viewName = 'cash-operation.';
        $this->routeName = 'cash-operation.';
        $this->message = 'The Data has been saved';
        $this->errormessage = 'check Your Data ';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = Cash_box::orderBy("created_at", "Desc")->get();

        return view($this->viewName . 'index', compact('rows',));    }

         /**
     * 
     */
    public function addCashOperation($id)
    {
        $Selectrow = Cash_box::where('id', '=', $id)->first();
        $cashs = Cash_box::where('id','!=',$id)->orderBy("created_at", "Desc")->get();
        $currentBalance = Financial_entry::where('cash_box_id', $Selectrow->id)->sum('debit') - Financial_entry::where('cash_box_id', $Selectrow->id)->sum('credit');

       
        return view($this->viewName . 'add', compact('Selectrow','cashs', 'currentBalance', ));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
           //save in finance entry
            $objdebit = new Financial_entry();

            $objdebit->entry_date = Carbon::parse($request->input('entry_date'));
            $objdebit->credit = $request->input('credit');
           
            $objdebit->cash_box_id = $request->input('cash_box_id');
            $objdebit->notes = $request->input('note');
        
        
            $objCredit = new Financial_entry();

            $objCredit->entry_date = Carbon::parse($request->input('entry_date'));
            $objCredit->debit = $request->input('credit');
            $objCredit->cash_box_id = $request->input('cash_debit');
            $objCredit->notes = $request->input('note');
      
       

        $currentBalance = Financial_entry::where('cash_box_id', $request->input('cash_box_id'))->sum('debit') - Financial_entry::where('cash_box_id', $request->input('cash_box_id'))->sum('credit');
       
        if ($request->input('credit') > $currentBalance) {

            return redirect()->back()->withInput($request->input())->with('flash_danger', 'Amount Is Not Valid');
      
        } 
        else {
            DB::transaction(function () use ($objCredit,$objdebit,  $request) {
                $objCredit->save();
                $objdebit->save();
            });


            return redirect()->route($this->routeName . 'index')->with('flash_success', $this->message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
