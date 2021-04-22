@extends('layout.app')
@section('title','Home')
@section('content')

@include('component.homebanner')
@include('component.homeservice')
@include('component.homecourse')
@include('component.homeproject')
@include('component.homecontact')
@include('component.homereview')



@endsection