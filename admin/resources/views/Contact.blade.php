@extends('layout.app')
@section('content')

<div id="mainDivContact" class="container  d-none">
<div class="row">
<div class="col-md-12 p-5">
<table id="ContactDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
	  <th class="th-sm">Name</th>
	  <th class="th-sm">Mobile</th>
	  <th class="th-sm">Email</th>
	  <th class="th-sm">Messages</th>
	  <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id="contact_table">
  
	
  </tbody>
</table>

</div>
</div>
</div>

<!--loader images start-->
<div id="loaderdivContact" class="container">
	<div class="row">
		<div class="col-md-12 p5 text-center">
			<img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
		</div>
	</div>
</div>
<!--data not found text-->
<div id="wrongdivContact"  class="container d-none">
	<div class="row">
		<div class="col-md-12 p5 text-center">
			<h4>Can not found any data</h4>
		</div>
	</div>
</div>

<!--Delete modal-->
<div class="modal fade" id="ContactdeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body p-3">
      <h4 class="text-center  mt-3"> Do you want to delete </h4>
      <h4 id="ContactDeleteId" class="text-center p-3 mt-3 d-none"> </h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">No</button>
        <button  id="ContactDeleteConfirmBtn" type="button" class="btn btn-sm btn-success">Yes</button>
      </div>
    </div>
  </div>
</div>
@endsection


@section('script')
<script type="text/javascript">
	 getContactData();

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

                //Contact table delete icon click
                $('.contactDeletebtn').click(function() {
                    var id = $(this).data('id');
                    $('#ContactDeleteId').html(id);
                    $('#ContactdeleteModal').modal('show');

                })


                $('#ContactDataTable').DataTable({
                    "order": false
                });
                $('.dataTables_length').addClass('bs-select');


            } else {

                $('#loaderdivContact').addClass('d-none');
                $('#wrongdivContact').removeClass('d-none');
            }


        }).catch(function(error) {
            $('#loaderdivContact').addClass('d-none');
            $('#wrongdivContact').removeClass('d-none');
        }) //getContactData end here

}


//Contact Delete Modal Yes Btn
$('#ContactDeleteConfirmBtn').click(function() {
    var id = $('#ContactDeleteId').html();
    ContactDelete(id);
})

// Contact Delete
function ContactDelete(deleteid) {

    $('#ContactDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm text-danger' role='status'></div>") //Animation to

    axios.post('/ContactDelete', {
            id: deleteid
        })
        .then(function(response) {
            $('#ContactDeleteConfirmBtn').html("Yes");

            if (response.status == 200) {
                if (response.data == 1) {
                    $('#ContactdeleteModal').modal('hide');
                    toastr.success('Delete Successful');
                    getContactData();
                } else {
                    $('#ContactdeleteModal').modal('hide');
                    toastr.error('Delete failed');
                    getContactData();
                }

            } else {

                $('#ContactdeleteModal').modal('hide');
                toastr.error('Something went wrong');
            }
        }).catch(function(error) {
            $('#ContactdeleteModal').modal('hide');
            toastr.error('Something went wrong');

        });


}


</script>

@endsection
