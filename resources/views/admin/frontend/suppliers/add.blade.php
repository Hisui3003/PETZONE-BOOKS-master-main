@extends('admin.layouts.app')

@section('title' , 'Admin-Add supplier')

@section('content')
<!-- Add user form start -->
<div class="col-12 mt-5">
    <div class="card">
        <form id="supplierForm" action="{{ route('admin.suppliers.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <input name="supplier_name" type="text" class="form-control" placeholder="Supplier Name" aria-label="supplier_name">
                    </div>
                    <div class="col">
                        <input name="contact_number" type="text" class="form-control" placeholder="Contact Number" aria-label="contact_number">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <input name="address" type="text" class="form-control" placeholder="Address" aria-label="address">
                    </div>
                    <div class="col">
                        <input name="image_path" type="file" accept="image/*" aria-label="image_path">
                    </div><br><br>
                    <div class="col">
                        <select name="prod_id" class="form-control" >
                            @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->id }}</option>
                            @endforeach
                        </select>
                    </div>
                </div><br>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-primary" type="submit">Add Supplier</button>
            </div>
        </form>
    </div>
</div>
<!-- Add user form end -->

<!-- Include jQuery and jQuery Validation plugin -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.19.3/jquery.validate.min.js"></script>

<script>
$(document).ready(function() {
    $("#supplierForm").validate({
        rules: {
            supplier_name: {
                required: true,
                minlength: 3
            },
            contact_number: {
                required: true,
                digits: true
            },
            address: {
                required: true,
                minlength: 3
            },
            image_path: {
                required: true,
            },
            prod_id: {
                required: true
            }
        },
        messages: {
            supplier_name: {
                required: "The supplier name field is required",
                minlength: "The supplier name must be at least 3 characters"
            },
            contact_number: {
                required: "The contact number field is required",
                digits: "The contact number must be a number"
            },
            address: {
                required: "The address field is required",
                minlength: "The address must be at least 3 characters"
            },
            image_path: {
                required: "The image path field is required"
            },
            prod_id: {
                required: "The product field is required"
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});
</script>
@endsection