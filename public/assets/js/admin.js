var table = new DataTable('#daftar_admin', {
    ajax: 'kelola-admin/json',
    processing: true,
    serverSide: true,
    columns: [
      {data: 'id'},
      {data: 'nama'},
      {data: 'username'},      
      {data: 'status'},
      {data: 'id',
        render: function (data, type, row) {
          var deleteUrl = "{{ route('kelola_admin.destroy', ':data_id') }}"
          deleteUrl = deleteUrl.replace(':data_id', row.id);

          return `<button class="btn btn-warning" onclick="fillData(${row.id})">Edit</button>

                  <form id="delete-form-${row.id}" action="${deleteUrl}" method="POST" style="display:none;">
                      @csrf
                      @method('DELETE')
                  </form>
                  <button class="btn btn-danger" onclick="confirmDelete(${row.id})">Delete</button>`;
        }
      }
    ],
    responsive: true,
    order: [],
  });

  function fillData(id) {
    // Perform the AJAX request
    $.ajax({
        url: 'kelola-admin/json/' + id, // Server-side script URL
        type: 'GET', // Or 'POST'
        dataType: 'json', // Expecting JSON response
        success: function(data) {
            // On success, populate the modal fields with the received data
            $('#id').val(data.id);
            $('#nama').val(data.nama);
            $('#username').val(data.username);
    public/        $('#status').val(data.status);
            
            // Show the modal (if using Bootstrap JS)
            $('#edit-modal').modal('show');
        },
        error: function(xhr, status, error) {
            // Handle errors
            // console.error("AJAX error:", status, error);
            // alert("An error occurred while fetching details.");
        }
    });
  }

  function confirmDelete(id) {
    Swal.fire(
    {
      title: "Are you sure?",
      text: "You will not be able to recover this imaginary file!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false,
    }
    ).then((result) => {
      if (result.isConfirmed) {
        // Submit the form with the corresponding ID
        document.getElementById('delete-form-' + id).submit();
      }
    });
  }
  