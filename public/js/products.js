$(document).ready(function() {
    $('#products-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('admin.products.index') }}',
        order: [[0, 'asc']], // Default sorting by the first column (ID) in ascending order
        columns: [
            { data: 'id', name: 'id' },
            { data: 'title', name: 'title' },
            { data: 'category.title', name: 'category.title' },
            { data: 'author', name: 'author' },
            { data: 'description', name: 'description', 
                render: function(data, type, full, meta) {
                    return data.length > 15 ? data.substr(0, 15) + '...' : data;
                }
            },
            { 
                data: 'demo_url', 
                name: 'demo_url',
                render: function(data, type, full, meta) {
                    return data ? `<img src="{{ asset('images/products/') }}/${data}" alt="Demo Image" width="50">` : 'No Image';
                }
            },
            { data: 'price', name: 'price' },
            { data: 'percent_discount', name: 'percent_discount' },
            { data: 'stock', name: 'stock' },
            { 
                data: 'action', 
                name: 'action', 
                orderable: false, 
                searchable: false,
                render: function(data, type, full, meta) {
                    return `
                        <a href="{{ route('admin.products.edit', '${full.id}') }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('admin.products.destroy', '${full.id}') }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    `;
                }
            }
        ]
    });
});
