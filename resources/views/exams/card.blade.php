@foreach($exams as $exam)
    <div class='col-3'>
        <div class="card">
            <img class="card-img-top" src="{{ url('storage/'.$exam->image_url) }}"
                alt="Card image cap" style="max-height: 250px; max-width: 100%;">
            <div class="card-body">
                <h5 class="card-title">{{ $exam->title }}</h5>
                <p class="card-text">{{ $exam->description }}</p>
                <a href="#" class="btn btn-primary">Ambil</a>
            </div>
        </div>
    </div>
@endforeach
