@extends('admin.layouts.app')

@section('title', 'Admin - Suppliers')

@section('content')
<!-- Suppliers table start -->
<div class="main-content-inner">
    <div class="row">
        <table class="table" id="suppliers-table">
            <thead class="table-light">
                <tr>
                    <th>Supplier Name</th>
                    <th>Contact Number</th>
                    <th>Address</th>
                    <th>Image</th>
                    <th>Product ID</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($suppliers as $supplier)
                    <tr>
                        <td>{{ $supplier->supplier_name }}</td>
                        <td>{{ $supplier->contact_number }}</td>
                        <td>{{ $supplier->address }}</td>
                        <td>
                            @if($supplier->image_path)
                                <img src="{{ asset('storage/' . $supplier->image_path) }}" alt="Supplier Image" width="50">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>{{ $supplier->prod_id }}</td>
                        <td>
                            <a href="{{ route('admin.suppliers.edit', $supplier->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('admin.suppliers.destroy', $supplier->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                {{ $suppliers->links() }}
            </ul>
        </nav>  
    </div>
</div>
<!-- Suppliers table end -->
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('js/suppliers.js') }}"></script>
@endpush
