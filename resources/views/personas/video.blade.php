@extends('layouts.personas')

@section('content')
<style>
.stepContainer{
    height: 490px !important;
}
</style>
<div class="x_panel">
    @if (Session::get('message'))
        <div class="alert alert-success">
            {{Session::get('message')}}
            <br><br>			
        </div>
    @endif

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Hubo Algunos problemas con tu entrada.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="x_title">
        <h2>Video Curriculo</h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div class="" role="tabpanel" data-example-id="togglable-tabs">
            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Ver</a>
                </li>
                <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Cargar</a>
                </li>
            </ul>

            <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                    @if(isset($curriculo->video))
                        <p align="center"><video src="{{$curriculo->video}}" width="50%" id="recorded" controls></video></p>
                    @else
                        <div class="alert alert-danger">
                            No se encuentra videos cargados, por favor haga click en la pestaña cargar y realice el proceso
                        </div>
                    @endif
                </div>

                <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                    <p>Siga los pasos para grabar y subir su video resumen</p>
                    <div id="wizard" class="form_wizard wizard_horizontal">
                        <ul class="wizard_steps">
                            <li>
                                <a href="#step-1">
                                    <span class="step_no">1</span>
                                    <span class="step_descr">
                                    Paso 1<br />
                                    <small>Grabar el Video</small>
                                    </span>
                                </a>
                            </li>

                            <li>
                                <a href="#step-2">
                                    <span class="step_no">2</span>
                                    <span class="step_descr">
                                        Paso 2<br />
                                        <small>Visualice y Descargue su Video</small>
                                    </span>
                                </a>
                            </li>

                            <li>
                                <a href="#step-3">
                                    <span class="step_no">3</span>
                                    <span class="step_descr">
                                        paso 3<br />
                                        <small>Suba su Video</small>
                                    </span>
                                </a>
                            </li>
                        </ul>
                        
                        <div id="step-1">
                            <h2 class="StepTitle">Grabar el Video</h2>
                            
                            <p>
                                Haga click en el boton <strong>grabar</strong> para hacer su video curriculo, para terminar haga click en <stong>Parar de grabar</stong>
                                y luego haga click en el boton siguiente
                            </p>
                            
                            <p align="center"><video width="45%" id="gum" autoplay muted></video></p>
                            <br/>
                            <a class="btn btn-primary" id="record" >Grabar</a>
                                                            

                        </div>
                        <div  id="step-2">
                            <h2 class="StepTitle">Step 2 Content</h2>
                            
                            <p>
                                Haga click en el boton <strong>Play</strong> para visualizar su video, si ha quedado a gusto con el haga click
                                en el boton <strong>Descargar</strong> 
                            </p>
                            <p align="center">
                            <video width="50%" id="recorded" autoplay loop></video>
                            <br/>
                            <a   class="btn btn-success" id="play" >Play</a>
                            <a  class="btn btn-warning" id="download" >Descargar</a>
                            </p>
                        </div>
                        <div id="step-3">
                            <h2 class="StepTitle">Subir el video</h2>

                            <p>
                                Seleccióne el vide de que desea cargar, recuerde que debe ser en formato <strong>webm</strong> y no debe exceder las <strong>12Mb</strong>
                            </p>

                            <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="/personas/curriculo/video">
                                {{ csrf_field() }}
                                <input type="file" id="videoinput" name="video" >
                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-3">
                                        <button type="submit" class="btn btn-primary">
                                            Guardar
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                    <!-- End SmartWizard Content -->
                  </div>

            </div>
        </div>
                
    </div>
</div>

@endsection
