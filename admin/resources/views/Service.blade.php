@extends('layout.app')
@section('content')

<!--get service data start-->
<div id="maindiv" class="container d-none">
<div class="row">
<div class="col-md-12 p-5">

<button id="addNewBtnId" class="btn btn-sm btn-danger my-3">Add New</button>

<table id="serviceDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Image</th>
	  <th class="th-sm">Name</th>
	  <th class="th-sm">Description</th>
	  <th class="th-sm">Edit</th>
	  <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id="service_table">
  
	
  </tbody>
</table>
</div>
</div>
</div>

<!--loader images start-->
<div id="loaderdiv" class="container">
	<div class="row">
		<div class="col-md-12 p5 text-center">
			<img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
		</div>
	</div>
</div>
<!--data not found text-->
<div id="wrongdiv"  class="container d-none">
	<div class="row">
		<div class="col-md-12 p5 text-center">
			<h4>Can not found any data</h4>
		</div>
	</div>
</div>

<!--Delete modal-->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body p-3">
      <h4 class="text-center  mt-3"> Do you want to delete </h4>
      <h4 id="serviceDeleteId" class="text-center p-3 mt-3 d-none"> </h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">No</button>
        <button  id="serviceDeleteConfirmBtn" type="button" class="btn btn-sm btn-success">Yes</button>
      </div>
    </div>
  </div>
</div>


<!--Edit modal-->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
          <div class="modal-header">
        <h5 class="modal-title">Update Service</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center p-5">
     <h4 id="serviceEditId" class="p-3 mt-3 d-none"> </h4> 
     <div id="ServiceEditForm" class="w-100 d-none">	
	    <input type="text" id="ServiceNameId" class="form-control my-3"  placeholder="Service Name" />
	    <input type="text" id="ServiceDesId" class="form-control mb-3"  placeholder="Service Description" />
	    <input type="text" id="ServiceImageId" class="form-control mb-3"  placeholder="Service Images Link" />
	</div>

		<!--lodaer imgae for service edit details show late or -->
		    <img id="ServiceEditLoader" class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
		<!--Data not found for service edit details show late or other reasons -->
			<h5 id="ServiceEditWrong" class="d-none">Can not found any data</h5>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
        <button  id="serviceEditConfirmBtn" type="button" class="btn btn-sm btn-success">Save</button>
      </div>
    </div>
  </div>
</div>

<!--Add New modal-->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-body text-center p-5">

     <div id="ServiceAddForm" class="w-100">
     	<h5>Add New Service</h5>
	    <input type="text" id="ServiceNameAddId" class="form-control my-3"  placeholder="Service Name" />
	    <input type="text" id="ServiceDesAddId" class="form-control mb-3"  placeholder="Service Description" />
	    <input type="text" id="ServiceImageAddId" class="form-control mb-3"  placeholder="Service Images Link" />
	</div>

		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
        <button  id="serviceAddConfirmBtn" type="button" class="btn btn-sm btn-success">Add New</button>
      </div>
    </div>
  </div>
</div>





@endsection

@section('script')

	<script type="text/javascript">
		getServicesData();


//For Services table
function getServicesData() {


    axios.get('/getServiceData')
        .then(function(response) {

            if (response.status == 200) {

                $('#maindiv').removeClass('d-none');
                $('#loaderdiv').addClass('d-none');

                $('#serviceDataTable').DataTable().destroy();
                $('#service_table').empty();


                var jsonData = response.data;
                $.each(jsonData, function(i, item) {
                    $('<tr>').html(
                        "<td> <img class='table-img' src=" + jsonData[i].service_img + "> </td>" +
                        "<td> " + jsonData[i].service_name + " </td>" +
                        "<td> " + jsonData[i].service_des + " </td>" +
                        "<td> <a class='serviceEditbtn'   data-id=" + jsonData[i].id + "><i class='fas fa-edit'></i></a> </td>" +
                        "<td> <a class='serviceDeletebtn' data-id=" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a> </td>"
                    ).appendTo('#service_table');
                });

                //Services table delete icon click
                $('.serviceDeletebtn').click(function() {
                    var id = $(this).data('id');
                    $('#serviceDeleteId').html(id);
                    $('#deleteModal').modal('show');

                })

             

                //Services Table  Edit Icon Clicked
                $('.serviceEditbtn').click(function() {
                    var id = $(this).data('id');
                    ServiceUpdateDetails(id);
                    $('#serviceEditId').html(id);
                    $('#editModal').modal('show');

                })

                
                $('#serviceDataTable').DataTable({"order":false});
                    $('.dataTables_length').addClass('bs-select');


            } else {

                $('#loaderdiv').addClass('d-none');
                $('#wrongdiv').removeClass('d-none');
            }


        }).catch(function(error) {

            $('#loaderdiv').addClass('d-none');
            $('#wrongdiv').removeClass('d-none');
        }) //getServiceData end here


}


         //Services Delete Modal Yes Btn
         $('#serviceDeleteConfirmBtn').click(function() {
        var id = $('#serviceDeleteId').html();
        ServiceDelete(id);
        })



// Service Delete
function ServiceDelete(deleteid) {

     $('#serviceDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm text-danger' role='status'></div>") //Animation to

    axios.post('/serviceDelete', {
            id: deleteid
        })
        .then(function(response) {
            $('#serviceDeleteConfirmBtn').html("Yes");

            if(response.status == 200){
                 if (response.data == 1) {
                $('#deleteModal').modal('hide');
                toastr.success('Delete Successful');
                getServicesData();
            } else {
                $('#deleteModal').modal('hide');
                toastr.error('Delete failed');
                getServicesData();
            }

            }else {
                
                $('#deleteModal').modal('hide');
            toastr.error('Something went wrong');
            }

           

        }).catch(function(error) {
            $('#deleteModal').modal('hide');
            toastr.error('Something went wrong');

        });


}

//Services Edit Modal Save Btn
   $('#serviceEditConfirmBtn').click(function() {

    var id = $('#serviceEditId').html();
    var name = $('#ServiceNameId').val();
    var des = $('#ServiceDesId').val();
    var img = $('#ServiceImageId').val();
    ServiceUpdate(id, name, des, img);
    
    })


// Each Service Update Details Edit
function ServiceUpdateDetails(detailsid) {
    axios.post('/ServiceDetails', {
            id: detailsid
        })
        .then(function(response) {
            if (response.status == 200) {
                $('#ServiceEditForm').removeClass('d-none');
                $('#ServiceEditLoader').addClass('d-none');
                var jsonData = response.data;
                $('#ServiceNameId').val(jsonData[0].service_name);
                $('#ServiceDesId').val(jsonData[0].service_des);
                $('#ServiceImageId').val(jsonData[0].service_name);
            } else {
                $('#ServiceEditLoader').addClass('d-none');
                $('#ServiceEditWrong').removeClass('d-none');
            }

        }).catch(function(error) {

            $('#ServiceEditLoader').addClass('d-none');
            $('#ServiceEditWrong').removeClass('d-none');
        });


}

// Each Service Update  Edit
function ServiceUpdate(serviceId, serviceName, serviceDes, serviceImg) {

    if (serviceName.length == 0) {
        toastr.error('Service Name is empty');

    } else if (serviceDes.length == 0) {
        toastr.error('Service Description is empty');

    } else if (serviceImg.length == 0) {
        toastr.error('Service Image is empty');

    } else {
        $('#serviceEditConfirmBtn').html("<div class='spinner-border spinner-border-sm text-danger' role='status'></div>") //Animation to
        axios.post('/serviceUpdate', {
                id: serviceId,
                name: serviceName,
                des: serviceDes,
                img: serviceImg,

            })
            .then(function(response) {
                $('#serviceEditConfirmBtn').html("Save");

                if(response.status == 200){
                     if (response.data == 1) {
                    $('#editModal').modal('hide');
                    toastr.success('Update Successful');
                    getServicesData();

                } else {
                    $('#editModal').modal('hide');
                    toastr.error('Update failed');
                    getServicesData();
                }

                }else{
                     $('#editModal').modal('hide');
                    toastr.error('Something went wrong');

                }

               


            }).catch(function(error) {

                $('#editModal').modal('hide');
                toastr.error('Something went wrong');

            });
    }
}

// Service Add New Btn Clicked
$('#addNewBtnId').click(function() {
    $('#addModal').modal('show');
});

//Services Add Modal Save Btn
   $('#serviceAddConfirmBtn').click(function() {
    var name = $('#ServiceNameAddId').val();
    var des = $('#ServiceDesAddId').val();
    var img = $('#ServiceImageAddId').val();
    ServiceAdd(name, des, img);
    
    })

// Service Add Method

function ServiceAdd(serviceName, serviceDes, serviceImg) {

    if (serviceName.length == 0) {
        toastr.error('Service Name is empty');

    } else if (serviceDes.length == 0) {
        toastr.error('Service Description is empty');

    } else if (serviceImg.length == 0) {
        toastr.error('Service Image is empty');

    } else {
        $('#serviceAddConfirmBtn').html("<div class='spinner-border spinner-border-sm text-danger' role='status'></div>") //Animation to
        axios.post('/serviceAdd', {
                name: serviceName,
                des: serviceDes,
                img: serviceImg,

            })
            .then(function(response) {
                $('#serviceAddConfirmBtn').html("Add New");

                if(response.status == 200){
                     if (response.data == 1) {
                    $('#addModal').modal('hide');
                    toastr.success('Add Successful');
                    getServicesData();

                } else {
                    $('#addModal').modal('hide');
                    toastr.error('Add failed');
                    getServicesData();
                }

                }else{
                     $('#addModal').modal('hide');
                    toastr.error('Something went wrong');

                }

               


            }).catch(function(error) {

                $('#addModal').modal('hide');
                toastr.error('Something went wrong');

            });
    }
}

	</script>

@endsection
