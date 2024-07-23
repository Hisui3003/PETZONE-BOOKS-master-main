@extends('admin.layouts.app')

@section('title' , 'Admin-Expenses')

@section('content')
<!-- Users list start -->
<div class="main-content-inner">
    <div class="row">
        <table class="table" id="expenses-table">
            <thead class="table-light">
              <tr>
                <th>Id</th>
                <th>Expense Name</th>
                <th>Date</th>
                <th>Expense Amount</th>
                <th>Payment</th>
                <th>Expense Image</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach($expenses as $expense)
                    <tr>
                        <td>{{ $expense->id }}</td>
                        <td>{{ $expense->expense_name }}</td>
                        <td>{{ $expense->expense_date }}</td>
                        <td>{{ $expense->expense_amount }}</td>
                        <td>{{ $expense->expense_payment }}</td>
                        <td>
                            @if($expense->expense_img)
                                <img src="{{ asset('storage/' . $expense->expense_img) }}" alt="Expense Image" width="50">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.expenses.edit', $expense->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('admin.expenses.destroy', $expense->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- Expenses list end -->
@endsection


@push('styles')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('js/expenses.js') }}"></script>
@endpush
