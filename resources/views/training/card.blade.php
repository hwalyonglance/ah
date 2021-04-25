@foreach($trainings as $training)
    <div class='col-3'>
        <div class="card">
            <img class="card-img-top" src="{{ url('storage/'.$training->gambar) }}"
                alt="Card image cap" style="max-height: 250px; max-width: 100%;">
            <div class="card-body">
                <h5 class="card-title">{{ $training->judul }}</h5>
                <p class="card-text">{{ $training->keterangan }}</p>
                <a href="#" class="btn btn-primary">Ambil</a>
            </div>
        </div>
    </div>
@endforeach
