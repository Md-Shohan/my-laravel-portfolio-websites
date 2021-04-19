@extends('layout.app')
@section('content')

<!--get project data start-->
<div id="maindivProject" class="container d-none">
<div class="row">
<div class="col-md-12 p-5">
<button id="addNewBtnProjectId" class="btn btn-sm btn-danger my-3">Add New</button>
<table id="ProjectDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Image</th>
	  <th class="th-sm">Name</th>
	  <th class="th-sm">Description</th>
	  <th class="th-sm">Edit</th>
	  <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id="project_table">
  	
  </tbody>
</table>

</div>
</div>
</div>

<!--loader images start-->
<div id="loaderdivProject" class="container">
	<div class="row">
		<div class="col-md-12 p5 text-center">
			<img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
		</div>
	</div>
</div>
<!--data not found text-->
<div id="wrongdivProject"  class="container d-none">
	<div class="row">
		<div class="col-md-12 p5 text-center">
			<h4>Can not found any data</h4>
		</div>
	</div>
</div>

<!--Delete modal-->
<div class="modal fade" id="deleteProjectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body p-3">
      <h4 class="text-center  mt-3"> Do you want to delete </h4>
      <h4 id="projectDeleteId" class="text-center p-3 mt-3 d-none"> </h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">No</button>
        <button  id="projectDeleteConfirmBtn" type="button" class="btn btn-sm btn-success">Yes</button>
      </div>
    </div>
  </div>
</div>

<!--Edit modal-->
<div class="modal fade" id="editProjectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
          <div class="modal-header">
        <h5 class="modal-title">Project Service</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center p-5">
     <h4 id="projectEditId" class="p-3 mt-3 d-none"> </h4> 
     <div id="projectEditForm" class="w-100 d-none">	
	    <input type="text" id="ProjectNameId" class="form-control my-3"  placeholder="Project Name" />
	    <input type="text" id="ProjectDesId" class="form-control mb-3"  placeholder="Project Description" />
	    <input type="text" id="ProjectImageId" class="form-control mb-3"  placeholder="Project Images Link" />
	    <input type="text" id="ProjectLinkId" class="form-control mb-3"  placeholder="Project Link Link" />
	</div>

		<!--lodaer imgae for service edit details show late or -->
		    <img id="projectEditLoader" class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
		<!--Data not found for service edit details show late or other reasons -->
			<h5 id="projectEditWrong" class="d-none">Can not found any data</h5>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
        <button  id="projectEditConfirmBtn" type="button" class="btn btn-sm btn-success">Save</button>
      </div>
    </div>
  </div>
</div>

<!--Add New modal-->
<div class="modal fade" id="addProjectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-body text-center p-5">

     <div class="w-100">
       <h5>Add New Project</h5>
	   <input type="text" id="ProjectNameAddId" class="form-control my-3"  placeholder="Project Name" />
	   <input type="text" id="ProjectDesAddId" class="form-control mb-3"  placeholder="Project Description" />
	   <input type="text" id="ProjectImageAddId" class="form-control mb-3"  placeholder="Project Images Link" />
	   <input type="text" id="ProjectLinkAddId" class="form-control mb-3"  placeholder="Project Link Link" />
	</div>

		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
        <button  id="ProjectAddConfirmBtn" type="button" class="btn btn-sm btn-success">Add New</button>
      </div>
    </div>
  </div>

@endsection

@section('script')
<script type="text/javascript">
 getPorjectData();

function getPorjectData() {
    axios.get('/getProjectData')
        .then(function(response) {

            if (response.status == 200) {
                $('#maindivProject').removeClass('d-none');
                $('#loaderdivProject').addClass('d-none');

                $('#ProjectDataTable').DataTable().destroy();
                $('#project_table').empty();

                var jsonData = response.data;
                $.each(jsonData, function(i) {
                    $('<tr>').html(
                        "<td> <img class='table-img' src=" + jsonData[i].project_img + "> </td>" +
                        "<td> " + jsonData[i].project_name + "</td>" +
                        "<td> " + jsonData[i].project_des + " </td>" +
                        "<td> <a class='projectEditbtn' data-id=" + jsonData[i].id + "><i class='fas fa-edit'></i></a> </td>" +
                        "<td> <a class='projectDeletebtn' data-id=" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a> </td>"
                    ).appendTo('#project_table');
                });

                //project table delete icon click
                $('.projectDeletebtn').click(function() {
                    var id = $(this).data('id');
                    $('#projectDeleteId').html(id);
                    $('#deleteProjectModal').modal('show');

                });

                //project table Edit icon click
                $('.projectEditbtn').click(function() {
                    var id = $(this).data('id');
                    ProjectUpdateDetails(id);
                    $('#projectEditId').html(id);
                    $('#editProjectModal').modal('show');

                });

                //Jquery Data Table plugin

                $('#ProjectDataTable').DataTable({
                    "order": false
                });
                $('.dataTables_length').addClass('bs-select');

            } else {
                $('#loaderdivProject').add_class('d-none');
                $('#wrongdivProject').removeClass('d-none');
            }




        }).catch(function(error) {
            $('#loaderdivProject').add_class('d-none');
            $('#wrongdivProject').removeClass('d-none');
        })
}

//project Delete Confimation btn

$('#projectDeleteConfirmBtn').click(function() {
    var id = $('#projectDeleteId').html()
    ProjectDelete(id);
})

// Project Delete
function ProjectDelete(deleteid) {

    $('#projectDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm text-danger' role='status'></div>") //Animation to

    axios.post('/ProjectDelete', {
            id: deleteid
        })
        .then(function(response) {
            $('#projectDeleteConfirmBtn').html("Yes");

            if (response.status == 200) {
                if (response.data == 1) {
                    $('#deleteProjectModal').modal('hide');
                    toastr.success('Delete Successful');
                    getPorjectData();
                } else {
                    $('#deleteProjectModal').modal('hide');
                    toastr.error('Delete failed');
                    getPorjectData();
                }

            } else {

                $('#deleteProjectModal').modal('hide');
                toastr.error('Something went wrong');
            }



        }).catch(function(error) {
            $('#deleteProjectModal').modal('hide');
            toastr.error('Something went wrong');

        });


}
//Project Edit Modal Save Btn
$('#projectEditConfirmBtn').click(function() {

    var projectId = $('#projectEditId').html();
    var projectName = $('#ProjectNameId').val();
    var projectDes = $('#ProjectDesId').val();
    var projectImg = $('#ProjectImageId').val();
    var projectLink = $('#ProjectLinkId').val();
    projectUpdate(projectId, projectName, projectDes, projectImg, projectLink);

})

// Each Project Update Details Edit
function ProjectUpdateDetails(detailsid) {
    axios.post('/ProjectDetails', {
            id: detailsid
        })
        .then(function(response) {
            if (response.status == 200) {
                $('#projectEditForm').removeClass('d-none');
                $('#projectEditLoader').addClass('d-none');
                var jsonData = response.data;
                $('#ProjectNameId').val(jsonData[0].project_name);
                $('#ProjectDesId').val(jsonData[0].project_des);
                $('#ProjectImageId').val(jsonData[0].project_img);
                $('#ProjectLinkId').val(jsonData[0].project_link);
            } else {
                $('#projectEditLoader').addClass('d-none');
                $('#projectEditWrong').removeClass('d-none');
            }

        }).catch(function(error) {

            $('#projectEditLoader').addClass('d-none');
            $('#projectEditWrong').removeClass('d-none');
        });


}

// Each Service Update  Edit
function projectUpdate(projectId, projectName, projectDes, projectImg, projectLink) {

    if (projectName.length == 0) {
        toastr.error('Project Name is empty');

    } else if (projectDes.length == 0) {
        toastr.error('Project Description is empty');

    } else if (projectImg.length == 0) {
        toastr.error('Project Image is empty');

    } else if (projectLink.length == 0) {
        toastr.error('Project Image is empty');

    } else {
        $('#projectEditConfirmBtn').html("<div class='spinner-border spinner-border-sm text-danger' role='status'></div>") //Animation to
        axios.post('/ProjectUpdate', {
                id: projectId,
                project_name: projectName,
                project_des: projectDes,
                project_img: projectImg,
                project_link: projectLink,

            })
            .then(function(response) {
                $('#projectEditConfirmBtn').html("Save");

                if (response.status == 200) {
                    if (response.data == 1) {
                        $('#editProjectModal').modal('hide');
                        toastr.success('Update Successful');
                        getPorjectData();

                    } else {
                        $('#editProjectModal').modal('hide');
                        toastr.error('Update failed');
                        getPorjectData();
                    }

                } else {
                    $('#editProjectModal').modal('hide');
                    toastr.error('Something went wrong');

                }




            }).catch(function(error) {

                $('#editProjectModal').modal('hide');
                toastr.error('Something went wrong');

            });
    }
}


//Add Course modal Table
$('#addNewBtnProjectId').click(function() {

    $('#addProjectModal').modal('show');
});

//Course Add Modal Save Btn
$('#ProjectAddConfirmBtn').click(function() {
    var ProjectName = $('#ProjectNameAddId').val();
    var ProjectDes = $('#ProjectDesAddId').val();
    var ProjectImg = $('#ProjectImageAddId').val();
    var ProjectLink = $('#ProjectLinkAddId').val();

    projectAdd(ProjectName, ProjectDes, ProjectImg, ProjectLink);

})

// Course Add Method

function projectAdd(ProjectName, ProjectDes, ProjectImg, ProjectLink) {

    if (ProjectName.length == 0) {
        toastr.error('Course Name is empty');

    } else if (ProjectDes.length == 0) {
        toastr.error('Course Description is empty');

    } else if (ProjectImg.length == 0) {
        toastr.error('Course Fee is empty');

    } else if (ProjectLink.length == 0) {
        toastr.error('Course Enroll is empty');

    } else {
        $('#ProjectAddConfirmBtn').html("<div class='spinner-border spinner-border-sm text-danger' role='status'></div>") //Animation to
        axios.post('/ProjectAdd', {
                project_name: ProjectName,
                project_des: ProjectDes,
                project_img: ProjectImg,
                project_link: ProjectLink,

            })
            .then(function(response) {
                $('#ProjectAddConfirmBtn').html("Add New");

                if (response.status == 200) {
                    if (response.data == 1) {
                        $('#addProjectModal').modal('hide');
                        toastr.success('Course added successfully');
                        getPorjectData();

                    } else {
                        $('#addProjectModal').modal('hide');
                        toastr.error('Course Add failed');
                        getProjectData();
                    }

                } else {
                    $('#addProjectModal').modal('hide');
                    toastr.error('Course Add failed');
                }




            }).catch(function(error) {

                $('#addProjectModal').modal('hide');
                toastr.error('Course Add failed');

            });
    }
}
</script>
@endsection
