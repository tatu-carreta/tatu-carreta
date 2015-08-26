<!-- abre S L I D E estático -->
<div class="slideHome">
    
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
       <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
          <li data-target="#myCarousel" data-slide-to="3"></li>
        </ol>

        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="images/slide1.jpg" alt="slider1">
            </div>

            <div class="item">
                <img src="images/slide2.jpg" alt="slider2">
            </div>
        
            <div class="item">
                <img src="images/slide3.jpg" alt="slider3">
            </div>

            <div class="item">
                <img src="images/slide4.jpg" alt="slider1">
            </div>
             <div class="item">
                <img src="images/slide5.jpg" alt="slider1">
            </div>
        </div>

        <!--
        
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Siguiente</span>
        </a>
        -->
    </div>

</div><!-- cierra S L I D E estático --> 

<!--C A R O U S E L de colores-->
<div class="fondo-negro">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="contenedor-carousel">
                    <div class="carousel-home">
                        <div id="owl-demo2">
                            <?php $i = 0; ?>
                            @foreach($menu_dinamico as $menu)
                                @if(count($menu->children) > 0)
                                    @foreach($menu->children as $ch)
                                        <div class="item">
                                            <a class="@if(in_array($i, [0, 5, 10, 15])) boton-naranja @elseif(in_array($i, [1, 6, 11, 16])) boton-rojo @elseif(in_array($i, [2, 7, 12, 17])) boton-violeta @elseif(in_array($i, [3, 8, 13, 18])) boton-azul @elseif(in_array($i, [4, 9, 14, 19])) boton-verde @endif" href="{{URL::to($ch->url)}}">
                                                <span>{{ $ch->nombre }}</span>
                                            </a>
                                        </div>
                                        <?php $i++; ?>
                                    @endforeach
                                @endif
                            @endforeach
                            <!--
                                <div class="item"><a class="" href="#">muebles<br>operativos</a></div>
                                <div class="item"><a class="" href="#">mesas <br> de reunión</a></div>
                                <div class="item"><a class="" href="#">mesas <br>bajas</a></div>
                                <div class="item"><a class="" href="#">muebles <br> de guardado</a></div>
                                <div class="item"><a class="boton-naranja" href="#">asientos<br>gerenciales</a></div>
                                <div class="item"><a class="boton-rojo" href="#">asientos<br>operativos</a></div>
                                <div class="item"><a class="boton-violeta" href="#">sillas <br>de visita</a></div>
                                <div class="item"><a class="boton-azul" href="#">sillones <br>de visita</a></div>
                                <div class="item"><a class="boton-verde" href="#">cortinas<br> a medida</a></div>
                                <div class="item"><a class="boton-naranja" href="#">accesorios <br>y complementos</a></div>
                                <div class="item"><a class="boton-rojo" href="#">deco <br>casa</a></div>
                            -->
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>