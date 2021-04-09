@extends('layout.app')
@section('content')


<div id="main-ser" class="container d-none"><!--Here is used axios js to get Service Data form Database start-->
<div class="row">
<div class="col-md-12 p-5">
<table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
</div><!--Here is used axios js to get Service Data form Database start-->

<div id="loader-div" class="container"><!--loadin animation start-->
<div class="row">
<div class="col-md-12 text-center p-5">
	<img class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
</div>
</div>
</div><!--loadin animation end-->


<div id="wrong-div" class="container d-none"><!--here used a massage if data is not available start-->
<div class="row">
<div class="col-md-12 text-center">
	<h4>Sorry can't found any data</h4>
</div>
</div>
</div><!--here used a massage if data is not available start-->







@endsection

@section('script')

	<script type="text/javascript">
		
		getServiceData();
	</script>

@endsection
