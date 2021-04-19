//For contact table
function getContactData() {


    axios.get('/getContactData')
        .then(function(response) {

            if (response.status == 200) {

                $('#mainDivContact').removeClass('d-none');
                $('#loaderdivContact').addClass('d-none');

                $('#ContactDataTable').DataTable().destroy();
                $('#contact_table').empty();


                var jsonData = response.data;
                $.each(jsonData, function(i, item) {
                    $('<tr>').html(
                        "<td> " + jsonData[i].contact_name + " </td>" +
                        "<td> " + jsonData[i].contact_mobile + " </td>" +
                        "<td> " + jsonData[i].contact_email + " </td>" +
                        "<td> " + jsonData[i].contact_msg + " </td>" +
                        "<td> <a class='contactDeletebtn' data-id=" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a> </td>"
                    ).appendTo('#contact_table');
                });

                //Services table delete icon click
                $('.contactDeletebtn').click(function() {
                    var id = $(this).data('id');
                    $('#ContactDeleteId').html(id);
                    $('#ContactdeleteModal').modal('show');

                })

 
                $('#ContactDataTable').DataTable({"order":false});
                    $('.dataTables_length').addClass('bs-select');


            } else {

                $('#loaderdivContact').addClass('d-none');
                $('#wrongdivContact').removeClass('d-none');
            }


        }).catch(function(error) {
				$('#loaderdivContact').addClass('d-none');
                $('#wrongdivContact').removeClass('d-none');
        }) //getServiceData end here

}


         //Services Delete Modal Yes Btn
         $('#ContactDeleteConfirmBtn').click(function() {
        var id = $('#ContactDeleteId').html();
        ContactDelete(id);
        })

// Service Delete
function ContactDelete(deleteid) {

     $('#ContactDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm text-danger' role='status'></div>") //Animation to

    axios.post('/ContactDelete', {
            id: deleteid
        })
        .then(function(response) {
            $('#ContactDeleteConfirmBtn').html("Yes");

            if(response.status == 200){
                 if (response.data == 1) {
                $('#ContactdeleteModal').modal('hide');
                toastr.success('Delete Successful');
                getContactData();
            } else {
                $('#ContactdeleteModal').modal('hide');
                toastr.error('Delete failed');
                getContactData();
            }

            }else {
                
                $('#ContactdeleteModal').modal('hide');
            toastr.error('Something went wrong');
            }

           

        }).catch(function(error) {
            $('#ContactdeleteModal').modal('hide');
            toastr.error('Something went wrong');

        });


}

