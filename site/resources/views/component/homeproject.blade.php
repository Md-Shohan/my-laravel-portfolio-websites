
    <div class="container section-marginTop text-center">
        <h1 class="section-title">Project</h1>
        <h1 class="section-subtitle">It Course, We are proveid best It Courses </h1>
        <div class="row">

            <div id="one"  class="owl-carousel mb-4 owl-theme">
            @foreach($projectData as $projectData )
                <div class="item m-1 card">
                    <div class="text-center">
                        <img class="w-100" src="{{$projectData->project_img}}" alt="Card image cap">
                        <h5 class="service-card-title mt-4">{{$projectData->project_name}}</h5>
                        <h6 class="service-card-subTitle p-0 m-0"> {{$projectData->project_des}} </h6>
                        <a href="{{$projectData->project_link}}" target="_blank" class="normal-btn-outline mt-2 mb-4 btn">বিস্তারিত</a>
                    </div>
                </div>
               @endforeach

        </div>
        <div class="d-inline m-auto">
            <i id="customPrevBtn" class="btn normal-btn"><</i>
            <i id="customNextBtn" class="btn normal-btn">></i>
            <button class="normal-btn  btn">সব গুলো </button>
        </div>
    </div>
