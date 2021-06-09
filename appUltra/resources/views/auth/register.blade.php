@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'registro', 'title' => __('Ultra Canalero / Registro')])

@section('content')
<div class="container">
  <div class="row align-items-center">
    <div class="col-lg-6 col-md-6 col-sm-8 ml-auto mr-auto">
      <form class="form" method="POST" action="{{ route('registro.store') }}" enctype="multipart/form-data">
        @csrf
        {!! RecaptchaV3::field('contacto') !!}
        <div class="card card-login card-hidden mb-3">
          <div class="card-header card-header-green text-center">
            <h4 class="card-title"><strong>{{ __('Unete al proyecto') }}</strong></h4>
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
            <p class="card-description text-center">{{ __('Registrate y forma parte de la familia ultra canalera') }}</p>

            <!--CAPTURADOR DE ERRORES-->
            <div class="bmd-form-group">
              @include('layouts.error')
            </div>

            <!--NOMBRES-->
            <div class="form-group bmd-form-group{{ $errors->has('names') ? ' has-danger' : '' }}">
              <label class="label-control" for="names">Ingresar los nombres</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="fa fa-male"></i>
                  </span>
                </div>
                <input type="text" name="names" class="form-control" placeholder="{{ __('Nombres') }}" value="{{ old('names') }}" required>
              </div>
              @if ($errors->has('names'))
                <div id="names-error" class="error text-danger pl-3" for="names" style="display: block;">
                  <strong>{{ $errors->first('names') }}</strong>
                </div>
              @endif
            </div>
            <!--APELLIDOS-->
            <div class="form-group bmd-form-group{{ $errors->has('surnames') ? ' has-danger' : '' }} mt-3">
              <label class="label-control" for="surnames">Ingresar los apellidos</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                      <i class="fa fa-male"></i>
                  </span>
                </div>
                <input type="text" name="surnames" class="form-control" placeholder="{{ __('Apellidos') }}" value="{{ old('surnames') }}" required>
              </div>
              @if ($errors->has('surnames'))
                <div id="surnames-error" class="error text-danger pl-3" for="surnames" style="display: block;">
                  <strong>{{ $errors->first('surnames') }}</strong>
                </div>
              @endif
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
            <!--TELEFONO-->
            <div class="form-group bmd-form-group{{ $errors->has('phone') ? ' has-danger' : '' }} mt-3">
              <label class="label-control" for="phone">Ingresar el número de teléfono</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="fa fa-phone"></i>
                  </span>
                </div>
                <input type="tel" name="phone" class="form-control" placeholder="{{ __('Número de teléfono') }}" value="{{ old('phone') }}" pattern="[0-9]{8}" required>
              </div>
              @if ($errors->has('phone'))
                <div id="phone-error" class="error text-danger pl-3" for="phone" style="display: block;">
                  <strong>{{ $errors->first('phone') }}</strong>
                </div>
              @endif
            </div>
            <!--WHATSAPP-->
            <div class="form-group bmd-form-group{{ $errors->has('whatsapp') ? ' has-danger' : '' }} mt-3">
              <label class="label-control" for="whatsapp">Ingresar el número de whatsapp</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text icon">
                    <i class="fa fa-whatsapp"></i>
                  </span>
                </div>
                <input type="tel" name="whatsapp" class="form-control" placeholder="{{ __('Número de whatsapp') }}" value="{{ old('whatsapp') }}" pattern="[0-9]{8}">
              </div>
              @if ($errors->has('whatsapp'))
                <div id="whatsapp-error" class="error text-danger pl-3" for="whatsapp" style="display: block;">
                  <strong>{{ $errors->first('whatsapp') }}</strong>
                </div>
              @endif
            </div>
            <!--TELEGRAM-->
            <div class="form-group bmd-form-group{{ $errors->has('telegram') ? ' has-danger' : '' }} mt-3">
              <label class="label-control" for="telegram">Ingresar el número de telegram</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text icon">
                    <i class="fa fa-telegram"></i>
                  </span>
                </div>
                <input type="tel" name="telegram" class="form-control" placeholder="{{ __('Número de telegram') }}" value="{{ old('telegram') }}" pattern="[0-9]{8}">
              </div>
              @if ($errors->has('telegram'))
                <div id="telegram-error" class="error text-danger pl-3" for="telegram" style="display: block;">
                  <strong>{{ $errors->first('telegram') }}</strong>
                </div>
              @endif
            </div>
            <!--NACIMIENTO-->
            <div class="form-group bmd-form-group{{ $errors->has('birthday') ? ' has-danger' : '' }} mt-3">
              <label class="label-control" for="birthday">Ingresar la fecha de nacimiento</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text icon">
                    <i class="fa fa-calendar"></i>
                  </span>
                </div>
                <input type="date" name="birthday" class="form-control date" placeholder="{{ __('Fecha de nacimiento') }}" value="{{ old('birthday') }}" data-date-format="DD/MM/YYYY" required/>
              </div>
              @if ($errors->has('birthday'))
                <div id="birthday-error" class="error text-danger pl-3" for="birthday" style="display: block;">
                  <strong>{{ $errors->first('birthday') }}</strong>
                </div>
              @endif
            </div>
            <!--MAS INFORMACION-->
            <div class="form-check mr-auto ml-3 mt-3">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox" id="information" name="information" {{ old('information', 0) ? 'checked' : '' }} >
                <span class="form-check-sign">
                  <span class="check"></span>
                </span>
                {{ __('Deseo recibir más información respecto a la ') }} <a class="text-success" href="#"><b>{{ __('Membresía') }}</b></a>
              </label>
            </div>
            <!--COMISIONES-->
            <div id="accordion" role="tablist">
              <div class="card card-collapse">
                @foreach ($comissions as $item)
                  <div class="card-header card-header-blue" role="tab" id="{{ "headin$item->id" }}">
                    <div class="card-title">
                      <a class="collapsed" data-toggle="collapse" href="{{ "#".$item->id }}" aria-expanded="false" aria-controls="{{ $item->id }}">
                        <b>{{ $item->name }}</b>
                        <i class="material-icons text-left">keyboard_arrow_down</i>
                      </a>
                    </div>
                  </div>
                  <div id="{{ $item->id }}" class="collapse" role="tabpanel" aria-labelledby="{{ "headin$item->id" }}" data-parent="#accordion">
                    <div class="card-body">
                      {{ $item->description }}
                      <br><br>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>            
            <hr>
            <p class="card-description text-center">{{ __('Si es tu deseo apoyar en las distintas actividades del proyecto, te invitamos a que selecciones en que comisiones desearías apoyar.') }}</p>
            <div class="form-group bmd-form-group{{ $errors->has('commissions') ? ' has-danger' : '' }} mt-3">
              <label class="label-control" for="commissions">Seleccionar 2 comisiones como máximo</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text icon">
                    <i class="fa fa-users"></i>
                  </span>
                </div>
                <select class="form-control selectpicker" name="commissions[]" data-header="Seleccionar comisión" title="Comisiones" data-live-search="true" multiple data-max-options="2" data-style="btn-success">
                  @foreach ($comissions as $item)
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
@endsection
@push('js')
  {!! RecaptchaV3::initJs() !!}
@endpush
