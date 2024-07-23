@extends('admin.layouts.app')

@section('title' , 'Admin-Add product')

@section('content')
{{-- Add product form start --}}
<div class="col-12 mt-5">
    <div class="card">
        <form id="addProductForm" action="{{ route('admin.products.store')}}" method="POST" enctype="multipart/form-data">
        @csrf 
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <select name="category_id" class="form-select">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <input name="title" type="text" class="form-control" placeholder="Title" aria-label="title">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <textarea name="description" class="form-control" placeholder="Description" rows="1"></textarea>
                    </div>
                    <div class="col">
                        <input name="percent_discount" class="form-control" type="txt" placeholder="Percent">
                    </div>
                    <div class="col">
                        <input name="demo_url" class="form-control" type="file">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <input name="author" class="form-control" placeholder="Author" type="text" aria-label="author">
                    </div>
                    <div class="col">
                        <input name="price" class="form-control" placeholder="Price" type="numeric" aria-label="price">
                    </div>
                    <div class="col">
                        <input name="stock" class="form-control" placeholder="Stock" type="numeric" aria-label="stock">
                    </div>
                </div>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-primary" type="submit">Add product</button>
            </div>
        </form>
    </div>
</div>
{{-- Add product form end --}}

<!-- Include jQuery and jQuery Validation Plugin -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.19.3/jquery.validate.min.js"></script>

<script>
$(document).ready(function() {
    $("#addProductForm").validate({
        rules: {
            category_id: {
                required: true
            },
            title: {
                required: true,
                minlength: 3
            },
            description: {
                required: true,
                minlength: 10
            },
            percent_discount: {
                required: true,
                number: true,
            },
            demo_url: {
                required: true,
                url: true
            },
            author: {
                required: true,
                minlength: 3
            },
            price: {
                required: true,
                number: true,
            },
            stock: {
                required: true,
                number: true,

            }
        },
        messages: {
            category_id: {
                required: "Please select a category"
            },
            title: {
                required: "The title field is required",
                minlength: "The title must be at least 3 characters"
            },
            description: {
                required: "The description field is required",
                minlength: "The description must be at least 10 characters"
            },
            percent_discount: {
                required: "The percent discount field is required",
                number: "Please enter a valid number",
            },
            demo_url: {
                required: "The demo url must be a valid URL"
            },
            author: {
                required: "The author field is required",
                minlength: "The author must be at least 3 characters"
            },
            price: {
                required: "The price field is required",
                number: "The price must be a number",
            },
            stock: {
                required: "The stock field is required",
                number: "The stock must be a number",
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});
</script>
@endsection