@extends('layout.app')
@section('title','Contact')
@section('content')
<div class="container-fluid jumbotron mt-5 ">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6  text-center">
                <img class=" page-top-img fadeIn" src="images/knowledge.svg">
                <h1 class="page-top-title mt-3">- Contact With us -</h1>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3681.0249116366717!2d90.62900751427598!3d22.690116534366634!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3754d5b7df85cc11%3A0x74a192552be08406!2sPolice%20Line%20Mosque!5e0!3m2!1sen!2sbd!4v1618989223174!5m2!1sen!2sbd" width="500" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <div class="col-md-6">
        <h5 class="service-card-title text-center mb-4">Contact With Us </h5>
                <div class="form-group ">
                    <input id="contactNameId" type="text" class="form-control w-100" placeholder="Your Name">
                </div>
                <div class="form-group">
                    <input id="contactMobileId" type="number" class="form-control  w-100" placeholder="Mobile No">
                </div>
                <div class="form-group">
                    <input id="contactEmailId" type="email" class="form-control  w-100" placeholder="Email">
                </div>
                <div class="form-group">
                    <input id="contactMsgId" type="text" class="form-control  w-100" placeholder="Massages">
                </div>
                <button id="contactSendBtnId"  class="btn btn-block normal-btn w-100">Submit</button>
        </div>
    </div>
</div>


@endsection