{{-- {{ dd(json_decode($trainingsTaken)) }} --}}

<h4>Belum Diambil</h4>
<hr>
<div class='row'>
    @foreach($trainings as $training)
        <div class='col-3'>
            <div class="card">
                <img class="card-img-top" src="{{ url('storage/'.$training->gambar) }}"
                    alt="Card image cap" style="max-height: 250px; max-width: 100%;">
                <div class="card-body">
                    <h5 class="card-title">{{ $training->judul }}</h5>
                    <p class="card-text">{{ $training->keterangan }}</p>
                        {!! Form::open(['url' => url('training/'.$training->id.'/take'), 'method' => 'post']) !!}
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <input type="hidden" name="training_id" value="{{ $training->id }}">
                            {!! Form::button('<i class="fa fa-arrow-circle-right"></i> &nbsp;Ambil', ['type' => 'submit', 'class' => 'btn btn-primary', 'onclick' => "return confirm('Ambil training ini?')"]) !!}
                        {!! Form::close() !!}
                </div>
            </div>
        </div>
    @endforeach
</div>

<br>
<h4>Sudah Diambil</h4>
<hr>
<div class='row'>
    @foreach($trainingsTaken as $item)
        <div class='col-3'>
            <div class="card">
                <img class="card-img-top" src="{{ url('storage/'.$item->training->gambar) }}"
                    alt="Card image cap" style="max-height: 250px; max-width: 100%;">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->training->judul }}</h5>
                    <p class="card-text">{{ $item->training->keterangan }}</p>
                        <a class="btn btn-link" href='{{ url('training/'.$item->training->id) }}'>Lihat</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
