@extends('admin.layouts.app')

@section('title' , 'Admin-Categories')

@section('content')
{{-- Add category form start --}}
<div class="col-12 mt-5">

     {{-- import button --}}
     {{-- for add.blade --}}
     <div class="container">
        <div>
            <form action="{{ route('categories.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="messages">
                  @if (session('success'))
                    <div class="alert alert-success">
                      {{ session('success') }}
                    </div>
                  @endif
                </div>
                <div class="fields">
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="import_csv" name="import_csv" accept=".csv">
                        <label class="input-group-text" for="import_csv">Upload</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Import CSV</button>
            </form>
        </div>
    </div>

  <div class="card">
    <form action="{{ route('admin.categories.storage') }}" method="POST">
    @csrf
      <div class="card-body">
          <div class="row">
              <div class="col">
                <input type="text" name="slug" class="form-control" placeholder="Website Genre" aria-label="slug">
              </div>
              <div class="col">
                <input type="text" name="title" class="form-control" placeholder="Category" aria-label="title">
              </div>
          </div>
      </div>
      <div class="d-grid gap-2 col-6 mx-auto">
          <button class="btn btn-primary" type="txt">Add Category</button>
      </div>
    </form>
  </div>
</div>
{{-- Add category form end --}}
<hr>
<!-- Categories list start -->
<div class="main-content-inner">
  <div class="row">
    <table class="table">
      <thead class="table-dark">
        <tr>
          <th>Id</th>
          <th>Website Genre</th>
          <th>Category</th>
          <!-- <th>Joined</th> -->
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($categories as $category)
          <tr>
            <th>{{ $category->id }}</th>
            <th>{{ $category->slug }}</th>
            <th>{{ $category->title }}</th>
            <!-- <th>{{ $category->created_at }}</th> -->
            <th>
              <form action="{{ route('admin.categories.destroy' , $category->id) }}" method="POST" id='prepare-form'>
              @csrf
              @method('delete')
                <button type="submit" id="button-delete"><span class="ti-trash"></span></button>
              </form>
              |
              <a href="{{ route('admin.categories.edit' , $category->id) }}" id="a-black"><span class="ti-pencil"></span></a>
            </th>
          </tr>
        @endforeach
      </tbody>
    </table>
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">
        {{ $categories->links() }}
      </ul>
    </nav>
  </div>
</div>
<!-- Categories list end -->
@endsection
