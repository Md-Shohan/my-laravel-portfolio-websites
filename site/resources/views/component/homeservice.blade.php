
<div class="container section-marginTop text-center">
    <h1 class="section-title">OUR SERVICE </h1>
    <h1 class="section-subtitle">Small Business Make a Big Impression</h1> </h1>
    <div class="row">

    @foreach($servceData as $servceData)
        <div class="col-md-3 p-2 ">
            <div class="card service-card text-center w-100">
                <div class="card-body">
                    <img class="service-card-logo " src="{{$servceData->service_img}}" alt="Card image cap">
                    <h5 class="service-card-title mt-3">{{$servceData->service_name}}</h5>
                    <h6 class="service-card-subTitle p-0 m-0">{{$servceData->service_des}}</h6>
                </div>
            </div>
        </div>
    @endforeach
    </div>
</div>