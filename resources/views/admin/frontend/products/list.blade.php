@extends('admin.layouts.app')

@section('title', 'Admin - Products')

@section('content')
<!-- Products list start -->
<div class="main-content-inner">
    <div class="row">
        <table class="table" id="products-table">
            <thead class="table-light">
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Stock</th>
                    <th style="text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td style="width: 100px;">{{ $product->title }}</td>
                        <td style="width: 150px;">{{ $product->category->title }}</td>
                        <td style="width: 150px;">{{ $product->author }}</td>
                        {{-- <td>{{ substr($product->description, 0, 15) . '...' }}</td> --}}
                        <td style="width: 200px;">{{ Str::limit($product->description, 100) }}</td>

                        <td>
                            @if($product->demo_url)
                                <img src="{{ asset('images/products/' . $product->demo_url) }}" alt="Demo Image" width="50">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>${{ $product->price }}</td>
                        <td>{{ $product->percent_discount }}</td>
                        <td>{{ $product->stock }}</td>
                        <td style="text-align: center;">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @for ($i = 0; $i < (10 - count($products)); $i++) <tr>
                        <td colspan="10">&nbsp;</td>
                        </tr>
                        @endfor
            </tbody>
        </table>

        <!-- Centered Pagination links -->
        <div class="pagination-wrapper" style="display: flex; justify-content: right;">
            {{ $products->links() }}
        </div>

    </div>
</div>
<!-- Products list end -->
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('js/products.js') }}"></script>
@endpush
