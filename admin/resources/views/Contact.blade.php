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
</script>

@endsection
