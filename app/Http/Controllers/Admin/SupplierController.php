<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SupplierController extends Controller
{
    /**
     * Show suppliers list
     *
     * @return \Illuminate\Http\Response
     */
    public function all() {

        $suppliers = Supplier::paginate(10);

        return view('admin.frontend.suppliers.list', compact('suppliers'));
    }
    /**
     * Show form for creating a new supplier
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        //dd($products);
        return view('admin.frontend.suppliers.add', compact('products'));
    }

    /**
     * Store a new created supplier in storage.
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
        $supplier = new Supplier();
        $supplier->supplier_name = $request->input('supplier_name');
        $supplier->contact_number = $request->input('contact_number');
        $supplier->address = $request->input('address');
         // Handle profile picture update if a new image is uploaded
         if ($request->hasFile('image_path')) {
        // Store the new image and update the user's image_path
        $imagePath = $request->file('image_path')->store('supplier_images', 'public');
        $supplier->image_path = $imagePath;
    }

    $supplier->prod_id = $request->input('prod_id');
    $supplier->save();

    return redirect()->route('admin.suppliers.all')->with('simpleSuccessAlert', 'Supplier created successfully');
}
    /**
     * Show form for editing the specified supplier.
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Supplier $supplier
    * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        //$supplier = Supplier::findOrFail($id); // Assuming you have a Supplier model
        $products = Product::all();
        return view('admin.frontend.suppliers.edit', compact('supplier', 'products'));
    }
    /**
     * Update specified supplier in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier $supplier
     * @return \Illuminate\Http\Response
     */
     public function update(Supplier $supplier, Request $request){
        $validator = $this->validateUpdateForm($request);

        if ($validator->fails()) {
        return back()
            ->withErrors($validator)
            ->withInput();
    }
    //$supplier = new Supplier();
        $supplier->supplier_name = $request->input('supplier_name');
        $supplier->contact_number = $request->input('contact_number');
        $supplier->address = $request->input('address');
         // Handle profile picture update if a new image is uploaded
         if ($request->hasFile('image_path')) {
        // Store the new image and update the user's image_path
        $imagePath = $request->file('image_path')->store('supplier_images', 'public');
        $supplier->image_path = $imagePath;
    }
    $supplier->prod_id = $request->input('prod_id');
    $supplier->save();

    return redirect()->route('admin.suppliers.all')->with('simpleSuccessAlert', 'Supplier updated successfully');
}
    /**
     * Remove specified user from storage.
     *
     * @param  \App\Models\Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier){
        File::delete(public_path("\images\users\\$supplier->image_path"));

        $supplier->delete();

        return back()->with('simpleSuccessAlert' , 'Supplier removed successfully');
    }
    
    public function index()
    {
        if (request()->ajax()) {
            $suppliers = Supplier::query();
            return DataTables::of($suppliers)
                ->addColumn('action', function($row){
                    $deleteForm = '<form action="'.route('admin.suppliers.destroy', $row->id).'" method="POST" id="prepare-form" style="display:inline;">
                                    '.csrf_field().'
                                    '.method_field('DELETE').'
                                    <button type="submit" id="button-delete"><span class="ti-trash"></span></button>
                                   </form>';
                    $editLink = '<a href="'.route('admin.suppliers.edit', $row->id).'" id="a-black"><span class="ti-pencil"></span></a>';
                    return $deleteForm . ' | ' . $editLink;
                })
                ->editColumn('image_path', function($row) {
                    return $row->image_path ? '<img src="'.asset('storage/'.$row->image_path).'" alt="Supplier Image" width="50">' : 'No Image';
                })
                ->rawColumns(['action', 'image_path'])
                ->make(true);
        }

        $suppliers = Supplier::all(); // Fetch all suppliers for non-AJAX requests
        return view('admin.frontend.suppliers.list', compact('suppliers'));
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
            'supplier_name' => 'required|string|min:3|max:255',
            'contact_number' => 'required|numeric', // Adjusted to reflect VARCHAR(20) in the database
            'address' => 'required|string|min:3|max:255',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'prod_id' => 'required|numeric',
        ]);
    }
    
    protected function validateUpdateForm(Request $request)
    {
        return Validator::make($request->all(), [
            'supplier_name' => 'required|string|min:3|max:255',
            'contact_number' => 'required|numeric', // Adjusted to reflect VARCHAR(20) in the database
            'address' => 'required|string|min:3|max:255',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'prod_id' => 'required|numeric',
        ]);
    }
}