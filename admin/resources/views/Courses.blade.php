@extends('layout.app')
@section('content')

<div id="mainDivCourse" class="container d-none">
<div class="row">
<div class="col-md-12 p-5">

<button id="addNewCourseBtnId" class="btn btn-sm btn-danger my-3">Add New</button>

<table id="courseDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
 
	  <th class="th-sm">Name</th>
	  <th class="th-sm">Fee</th>
	  <th class="th-sm">Class</th>
	  <th class="th-sm">Enroll</th>
	  <th class="th-sm">Edit</th>
	   <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id="Course_table">

  </tbody>
</table>
</div>
</div>
</div>

<!--loader images start-->
<div id="loaderdivCourse" class="container">
	<div class="row">
		<div class="col-md-12 p5 text-center">
			<img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
		</div>
	</div>
</div>
<!--data not found text-->
<div id="wrongdivCourse"  class="container d-none">
	<div class="row">
		<div class="col-md-12 p5 text-center">
			<h4>Can not found any data</h4>
		</div>
	</div>
</div>


<!--Add New Course Modal-->
<div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Add New Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
       <div class="container">
       	<div class="row">
       		<div class="col-md-6">
             	<input id="CourseNameId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
          	 	<input id="CourseDesId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
    		 	<input id="CourseFeeId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
     			<input id="CourseEnrollId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
       		</div>
       		<div class="col-md-6">
     			<input id="CourseClassId" type="text" id="" class="form-control mb-3" placeholder="Total Class">      
     			<input id="CourseLinkId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
     			<input id="CourseImgId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
       		</div>
       	</div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="CourseAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Add New</button>
      </div>
    </div>
  </div>
</div>


<!--Update Course Modal-->
<div class="modal fade" id="updateCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Update Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
       <h4 id="courseEditId" class="py-2 d-none"></h4>

       <div id="courseEditForm" class="container d-none">
        <div class="row">
            
            <div class="col-md-6">
            <input id="CourseNameUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
            <input id="CourseDesUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
            <input id="CourseFeeUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
            <input id="CourseEnrollUpdateId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
            </div>
            <div class="col-md-6">
            <input id="CourseClassUpdateId" type="text" id="" class="form-control mb-3" placeholder="Total Class">      
            <input id="CourseLinkUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
            <input id="CourseImgUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
            </div>
            
        </div>
       </div>

          <!--lodaer imgae for Course edit details show late or -->
        <img id="CourseEditLoader" class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
    <!--Data not found for Course edit details show late or other reasons -->
      <h5 id="CourseEditWrong" class="d-none">Can not found any data</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="CourseUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>


<!--Delete modal-->
<div class="modal fade" id="deleteCourseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body p-3">
      <h4 class="text-center  mt-3"> Do you want to delete </h4>
      <h4 id="CourseDeleteId" class="text-center p-3 mt-3 d-none"> </h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">No</button>
        <button  id="CourseDeleteConfirmBtn" type="button" class="btn btn-sm btn-success">Yes</button>
      </div>
    </div>
  </div>
</div>
@endsection



@section('script')
<script type="text/javascript">
	getCoursesData();

//For Course table
function getCoursesData() {


    axios.get('getCoursesData')
        .then(function(response) {

            if (response.status == 200) {

                $('#mainDivCourse').removeClass('d-none');
                $('#loaderdivCourse').addClass('d-none');

                $('#courseDataTable').DataTable().destroy();
                $('#Course_table').empty();

                var jsonData = response.data;
                $.each(jsonData, function(i, item) {
                    $('<tr>').html(
                        "<td>" + jsonData[i].course_name + "</td>" +
                        "<td> " + jsonData[i].course_fee + " </td>" +
                        "<td> " + jsonData[i].course_totalclass + " </td>" +
                        "<td> " + jsonData[i].course_totalenroll + " </td>" +
                        "<td> <a class='courseEditbtn'   data-id=" + jsonData[i].id + "><i class='fas fa-edit'></i></a> </td>" +
                        "<td> <a class='courseDeletebtn' data-id=" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a> </td>"
                    ).appendTo('#Course_table');
                });

                //Course table Delete Icon Click
                $('.courseDeletebtn').click(function() {
                    var id = $(this).data('id');
                    $('#CourseDeleteId').html(id);
                    $('#deleteCourseModal').modal('show');
                });

                //Course table Update Modal Modals
                $('.courseEditbtn').click(function() {
                    var id = $(this).data('id');
                    CourseUpdateDetails(id);
                    $('#courseEditId').html(id);
                    $('#updateCourseModal').modal('show');
                });
                //Jquery Data Table plugin

                $('#courseDataTable').DataTable({"order": false});
                $('.dataTables_length').addClass('bs-select');


            } else {

                $('#loaderdivCourse').addClass('d-none');
                $('#wrongdivCourse').removeClass('d-none');
            }


        }).catch(function(error) {

            $('#loaderdivCourse').addClass('d-none');
            $('#wrongdivCourse').removeClass('d-none');
        }) //getServiceData end here


}

//Add Course modal Table
$('#addNewCourseBtnId').click(function() {

    $('#addCourseModal').modal('show');
});

//Course Add Modal Save Btn
$('#CourseAddConfirmBtn').click(function() {
    var courseName = $('#CourseNameId').val();
    var CourseDes = $('#CourseDesId').val();
    var CourseFee = $('#CourseFeeId').val();
    var CourseEnroll = $('#CourseEnrollId').val();
    var CourseClass = $('#CourseClassId').val();
    var CourseLink = $('#CourseLinkId').val();
    var CourseImg = $('#CourseImgId').val();

    CourseAdd(courseName, CourseDes, CourseFee, CourseEnroll, CourseClass, CourseLink, CourseImg);

});

// Course Add Method

function CourseAdd(CourseName, CourseDes, CourseFee, CourseEnroll, CourseClass, CourseLink, CourseImg) {

    if (CourseName.length == 0) {
        toastr.error('Course Name is empty');

    } else if (CourseDes.length == 0) {
        toastr.error('Course Description is empty');

    } else if (CourseFee.length == 0) {
        toastr.error('Course Fee is empty');

    } else if (CourseEnroll.length == 0) {
        toastr.error('Course Enroll is empty');

    } else if (CourseClass.length == 0) {
        toastr.error('Course Class is empty');

    } else if (CourseLink.length == 0) {
        toastr.error('Course Link is empty');

    } else if (CourseImg.length == 0) {
        toastr.error('Course image is empty');

    } else {
        $('#CourseAddConfirmBtn').html("<div class='spinner-border spinner-border-sm text-danger' role='status'></div>") //Animation to
        axios.post('/CourseAdd', {
                course_name: CourseName,
                course_des: CourseDes,
                course_fee: CourseFee,
                course_totalenroll: CourseEnroll,
                course_totalclass: CourseClass,
                course_link: CourseLink,
                course_img: CourseImg,

            })
            .then(function(response) {
                $('#CourseAddConfirmBtn').html("Add New");

                if (response.status == 200) {
                    if (response.data == 1) {
                        $('#addCourseModal').modal('hide');
                        toastr.success('Course added successfully');
                        getCoursesData();

                    } else {
                        $('#addCourseModal').modal('hide');
                        toastr.error('Course Add failed');
                        getCoursesData();
                    }

                } else {
                    $('#addCourseModal').modal('hide');
                    toastr.error('Something went');

                }




            }).catch(function(error) {

                $('#addCourseModal').modal('hide');
                toastr.error('Something went wrong');

            });
    }
}

//Course Confirmation btn delete 
$('#CourseDeleteConfirmBtn').click(function() {
    var id = $('#CourseDeleteId').html();
    CourseDelete(id);
});


// Course Delete
function CourseDelete(deleteid) {

    $('#CourseDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm text-danger' role='status'></div>") //Animation to

    axios.post('/CoursesDelete', {
            id: deleteid
        })
        .then(function(response) {
            $('#CourseDeleteConfirmBtn').html("Yes");

            if (response.status == 200) {
                if (response.data == 1) {
                    $('#deleteCourseModal').modal('hide');
                    toastr.success('Delete Successful');
                    getCoursesData();
                } else {
                    $('#deleteCourseModal').modal('hide');
                    toastr.error('Delete failed');
                    getCoursesData();
                }

            } else {

                $('#deleteCourseModal').modal('hide');
                toastr.error('Something went wrong');
            }



        }).catch(function(error) {
            $('#deleteCourseModal').modal('hide');
            toastr.error('Something went wrong');

        });
}

//Course Update Modal 
function CourseUpdateDetails(detailsid) {
    axios.post('/CourseDetails', {
            id: detailsid
        })
        .then(function(response) {
            if (response.status == 200) {
                $('#courseEditForm').removeClass('d-none');
                $('#CourseEditLoader').addClass('d-none');
                var jsonData = response.data;
                $('#CourseNameUpdateId').val(jsonData[0].course_name);
                $('#CourseDesUpdateId').val(jsonData[0].course_des);
                $('#CourseFeeUpdateId').val(jsonData[0].course_fee);
                $('#CourseEnrollUpdateId').val(jsonData[0].course_totalenroll);
                $('#CourseClassUpdateId').val(jsonData[0].course_totalclass);
                $('#CourseLinkUpdateId').val(jsonData[0].course_link);
                $('#CourseImgUpdateId').val(jsonData[0].course_img);

            } else {
                $('#CourseEditLoader').addClass('d-none');
                $('#CourseEditWrong').removeClass('d-none');
            }

        }).catch(function(error) {

            $('#CourseEditLoader').addClass('d-none');
            $('#CourseEditWrong').removeClass('d-none');
        });


}

//Course Update Confirmation btn
$('#CourseUpdateConfirmBtn').click(function() {
    var courseId = $('#courseEditId').html();
    var courseName = $('#CourseNameUpdateId').val();
    var courseDes = $('#CourseDesUpdateId').val();
    var courseFee = $('#CourseFeeUpdateId').val();
    var courseEnroll = $('#CourseEnrollUpdateId').val();
    var courseClass = $('#CourseClassUpdateId').val();
    var courseLink = $('#CourseLinkUpdateId').val();
    var courseImg = $('#CourseImgUpdateId').val();
    CourseUpdate(courseId, courseName, courseDes, courseFee, courseEnroll, courseClass, courseLink, courseImg);
});

// Each Course Update  Edit
function CourseUpdate(courseId, courseName, courseDes, courseFee, courseEnroll, courseClass, courseLink, courseImg) {

    if (courseName.length == 0) {
        toastr.error('course Name is empty');

    } else if (courseDes.length == 0) {
        toastr.error('Course Description is empty');

    } else if (courseFee.length == 0) {
        toastr.error('course Image is empty');

    } else if (courseEnroll.length == 0) {
        toastr.error('course Enroll is empty');

    } else if (courseClass.length == 0) {
        toastr.error('course Class is empty');

    } else if (courseLink.length == 0) {
        toastr.error('course Link is empty');

    } else if (courseImg.length == 0) {
        toastr.error('course Img is empty');

    } else {
        $('#CourseUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm text-danger' role='status'></div>") //Animation to
        axios.post('/CourseUpdate', {
                id: courseId,
                course_name: courseName,
                course_des: courseDes,
                course_fee: courseFee,
                course_totalenroll: courseEnroll,
                course_totalclass: courseClass,
                course_link: courseLink,
                course_img: courseImg,

            })
            .then(function(response) {
                $('#CourseUpdateConfirmBtn').html("Save");

                if (response.status == 200) {
                    if (response.data == 1) {
                        $('#updateCourseModal').modal('hide');
                        toastr.success('Update Successful');
                        getCoursesData();
                    } else {
                        $('#updateCourseModal').modal('hide');
                        toastr.error('Update failed');
                        getCoursesData();
                    }

                } else {
                    $('#updateCourseModal').modal('hide');
                    toastr.error('Something went wrong');

                }




            }).catch(function(error) {

                $('#updateCourseModal').modal('hide');
                toastr.error('Something went wrong');

            });
    }
}

</script>
@endsection