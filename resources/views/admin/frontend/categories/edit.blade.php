@extends('admin.layouts.app')

@section('title' , 'Admin-Edit category')

@section('content')
{{-- Edit category form start --}}
<div class="col-12 mt-5">
    <div class="card">
      <form id="edit-category-form" action="{{ route('admin.categories.update' , $category->id) }}" method="POST">
      @csrf
      @method('put')
        <div class="card-body">
            <div class="row">
                <div class="col">
                  <input type="text" name="slug" class="form-control" value="{{ $category->slug }}" placeholder="Slug" aria-label="slug">
                </div>
                <div class="col">
                  <input type="text" name="title" class="form-control" value="{{ $category->title }}" placeholder="Title" aria-label="title">
                </div>
            </div>
        </div>
        <div class="d-grid gap-2 col-6 mx-auto">
            <button class="btn btn-primary" type="submit">Edit Category</button>
        </div>
      </form>
    </div>
</div>
{{-- Edit category form end --}}
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.19.3/jquery.validate.min.js"></script>
<script>
$(document).ready(function() {
    $("#edit-category-form").validate({
        rules: {
            slug: {
                required: true,
                minlength: 3
            },
            title: {
                required: true,
                minlength: 3
            }
        },
        messages: {
            slug: {
                required: "The slug field is required",
                minlength: "The slug must be at least 3 characters"
            },
            title: {
                required: "The title field is required",
                minlength: "The title must be at least 3 characters"
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});
</script>
@endsection