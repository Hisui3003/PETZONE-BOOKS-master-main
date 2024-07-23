@extends('admin.layouts.app')

@section('title', 'Admin-Add Expenses')

@section('content')
<!-- Add expense form start -->
<div class="col-12 mt-5">
    <div class="card">
        <form id="expenseForm" action="{{ route('admin.expenses.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <input name="expense_name" type="text" class="form-control" placeholder="Expense Name" aria-label="expense_name">
                    </div>
                    <div class="col">
                        <input name="expense_date" type="date" class="form-control" placeholder="Expense Date" aria-label="expense_date">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <input name="expense_amount" type="text" class="form-control" placeholder="Expense Amount" aria-label="expense_amount">
                    </div>
                    <div class="col">
                        <input name="expense_payment" type="text" class="form-control" placeholder="Expense Payment" aria-label="expense_payment">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <input name="expense_img" type="file" accept="image/*" aria-label="expense_img">
                    </div>
                </div>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-primary" type="submit">Add Expense</button>
            </div>
        </form>
    </div>
</div>
<!-- Add expense form end -->

@endsection

@section('scripts')
<!-- Include jQuery and jQuery Validation plugin -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.19.3/jquery.validate.min.js"></script>

<script>
$(document).ready(function() {
    console.log("jQuery is loaded:", typeof $ !== 'undefined');
    console.log("jQuery Validation is loaded:", typeof $.fn.validate !== 'undefined');

    $("#expenseForm").validate({
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
                required: true,
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
            console.log("Form is valid and ready to be submitted!");
            form.submit();
        }
    });
});
</script>
@endsection
