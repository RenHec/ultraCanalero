@extends('errors.layout')

@section('content')
<!--dust particel-->
<div>
    <div class="starsec"></div>
    <div class="starthird"></div>
    <div class="starfourth"></div>
    <div class="starfifth"></div>
</div>
<section class="seccion_invitacion">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-text card-header-green">
                        <div class="card-text">
                        <h3 class="card-title"><strong>Hola, </strong>{{ $person }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Ultra canaler@ de corazón, te damos la bienvenida al proyecto y estaríamos encantado que seas el líder de la {{ $commission }}</h4>
                        <br><br>
                        <p class="card-text">
                            <!--EMAIL-->
                            <div class="form-group bmd-form-group mt-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                    </div>
                                    <input type="email" name="email" class="form-control" placeholder="{{ __('Ingresar el correo electrónico registrado en la ultra canalera') }}" />
                                </div>
                            </div> 
                        </p>
                    </div>
                </div>  
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h1>Firmar de aceptación</h1>
            </div>
            <div class="col-md-12">
                <canvas id="draw-canvas" width="520" height="360">
                    No tienes un buen navegador.
                </canvas>
            </div>
            <div class="col-md-6 text-center">
                <button type="button" class="btn btn-green btn-lg btn-block" id="draw-submitBtn">Aceptar</button>
            </div>
            <div class="col-md-6 text-center">
                <button type="button" class="btn btn-danger btn-lg btn-block" id="draw-clearBtn">Borrar firma</button>
            </div>
            <div class="col-md-12">
                {!! RecaptchaV3::field('contacto') !!}
            </div>
        </div>
    </div>
</section>

@endsection

@push('js')
    <script>

        (function() { 
            window.requestAnimFrame = (function (callback) {
                return window.requestAnimationFrame ||
                            window.webkitRequestAnimationFrame ||
                            window.mozRequestAnimationFrame ||
                            window.oRequestAnimationFrame ||
                            window.msRequestAnimaitonFrame ||
                            function (callback) { window.setTimeout(callback, 1000/60); };
            })();

            var canvas = document.getElementById("draw-canvas");
            var ctx = canvas.getContext("2d");

            var clearBtn = document.getElementById("draw-clearBtn");
            var submitBtn = document.getElementById("draw-submitBtn");

            var drawing = false;
            var mousePos = { x:0, y:0 };
            var lastPos = mousePos;
            var tint = "#000000";
            var punta = 4;

            clearBtn.addEventListener("click", function (e) {
                clearCanvas();
            }, false);

            var url = window.location.href.split('invitacion')[0];

            submitBtn.addEventListener("click", function (e) {
                var dataUrl = canvas.toDataURL();
                
                if("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAggAAAFoCAYAAAAy4AOkAAAC7UlEQVR4nO3BAQ0AAADCoPdPbQ43oAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAgFcDbw0AAYyg4HsAAAAASUVORK5CYII=" === dataUrl) {
                    Swal.fire(
                        '¡Firma no detectada!',
                        'la firma no es válida.',
                        'info'
                    )                    
                    return;
                }

                Swal.fire({
                        title: '¿Aceptar ser líder?',
                        text: "Está seguro que desea aceptar ser líder de la {{ $commission }}",
                        icon: 'success',
                        showCancelButton: true,
                        confirmButtonColor: '#306f1a',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'SI',
                        cancelButtonText: 'NO',
                        allowOutsideClick: false
                    }).then((result) => {
                    if (result.isConfirmed) {
                        var token = '{{csrf_token()}}';
                        let datos = new Object;
                        datos.firm = dataUrl;
                        datos.recaptcha = $('textarea[name=g-recaptcha-response]').val();
                        datos._token = token;
                        datos.clave = "{{ $token }}";
                        datos.email = $('input[name=email]').val();
                        $.ajax({
                            url: "{{ route('invitacion.store_accept') }}",
                            type: 'POST',
                            data: datos,
                            dataType: 'json',
                            success: function (r) {
                                console.log('sadas')
                            },
                            error: function (r) {
                                if(r.status === 500) {
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'error',
                                        title: 'Error',
                                        text: r.responseJSON.data,
                                        showConfirmButton: false,
                                        timer: 1500,
                                        allowOutsideClick: false
                                    })                                     
                                } else {   
                                    var errores = '<lu>'
                                    Object.values(r.responseJSON.errors).forEach(element => {
                                        errores += `<li>${element}</li>`
                                    });
                                    errores += '</lu>'
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        html: errores,
                                        allowOutsideClick: false
                                    })                                
                                }
                            }
                        })
                    }
                })
            }, false);

            canvas.addEventListener("mousedown", function (e) {
                drawing = true;
                lastPos = getMousePos(canvas, e);
            }, false);

            canvas.addEventListener("mouseup", function (e) {
                drawing = false;
            }, false);

            canvas.addEventListener("mousemove", function (e) {
                mousePos = getMousePos(canvas, e);
            }, false);
            
            canvas.addEventListener("touchstart", function (e) {
                mousePos = getTouchPos(canvas, e);
                e.preventDefault(); 
                var touch = e.touches[0];
                var mouseEvent = new MouseEvent("mousedown", {
                    clientX: touch.clientX,
                    clientY: touch.clientY
                });
                canvas.dispatchEvent(mouseEvent);
            }, false);

            canvas.addEventListener("touchend", function (e) {
                e.preventDefault(); 
                var mouseEvent = new MouseEvent("mouseup", {});
                canvas.dispatchEvent(mouseEvent);
            }, false);

            canvas.addEventListener("touchleave", function (e) {
                e.preventDefault();
                var mouseEvent = new MouseEvent("mouseup", {});
                canvas.dispatchEvent(mouseEvent);
            }, false);

            canvas.addEventListener("touchmove", function (e) {
                e.preventDefault(); 
                var touch = e.touches[0];
                var mouseEvent = new MouseEvent("mousemove", {
                    clientX: touch.clientX,
                    clientY: touch.clientY
                });
                canvas.dispatchEvent(mouseEvent);
            }, false);
            
            function getMousePos(canvasDom, mouseEvent) {
                var rect = canvasDom.getBoundingClientRect();
                return {
                    x: mouseEvent.clientX - rect.left,
                    y: mouseEvent.clientY - rect.top
                };
            }

            function getTouchPos(canvasDom, touchEvent) {
                var rect = canvasDom.getBoundingClientRect();
                return {
                    x: touchEvent.touches[0].clientX - rect.left,
                    y: touchEvent.touches[0].clientY - rect.top
                };
            }
            
            function renderCanvas() {
                if (drawing) {
                    ctx.strokeStyle = tint;
                    ctx.beginPath();
                    ctx.moveTo(lastPos.x, lastPos.y);
                    ctx.lineTo(mousePos.x, mousePos.y);
                    ctx.lineWidth = punta;
                    ctx.stroke();
                    ctx.closePath();
                    lastPos = mousePos;
                }
            }

            function clearCanvas() {
                canvas.width = canvas.width;
            }

            (function drawLoop () {
                requestAnimFrame(drawLoop);
                renderCanvas();
            })();
        })();
    </script>
@endpush
