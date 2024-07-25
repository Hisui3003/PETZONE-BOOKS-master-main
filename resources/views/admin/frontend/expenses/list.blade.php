@extends('admin.layouts.app')

@section('title', 'Admin-Expenses')

@section('content')
<!-- Expenses list start -->
<div class="main-content-inner">
    <div class="row">
        <table class="table table-minimalist" id="expenses-table">
            <thead class="table-light">
                <tr>
                    <th>Id</th>
                    <th>Expense Name</th>
                    <th>Date</th>
                    <th>Expense Amount</th>
                    <th>Payment</th>
                    <th>Expense Image</th>
                    <th style="text-align: center;">Action</th>
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
                    <td style="text-align: center;">
                        <a href="{{ route('admin.expenses.edit', $expense->id) }}"
                            class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('admin.expenses.destroy', $expense->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @for ($i = 0; $i < (10 - count($expenses)); $i++) <tr>
                    <td colspan="7">&nbsp;</td>
                    </tr>
                    @endfor
            </tbody>
        </table>

        <!-- Centered Pagination links -->
        <div class="pagination-wrapper" style="display: flex; justify-content: right;">
            {{ $expenses->links() }}
        </div>
    </div>
</div>
<!-- Expenses list end -->
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
{{--
<link rel="stylesheet" href="{{ asset('css/table.css') }}"> --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('js/expenses.js') }}"></script>
@endpush
