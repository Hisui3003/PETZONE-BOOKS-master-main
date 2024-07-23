//Initializing DataTable

$(document).ready(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('admin.users.index') }}',
        order: [[0, 'asc']], // Default sorting by the first column (ID) in ascending order
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'role', name: 'role' },
            { data: 'phone_number', name: 'phone_number' },
            { data: 'address', name: 'address' },
            { 
                data: 'image_path', 
                name: 'image_path',
                render: function(data, type, full, meta) {
                    return data ? `<img src="{{ asset('storage/') }}/${data}" alt="Profile Image" width="160" height="160">` : 'No Image';
                }
            },
            { 
                data: 'action', 
                name: 'action', 
                orderable: false, 
                searchable: false 
            }
        ]
    });
});