@extends('layout.app')
@section('content')
<!--get Review data start-->
<div id="maindivReview" class="container d-none">
<div class="row">
<div class="col-md-12 p-5">
<button id="addNewBtnReviewId" class="btn btn-sm btn-danger my-3">Add New</button>
<table id="ReviewDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Image</th>
	  <th class="th-sm">Name</th>
	  <th class="th-sm">Description</th>
	  <th class="th-sm">Edit</th>
	  <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id="review_table">
  	
  </tbody>
</table>

</div>
</div>
</div>

<!--loader images start-->
<div id="loaderdivReview" class="container">
	<div class="row">
		<div class="col-md-12 p5 text-center">
			<img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
		</div>
	</div>
</div>
<!--data not found text-->
<div id="wrongdivReview"  class="container d-none">
	<div class="row">
		<div class="col-md-12 p5 text-center">
			<h4>Can not found any data</h4>
		</div>
	</div>
</div>

<!--Delete Review modal-->
<div class="modal fade" id="deleteReviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body p-3">
      <h4 class="text-center  mt-3"> Do you want to delete </h4>
      <h4 id="reviewDeleteId" class="text-center p-3 mt-3 d-none"> </h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">No</button>
        <button  id="reviewDeleteConfirmBtn" type="button" class="btn btn-sm btn-success">Yes</button>
      </div>
    </div>
  </div>
</div>

<!--Edit Review modal-->
<div class="modal fade" id="editReviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
          <div class="modal-header">
        <h5 class="modal-title">Review Service</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center p-5">
     <h4 id="reviewEditId" class="p-3 mt-3 d-none"> </h4> 
     <div id="reviewEditForm" class="w-100 d-none">	
	    <input type="text" id="reviewNameId" class="form-control my-3"  placeholder="Review Name" />
	    <input type="text" id="reviewDesId" class="form-control mb-3"  placeholder="Review Description" />
	    <input type="text" id="reviewImgId" class="form-control mb-3"  placeholder="Review Images Link" />
	</div>

		<!--lodaer imgae for Review edit details show late or -->
		    <img id="reviewEditLoader" class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
		<!--Data not found for Review edit details show late or other reasons -->
			<h5 id="reviewEditWrong" class="d-none">Can not found any data</h5>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
        <button  id="reviewEditConfirmBtn" type="button" class="btn btn-sm btn-success">Save</button>
      </div>
    </div>
  </div>
</div>

<!--Add New Review modal-->
<div class="modal fade" id="addReviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-body text-center p-5">

     <div class="w-100">
       <h5>Add New Review</h5>
	   <input type="text" id="ReviewNameAddId" class="form-control my-3"  placeholder="Review Name" />
	   <input type="text" id="ReviewDesAddId" class="form-control mb-3"  placeholder="Review Description" />
	   <input type="text" id="ReviewImageAddId" class="form-control mb-3"  placeholder="Review Images Link" />
	</div>
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
        <button  id="ReviewAddConfirmBtn" type="button" class="btn btn-sm btn-success">Add New</button>
      </div>
    </div>
  </div>
@endsection
@section('script')
<script type="text/javascript">

getReviewData();

// get Review Data 
function getReviewData() {
    axios.get('/getReviewData')
        .then(function(response) {
            if (response.status == 200) {
                $('#maindivReview').removeClass('d-none');
                $('#loaderdivReview').addClass('d-none');

                $('#ReviewDataTable').DataTable().destroy();
                $('#review_table').empty();

                var jsonData = response.data;
                $.each(jsonData, function(i) {
                    $('<tr>').html(
                        "<td> <img class='table-img' src=" + jsonData[i].img + "> </td>" +
                        "<td> " + jsonData[i].name + "</td>" +
                        "<td> " + jsonData[i].des + " </td>" +
                        "<td> <a class='reviewEditbtn' data-id=" + jsonData[i].id + "><i class='fas fa-edit'></i></a> </td>" +
                        "<td> <a class='reviewDeletebtn' data-id=" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a> </td>"
                    ).appendTo('#review_table');
                });

                //Review table delete icon click
                $('.reviewDeletebtn').click(function() {
                    var id = $(this).data('id');
                    $('#reviewDeleteId').html(id);
                    $('#deleteReviewModal').modal('show');

                });

                //Review table Edit icon click
                $('.reviewEditbtn').click(function() {
                    var id = $(this).data('id');
                    ReviewUpdateDetails(id);
                    $('#reviewEditId').html(id);
                    $('#editReviewModal').modal('show');

                });

                //Jquery Data Table plugin

                $('#ReviewDataTable').DataTable({
                    "order": false
                });
                $('.dataTables_length').addClass('bs-select');

            } else {
                $('#loaderdivReview').add_class('d-none');
                $('#wrongdivReview').removeClass('d-none');
            }
 			}).catch(function(error) {
            $('#loaderdivReview').add_class('d-none');
            $('#wrongdivReview').removeClass('d-none');
        });
}
// Review Delete
function ReviewDelete(deleteid) {

    $('#reviewDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm text-danger' role='status'></div>") //Animation to

    axios.post('/reviewDelete', {
            id: deleteid
        })
        .then(function(response) {
            $('#reviewDeleteConfirmBtn').html("Yes");

            if (response.status == 200) {
                if (response.data == 1) {
                    $('#deleteReviewModal').modal('hide');
                    toastr.success('Delete Successful');
                    getReviewData();
                } else {
                    $('#deleteReviewModal').modal('hide');
                    toastr.error('Delete failed');
                    getReviewData();
                }

            } else {

                $('#deleteReviewModal').modal('hide');
                toastr.error('Something went wrong');
            }

        }).catch(function(error) {
            $('#deleteReviewModal').modal('hide');
            toastr.error('Something went wrong');

        });

}

//Review Delete Confimation btn
$('#reviewDeleteConfirmBtn').click(function() {
    var id = $('#reviewDeleteId').html()
    ReviewDelete(id);
});

// Each Review Update Details Edit
function ReviewUpdateDetails(detailsid) {
    axios.post('/ReviewDetails', {
            id: detailsid
        })
        .then(function(response) {
            if (response.status == 200) {
                $('#reviewEditForm').removeClass('d-none');
                $('#reviewEditLoader').addClass('d-none');
                var jsonData = response.data;
                $('#reviewNameId').val(jsonData[0].name);
                $('#reviewDesId').val(jsonData[0].des);
                $('#reviewImgId').val(jsonData[0].img);
            } else {
                $('#reviewEditLoader').addClass('d-none');
                $('#reviewEditWrong').removeClass('d-none');
            }

        }).catch(function(error) {

            $('#reviewEditLoader').addClass('d-none');
            $('#reviewEditWrong').removeClass('d-none');
        });
}
// Each Review Update  Edit
function reviewUpdate(reviewId, reviewName, reviewDes, reviewImg) {

    if (reviewName.length == 0) {
        toastr.error('Review Name is empty');

    } else if (reviewDes.length == 0) {
        toastr.error('Review Description is empty');

    } else if (reviewImg.length == 0) {
        toastr.error('Review Image is empty');

    } else {
        $('#reviewEditConfirmBtn').html("<div class='spinner-border spinner-border-sm text-danger' role='status'></div>") //Animation to
        axios.post('/ReviewUpdate', {
                id: reviewId,
                name: reviewName,
                des: reviewDes,
                img: reviewImg,

            })
            .then(function(response) {
                $('#reviewEditConfirmBtn').html("Save");

                if (response.status == 200) {
                    if (response.data == 1) {
                        $('#editReviewModal').modal('hide');
                        toastr.success('Update Successful');
                        getReviewData();

                    } else {
                        $('#editReviewModal').modal('hide');
                        toastr.error('Update failed');
                        getReviewData();
                    }

                } else {
                    $('#editReviewModal').modal('hide');
                    toastr.error('Something went wrong');

                }

            }).catch(function(error) {

                $('#editReviewModal').modal('hide');
                toastr.error('Something went wrong');

            });
    }
}

//Review Edit Modal Save Btn
$('#reviewEditConfirmBtn').click(function() {
    var reviewId = $('#reviewEditId').html();
    var reviewName = $('#reviewNameId').val();
    var reviewDes = $('#reviewDesId').val();
    var reviewImg = $('#reviewImgId').val();
    reviewUpdate(reviewId, reviewName, reviewDes, reviewImg);
});

//Add Review modal Table
$('#addNewBtnReviewId').click(function() {
    $('#addReviewModal').modal('show');
});

// Review Add Method
function reviewAdd(reviewName, reviewDes, reviewImg) {

    if (reviewName.length == 0) {
        toastr.error('Review Name is empty');

    } else if (reviewDes.length == 0) {
        toastr.error('Review Description is empty');

    } else if (reviewImg.length == 0) {
        toastr.error('Review Fee is empty');
    } else {
        $('#ReviewAddConfirmBtn').html("<div class='spinner-border spinner-border-sm text-danger' role='status'></div>") //Animation to
        axios.post('/ReviewAdd', {
                name: reviewName,
                des: reviewDes,
                img: reviewImg,
            })
            .then(function(response) {
                $('#ReviewAddConfirmBtn').html("Add New");

                if (response.status == 200) {
                    if (response.data == 1) {
                        $('#addReviewModal').modal('hide');
                        toastr.success('Review added successfully');
                        getReviewData();
                    } else {
                        $('#addReviewModal').modal('hide');
                        toastr.error('Review Add failed');
                        getReviewData();
                    }
                } else {
                    $('#addReviewModal').modal('hide');
                    toastr.error('Review Add failed');
                }
            }).catch(function(error) {
                $('#addReviewModal').modal('hide');
                toastr.error('Review Add failed');
            });
    }
}

//Review Add Modal Save Btn
$('#ReviewAddConfirmBtn').click(function() {
    var reviewName = $('#ReviewNameAddId').val();
    var reviewDes = $('#ReviewDesAddId').val();
    var reviewImg = $('#ReviewImageAddId').val();
    reviewAdd(reviewName, reviewDes, reviewImg);
});
</script>
@endsection
