{{-- {{ dd(json_decode($trainingsTaken)) }} --}}

<h4>Belum Diambil</h4>
<hr>
<div class='row'>
    @foreach($exams as $exam)
        <div class='col-3'>
            <div class="card">
                <img class="card-img-top" src="{{ url('storage/'.$exam->image_url) }}"
                    alt="Card image cap" style="max-height: 250px; max-width: 100%;">
                <div class="card-body">
                    <h5 class="card-title">{{ $exam->title }}</h5>
                    <br><hr>
                    <p class="card-text">{{ $exam->description }}</p>
                    {!! Form::open(['url' => url('exam/'.$exam->id.'/take'), 'method' => 'post']) !!}
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <input type="hidden" name="training_id" value="{{ $exam->id }}">
                        {!! Form::button('<i class="fa fa-arrow-circle-right"></i> &nbsp;Ambil', ['type' => 'submit', 'class' => 'btn btn-primary', 'onclick' => "return confirm('Ambil exam ini?')"]) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    @endforeach
</div>

{{-- <br>
<h4>Sudah Diambil</h4>
<hr>
<div class='row'>
    @forelse($trainingsTaken as $item)
        <div class='col-3'>
            <div class="card">
                <img class="card-img-top" src="{{ url('storage/'.$item->exam->image_url) }}"
                    alt="Card image cap" style="max-height: 250px; max-width: 100%;">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->exam->title }}</h5>
                    <p class="card-text">{{ $item->exam->description }}</p>
                    <a class="btn btn-link" href='{{ url('exam/'.$item->exam->id) }}'>Lihat</a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center">
            <p>Anda belum mengambil exam</p>
        </div>
    @endforelse
</div> --}}
