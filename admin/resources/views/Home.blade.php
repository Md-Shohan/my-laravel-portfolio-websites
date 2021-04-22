@extends('Layout.app')
@section('title','Home')
@section('content')


<div class="container">
	<div class="row">

		<div class="col-md-3 p-2">
			<div class="card">
				<div class="card-body">
					<h3 class="count-card-title">{{$tvisitor}}</h3>
					<h4 class="count-card-text">Total Visitor</h4>
				</div>
			</div>
		</div>

		<div class="col-md-3 p-2">
			<div class="card">
				<div class="card-body">
					<h3 class="count-card-title">{{$tservice}}</h3>
					<h4 class="count-card-text">Total Services</h4>
				</div>
			</div>
		</div>

		<div class="col-md-3 p-2">
			<div class="card">
				<div class="card-body">
					<h3 class="count-card-title">{{$tCourse}}</h3>
					<h4 class="count-card-text">Total Courses</h4>
				</div>
			</div>
		</div>

		<div class="col-md-3 p-2">
			<div class="card">
				<div class="card-body">
					<h3 class="count-card-title">{{$tproject}}</h3>
					<h4 class="count-card-text">Total Project</h4>
				</div>
			</div>
		</div>
		<div class="col-md-3 p-2">
			<div class="card">
				<div class="card-body">
					<h3 class="count-card-title">{{$tcontact}}</h3>
					<h4 class="count-card-text">Total Contacts</h4>
				</div>
			</div>
		</div>
		<div class="col-md-3 p-2">
			<div class="card">
				<div class="card-body">
					<h3 class="count-card-title">{{$treview}}</h3>
					<h4 class="count-card-text">Total Reviews</h4>
				</div>
			</div>
		</div>

	</div>
</div>	

@endsection