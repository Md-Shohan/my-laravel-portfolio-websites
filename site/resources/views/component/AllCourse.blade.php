<div class="container mt-5">
    <div class="row">
    @foreach($courseData as $course)
        <div class="col-md-4 p-1 text-center">
            <div class="card">
                <div class="text-center">
                    <img class="w-100" src="{{$course->course_img}}" alt="Card image cap">
                    <h5 class="service-card-title mt-4">{{$course->course_name}}</h5>
                    <h6 class="service-card-subTitle p-0 "> {{$course->course_des}} </h6>
                    <h6 class="service-card-subTitle p-0 "> {{$course->	course_fee}} {{$course->course_totalclass}}</h6>
                    <a href="{{$course->course_link}}" class="normal-btn-outline mt-2 mb-4 btn">Click here</a>
                </div>
            </div>
        </div>
    @endforeach
    </div>
</div>
