<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expenses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ExpensesController extends Controller
{
    /**
     * Show expenses list
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        $expenses = Expenses::paginate(10);

        return view('admin.frontend.expenses.list', compact('expenses'));
    }

    /**
     * Show form for creating a new expense
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.frontend.expenses.add');
    }

    /**
     * Store a newly created expense in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $validator = $this->validateAddForm($request);

        if ($validator->fails()) {
        return back()
            ->withErrors($validator)
            ->withInput();
    }      
            $expense = new Expenses();
            $expense->expense_name = $request->input('expense_name');
            $expense->expense_date = $request->input('expense_date');
            $expense->expense_amount = $request->input('expense_amount');
            $expense->expense_payment = $request->input('expense_payment');
            // Handle expense image upload
            if ($request->hasFile('expense_img')) {
            $Expense_images = $request->file('expense_img')->store('expense_images', 'public');
            $expense->expense_img = $Expense_images;
            } else {
               
            $expense->Expense_images = null;
            }
            $expense->save();

        return redirect()->route('admin.expenses.all')->with('simpleSuccessAlert', 'Expense added successfully');
    }

    /**
     * Show form for editing the specified expense.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expenses $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expenses $expense)
    {
        return view('admin.frontend.expenses.edit', compact('expense'));
    }

    /**
     * Update the specified expense in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expenses $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expenses $expense)
    {
        $validator = $this->validateUpdateForm($request);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $expense->expense_name = $request->input('expense_name');
        $expense->expense_date = $request->input('expense_date');
        $expense->expense_amount = $request->input('expense_amount');
        $expense->expense_payment = $request->input('expense_payment');
        // Handle expense image upload
        if ($request->hasFile('expense_img')) {
            $Expense_img = $request->file('expense_img')->store('expense_images', 'public');
            $expense->expense_img = $Expense_img;
        }
        $expense->save();

        return redirect()->route('admin.expenses.all')->with('simpleSuccessAlert', 'Expense added successfully');
    }
    /**
     * Remove the specified expense from storage.
     *
     * @param  \App\Models\Expenses $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expenses $expense)
    {
        File::delete(public_path("\expense_images\\$expense->expense_img"));
  
            $expense->delete();

            return back()->with('simpleSuccessAlert' , 'Expenses removed successfully');

    }

//for datatables
    public function index()
    {
        if (request()->ajax()) {
            $expenses = Expenses::query();
            return DataTables::of($expenses)
                ->addColumn('action', function($row){
                    $deleteForm = '<form action="'.route('admin.expenses.destroy', $row->id).'" method="POST" id="prepare-form" style="display:inline;">
                                    '.csrf_field().'
                                    '.method_field('DELETE').'
                                    <button type="submit" id="button-delete"><span class="ti-trash"></span></button>
                                   </form>';
                    $editLink = '<a href="'.route('admin.expenses.edit', $row->id).'" id="a-black"><span class="ti-pencil"></span></a>';
                    return $deleteForm . ' | ' . $editLink;
                })
                ->make(true);
        }

        $expenses = Expenses::all(); // Fetch all expenses for non-AJAX requests
        return view('admin.frontend.expenses.list', compact('expenses'));
    }
    /**
     * Validate form data for adding a new supplier.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validateAddForm(Request $request)
    {
        return Validator::make($request->all(), [
            'expense_name' => 'required|string|min:3|max:255',
            'expense_date' => 'required|date',
            'expense_amount' => 'required|numeric',
            'expense_payment' => 'required|string|min:3',
            'expense_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],
    );
    }
    protected function validateUpdateForm(Request $request)
    {
        return Validator::make($request->all(), [
            'expense_name' => 'required|string|min:3|max:255',
            'expense_date' => 'required|date',
            'expense_amount' => 'required|numeric',
            'expense_payment' => 'required|string|min:3',
            'expense_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
    }
}