
    document.addEventListener('DOMContentLoaded', function() {
        const dataTable = new simpleDatatables.DataTable("#events-table", {
            searchable: true,
            perPage: 7,
            perPageSelect: [5, 10, 15, 20],
            columns: [
                { select: 0, sortable: false },
                { select: 1, sortable: true },
                { select: 2, sortable: true },
                { select: 3, sortable: true },
                { select: 4, sortable: true },
                { select: 5, sortable: false },
                { select: 6, sortable: false }
            ]
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const dataTable = new simpleDatatables.DataTable("#newspaper-table", {
            searchable: true,
            perPage: 7,
            perPageSelect: [5, 10, 15, 20],
            columns: [
                { select: 0, sortable: false },
                { select: 1, sortable: true },
                { select: 2, sortable: true },
                { select: 3, sortable: true },
                { select: 4, sortable: true },
                { select: 5, sortable: false },
                { select: 6, sortable: false }
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

