
@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'lista-registro', 'title' => __('Ultra Canalero / Comisiones')])
@section('style')
    <link href="{{ asset('material') }}/css/material-card-new.css" rel="stylesheet" />
    {!! RecaptchaV3::initJs() !!}
@endsection
@section('content')
<div class="container">
  <div class="row align-items-center">
    <div class="col-lg-6 col-md-6 col-sm-8 ml-auto mr-auto">
      <form class="form" method="POST" action="{{ route('registro.update') }}" enctype="multipart/form-data" autocomplete="false">
        @csrf
        {!! RecaptchaV3::field('contacto') !!}
        <div class="card card-login card-hidden mb-3">
          <div class="card-header card-header-green text-center">
            <h4 class="card-title"><strong>{{ __('Asignarte comisiones') }}</strong></h4>
            <div class="social-line">
              <a href="https://www.facebook.com/Ultra-Canaleros-Chiquimulilla-1941669916118053/" class="btn btn-just-icon btn-link btn-white" target="__blank">
                <i class="fa fa-facebook-square"></i>
              </a>
              <a href="mailto:ultra.canalero@gmail.com" class="btn btn-just-icon btn-link btn-white" target="__blank">
                <i class="fa fa-envelope-square"></i>
              </a>
              <a href="tel:+50257101225" class="btn btn-just-icon btn-link btn-white" target="__blank">
                <i class="fa fa-phone-square"></i>
              </a>
            </div>
          </div>
          <div class="card-body ">
            <p class="card-description text-center">{!! __('Si ya te encuentras registrado y no estas asignado a una comisión te invitamos a que lo hagas, apoyanos para lograr el sueño de ver al <b>CSD CHIQUIMULILLA</b> en lo más alto.') !!}</p>
            <hr>
            <!--CAPTURADOR DE ERRORES-->
            <div class="bmd-form-group">
              @include('layouts.error')
            </div>

            <!--EMAIL-->
            <div class="form-group bmd-form-group{{ $errors->has('email') ? ' has-danger' : '' }} mt-3">
              <label class="label-control" for="email">Ingresar el correo electrónico</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fa fa-envelope"></i>
                  </span>
                </div>
                <input type="email" name="email" class="form-control" placeholder="{{ __('Correo electrónico') }}" value="{{ old('email') }}" required>
              </div>
              @if ($errors->has('email'))
                <div id="email-error" class="error text-danger pl-3" for="email" style="display: block;">
                  <strong>{{ $errors->first('email') }}</strong>
                </div>
              @endif
            </div>
            <!--COMISIONES-->
            <div class="form-group bmd-form-group{{ $errors->has('commissions') ? ' has-danger' : '' }} mt-3">
              <label class="label-control" for="commissions">Seleccionar 2 comisiones como máximo</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text icon">
                    <i class="fa fa-users"></i>
                  </span>
                </div>
                <select class="form-control selectpicker" name="commissions[]" data-header="Seleccionar comisión" title="Comisiones" data-live-search="true" multiple data-max-options="2" data-style="btn-success">
                  @foreach ($commissions as $item)
                    <option value="{{ $item->id }}" {{ (collect(old('commissions'))->contains($item->id)) ? 'selected':'' }}>{{ $item->name }}</option>
                  @endforeach
                </select>
              </div>
              @if ($errors->has('commissions'))
                <div id="commissions-error" class="error text-danger pl-3" for="commissions" style="display: block;">
                  <strong>{{ $errors->first('commissions') }}</strong>
                </div>
              @endif
            </div>
          </div>
          <div class="card-footer justify-content-center">
            <button type="submit" class="btn btn-green btn-block btn-lg">{{ __('Guardar') }}</button>
          </div>
        </div>
      </form>
    </div>
  </div>  
</div>
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
