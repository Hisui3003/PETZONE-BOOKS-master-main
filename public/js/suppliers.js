$(document).ready(function() {
    $('#suppliers-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('admin.suppliers.index') }}',
        order: [[0, 'asc']], // Default sorting by the first column (ID) in ascending order
        columns: [
            { data: 'supplier_name', name: 'supplier_name' },
            { data: 'contact_number', name: 'contact_number' },
            { data: 'address', name: 'address' },
            { 
                data: 'image_path', 
                name: 'image_path',
                render: function(data, type, full, meta) {
                    return data ? `<img src="{{ asset('storage/') }}/${data}" alt="Supplier Image" width="50">` : 'No Image';
                }
            },
            { data: 'prod_id', name: 'prod_id' },
            { 
                data: 'action', 
                name: 'action', 
                orderable: false, 
                searchable: false,
                render: function(data, type, full, meta) {
                    return `
                        <a href="{{ route('admin.suppliers.edit', '${full.id}') }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('admin.suppliers.destroy', '${full.id}') }}" method="POST" style="display:inline;">
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
