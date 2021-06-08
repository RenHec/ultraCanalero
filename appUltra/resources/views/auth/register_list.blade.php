
@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'lista-registro', 'title' => __('Ultra Canalero / Comisiones')])
@section('style')
    <link href="{{ asset('material') }}/css/material-card.css" rel="stylesheet" />
@endsection
@section('content')
<div class="container">
  <div class="row align-items-center">
    @foreach ($commissions as $key => $commission)
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="card">
                <div class="box">
                    <div class="content">
                        <h2>{{ $key+1 }}</h2>
                        <h3>{{ $commission->name }}</h3>
                        <hr>
                        <p>
                            @foreach ($persons as $person)
                                @if ($person->commission_id == $commission->id)
                                {{ $person->person->getFullNameAttribute() }} <br>
                                @endif
                            @endforeach
                        </p>
                    </div>
                </div>
            </div>
        </div>        
    @endforeach
  </div>
</div>
@endsection
