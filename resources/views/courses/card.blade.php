<h4>Belum Diambil</h4>
<hr>
<div class="row">
    @foreach($coursesGroupByCategory as $category)
        <div class="col-12">
            <h5 style="border-bottom: 2px solid #DDD">{{ $category->name }}</h5>
        </div>
        @foreach($category->courses as $course)
            <div class='col-3'>
                <div class="card">
                    <img class="card-img-top" src="{{ url('storage/'.$course->gambar) }}"
                        alt="Card image cap" style="max-height: 250px; max-width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $course->title }}</h5>
                        <br><hr>
                        <p class="card-text">{{ $course->description }}</p>
                        {!! Form::open(['url' => url('course/'.$course->id.'/take'), 'method' => 'post']) !!}
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                            {!! Form::button('<i class="fa fa-arrow-circle-right"></i> &nbsp;Ambil', [
                                    'type' => 'submit',
                                    'class' => 'btn btn-primary',
                                    'onclick' => "return confirm('Ambil Course ini?')"
                            ]) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach
</div>

<br>
<h4>Sudah Diambil</h4>
<hr>
<div class='row'>
    @forelse($coursesTaken as $item)
        <div class='col-3'>
            <div class="card">
                <img class="card-img-top" src="{{ url('storage/'.$item->course->gambar) }}"
                    alt="Card image cap" style="max-height: 250px; max-width: 100%;">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->course->title }}</h5>
                    <p class="card-text">{{ $item->course->description }}</p>
                    <a class="btn btn-link" href='{{ url('course/'.$item->course->id) }}'>Lihat</a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center">
            <p>Anda belum mengambil course</p>
        </div>
    @endforelse
</div>
