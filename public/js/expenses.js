//Initializing DataTable

$(document).ready(function() {
    $('#expenses-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('admin.expenses.index') }}',
        order: [[0, 'asc']], // Default sorting by the first column (ID) in ascending order
        columns: [
            { data: 'id', name: 'id' },
            { data: 'expense_name', title: 'expense_name' },
            { data: 'expense_date', title: 'expense_date' },
            { data: 'expense_amount', title: 'expense_amount' },
            { data: 'expense_payment', title: 'expense_payment' },
            { 
                data: 'expense_img', 
                name: 'expense_img',
                render: function(data, type, full, meta) {
                    return data ? `<img src="{{ asset('storage/') }}/${data}" alt="Expense Image" width="160" height="160">` : 'No Image';
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