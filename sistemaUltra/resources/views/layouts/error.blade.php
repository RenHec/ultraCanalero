@if (count($errors) > 0)
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <div class="description">
            <h4 class="info-title text-white">Error</h4>
            <p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li><b>{{ $error }}</b></li>
                    @endforeach
                </ul>               
            </p>
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@elseif(Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <div class="description">
            <h4 class="info-title text-white">Éxito</h4>
            <p>{!! Session::get('success') !!}</p>
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@elseif(Session::has('warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <div class="description">
            <h4 class="info-title text-white">Advertencia</h4>
            <p>{!! Session::get('warning') !!}</p>
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@elseif(Session::has('danger'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <div class="description">
            <h4 class="info-title text-white">Error</h4>
            <p>{!! Session::get('danger') !!}</p>
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@elseif(Session::has('info'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <div class="description">
            <h4 class="info-title text-white">Información</h4>
            <p>{!! Session::get('info') !!}</p>
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif   