document.addEventListener('DOMContentLoaded', function() {
    const dataTable = new simpleDatatables.DataTable("#events-table", {
        searchable: true,
        perPage: 10,
        perPageSelect: [5, 10, 15, 20],
        columns: [
            { select: 0, sortable: false }, // S.No
            { select: 1, sortable: true },  // Event Title
            { select: 2, sortable: true },  // Date
            { select: 3, sortable: true },  // Time
            { select: 4, sortable: true },  // Venue
            { select: 5, sortable: false }, // Created By
            { select: 6, sortable: false }   // Action
        ]
    });
});



function confirmDelete(eventId) {
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this event!",
        icon: "warning",
        buttons: {
            cancel: "Cancel",
            confirm: {
                text: "Delete",
                value: true,
                closeModal: true
            }
        },
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            document.getElementById('delete-form-' + eventId).submit();
        }
    });
}

// Handle export button
$('#exportBtn').on('click', function() {
    // Implement export logic here
    alert('export feature is not yet implemented.');
});

// Handle import button
$('#importBtn').on('click', function() {
    // Implement import logic here
    // You may want to open a modal for file upload
    alert('Import feature is not yet implemented.');
});
