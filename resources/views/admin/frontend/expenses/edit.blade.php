@extends('admin.layouts.app')

@section('title' , 'Admin-Edit Expenses')

@section('content')
<!-- Edit expenses form start -->
<div class="col-12 mt-5">
    <div class="card">
        <form id="expenseEditForm" action="{{ route('admin.expenses.update' , $expense->id) }}" method="POST" enctype="multipart/form-data">
        @method('put')
        @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <input value="{{ $expense->expense_name }}" name="expense_name" type="text" class="form-control" placeholder="Expense Name" aria-label="expense_name">
                    </div>
                    <div class="col">
                        <input value="{{ $expense->expense_date }}" name="expense_date" type="date" class="form-control" placeholder="Expense Date" aria-label="expense_date">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <input value="{{ $expense->expense_amount }}" name="expense_amount" type="text" class="form-control" placeholder="Expense Amount" aria-label="expense_amount">
                    </div>
                    <div class="col">
                        <input value="{{ $expense->expense_payment }}" name="expense_payment" type="text" class="form-control" placeholder="Expense Payment" aria-label="expense_payment">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <input value="{{ $expense->expense_img }}" name="expense_img" type="file" class="form-control" placeholder="expense_img" aria-label="expense_img"> 
                    </div>
                </div>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-primary" type="submit">Edit Expenses</button>
            </div>
        </form>
    </div>
</div>
<!-- Edit expenses form end -->

<!-- Include jQuery and jQuery Validation plugin -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.19.3/jquery.validate.min.js"></script>

<script>
$(document).ready(function() {
    $("#expenseEditForm").validate({
        rules: {
            expense_name: {
                required: true,
                minlength: 3
            },
            expense_date: {
                required: true,
                date: true
            },
            expense_amount: {
                required: true,
                number: true
            },
            expense_payment: {
                required: true,
                minlength: 3
            },
            expense_img: {
                extension: "jpg|jpeg|png|gif"
            }
        },
        messages: {
            expense_name: {
                required: "The expense name field is required",
                minlength: "The expense name must be at least 3 characters"
            },
            expense_date: {
                required: "The expense date field is required",
                date: "Please enter a valid date"
            },
            expense_amount: {
                required: "The expense amount field is required",
                number: "The expense amount must be a number"
            },
            expense_payment: {
                required: "The expense payment field is required",
                minlength: "The expense payment must be at least 3 characters"
            },
            expense_img: {
                required: "The expense img field is required",
                extension: "Please upload a valid image file (jpg, jpeg, png, gif)"
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});
</script>
@endsection