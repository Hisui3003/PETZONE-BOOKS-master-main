@extends('admin.layouts.app')

@section('title', 'Admin - Users')

@section('content')
<!-- Users list start -->
<div class="main-content-inner">
    <div class="row">
        <table class="table" id="users-table">
            <thead class="table-light">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Number</th>
                    <th>Address</th>
                    <th>Image</th>
                    <th style="text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->phone_number }}</td>
                    <td>{{ $user->address }}</td>
                    <td>
                        @if($user->image_path)
                        <img src="{{ asset('storage/' . $user->image_path) }}" alt="Profile Image" width="50">
                        @else
                        No Image
                        @endif
                    </td>
                    <td style="text-align: center;">
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @for ($i = 0; $i < (10 - count($users)); $i++) <tr>
                    <td colspan="8">&nbsp;</td>
                    </tr>
                    @endfor
            </tbody>
        </table>

        <!-- Centered Pagination links -->
        <div class="pagination-wrapper" style="display: flex; justify-content: right;">
            {{ $users->links() }}
        </div>
    </div>
</div>
<!-- Users list end -->
@endsection


@push('styles')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('js/users.js') }}"></script>
@endpush
