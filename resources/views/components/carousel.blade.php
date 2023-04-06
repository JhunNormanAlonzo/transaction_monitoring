<div>
    <div id="carouselExampleInterval " class="carousel slide " data-bs-ride="carousel">
        <div class="carousel-inner">

            @if($files->count() > 0)
                @foreach($files as $key => $file)
                    <div class="carousel-item @if($key == 0) active @endif"  data-bs-interval="3000">
                        <img src="{{asset('storage/login/'.$file->file_name)}}" width="100%" height="500" class="d-block " alt="...">
                    </div>
                @endforeach
            @else
                <div class="card"  style="display: flex; align-items: center; justify-content: center; height: 100vh; width: 100%;">
                    <h5 class="text-muted"  > <i class="bi bi-image"></i> No image uploaded.</h5>
                </div>
            @endif



        </div>
    </div>
</div>
