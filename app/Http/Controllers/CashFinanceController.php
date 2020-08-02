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
class CashFinanceController extends Controller
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
        $this->viewName = 'cash-finance.';
        $this->routeName = 'cash-finance.';
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
        if ($request->input('tab') === "igottwo") {
            $obj = new Financial_entry();

            // $obj->trans_type_id = Finan_trans_type::where('id', '=', 2)->first()->id;
            $obj->entry_date = Carbon::parse($request->input('entry_date'));
            $obj->debit = $request->input('debit');
           
            $obj->cash_box_id = $request->input('cash_box_id');
            $obj->notes = $request->input('notesIn');
        
        } else {
           
            $obj = new Financial_entry();

            $obj->entry_date = Carbon::parse($request->input('entry_date'));
            $obj->credit = $request->input('credit');
            $obj->cash_box_id = $request->input('cash_box_id');
            $obj->notes = $request->input('notesOut');
      
        }

        $currentBalance = Financial_entry::where('cash_box_id', $request->input('cash_box_id'))->sum('debit') - Financial_entry::where('cash_box_id', $request->input('cash_box_id'))->sum('credit');
       
        if ($request->input('credit') > $currentBalance) {

            return redirect()->back()->withInput($request->input())->with('flash_danger', 'Amount Is Not Valid');
      
        } 
        else {
            DB::transaction(function () use ($obj,  $request) {
                $obj->save();
            });


            return redirect()->route($this->routeName . 'show', $request->input('cash_box_id'))->with('flash_success', $this->message);
        }
    }

    /**
     * 
     */
    public function addCashFinance($id)
    {
        $Selectrow = Cash_box::where('id', '=', $id)->first();
        $currentBalance = Financial_entry::where('cash_box_id', $Selectrow->id)->sum('debit') - Financial_entry::where('cash_box_id', $Selectrow->id)->sum('credit');

       
        return view($this->viewName . 'add', compact('Selectrow', 'currentBalance', ));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Selectrow = Cash_box::where('id', '=', $id)->first();
        $currentBalance = Financial_entry::where('cash_box_id', $Selectrow->id)->sum('debit') - Financial_entry::where('cash_box_id', $Selectrow->id)->sum('credit');

        $rows = Financial_entry::where('cash_box_id', '=', $id)->orderBy("created_at", "Desc")->get();

        return view($this->viewName . 'select', compact('Selectrow', 'rows', 'currentBalance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editrow = Financial_entry::where('id', '=', $id)->first();
        $Selectrow = Cash_box::where('id', '=', $editrow->cash_box_id)->first();
        $currentBalance = Financial_entry::where('cash_box_id', $Selectrow->id)->sum('debit') - Financial_entry::where('cash_box_id', $Selectrow->id)->sum('credit');

       

        return view($this->viewName . 'edit', compact('editrow', 'Selectrow', 'currentBalance', ));
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
        $obj = $this->object::findOrFail($id);
        //save in finance entry
        if ($request->input('tab') === "igottwo") {



            $obj->entry_date = Carbon::parse($request->input('entry_date'));
            $diffetant = $request->input('debit') - $obj->debit;
            $obj->debit = $obj->debit + $diffetant;

            $obj->notes = $request->input('notes');

            $currentBalance = Financial_entry::where('cash_box_id', $obj->cash_box_id)->sum('debit') - Financial_entry::where('cash_box_id', $obj->cash_box_id)->sum('credit');

            if ( $obj->debit > $currentBalance) {

                return redirect()->back()->withInput($request->input())->with('flash_danger', 'Amount Is Not Valid');
            } else {
                $obj->update();




                return redirect()->route($this->routeName . 'show', $request->input('cash_box_id'))->with('flash_success', $this->message);
            }
        } else {


            $obj->entry_date = Carbon::parse($request->input('entry_date'));
            $diffetant = $request->input('credit') - $obj->credit;
            $obj->credit = $obj->credit + $diffetant;
            $obj->notes = $request->input('notes');
            $currentBalance = Financial_entry::where('cash_box_id', $obj->cash_box_id)->sum('debit') - Financial_entry::where('cash_box_id', $obj->cash_box_id)->sum('credit');

            if ($obj->credit  > $currentBalance ) {

                return redirect()->back()->withInput($request->input())->with('flash_danger', 'Amount Is Not Valid');
            } else {
                $obj->update();




                return redirect()->route($this->routeName . 'show', $request->input('cash_box_id'))->with('flash_success', $this->message);
            }
        }



        return redirect()->route($this->routeName . 'show', $request->input('cash_box_id'))->with('flash_success', $this->message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = Financial_entry::where('id', '=', $id)->first();

        try {
            $row->delete();
        } catch (QueryException $q) {

            return redirect()->back()->with('flash_danger', 'You cannot delete related with another...');
        }

        return redirect()->back()->with('flash_success', 'Data Has Been Deleted Successfully !');
    }
}
