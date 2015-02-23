<!Doctype html>
<html lang="es">
    <head>
        @section('head')
        <meta charset="UTF-8">
        <title>TATU</title>

        <!-- abre LINK -->

        <link href="favicon.ico" rel="shortcut icon">
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,700' rel='stylesheet' type='text/css'>
        <meta name="description" content="">
        <meta name="Keywords" content="">
        <meta property="og:image" content="" />
        <meta name="viewport" content="width = device-width, initial-scale=1, maximum-scale=1">
        
        <link rel="stylesheet" type="text/css" href="{{URL::to('css/tatu-styles-admin.css')}}"> 
        <link rel="stylesheet" type="text/css" href="{{URL::to('css/tatu-styles.css')}}"> 
        <link rel="stylesheet" type="text/css" href="{{URL::to('css/jquery-ui.css')}}">
        <link rel="stylesheet" href="{{URL::to('font-awesome-4.2.0/css/font-awesome.css')}}">
        <link href="{{URL::to('css/jquery.Jcrop.css')}}" rel="stylesheet" />
        <link href="{{URL::to('css/datepicker3.css')}}" rel="stylesheet" />
        
        <!-- abre SCRIPT -->
        <script src="{{URL::to('js/jquery-1.11.0.min.js')}}"></script>
        <script src="{{URL::to('js/jquery-ui.min.js')}}"></script>
        <script src="{{URL::to('js/funcs.js')}}"></script>
        @show
    </head>
    <body>
        @section('header')
            @include('analyticstracking')
            <!-- abre H E A D E R -->
            @if(Auth::check())
            <div class="headerAdmin">
                @if((Auth::user()->hasRole('Superadmin')) || (Auth::user()->hasRole('Administrador')))
                <div class="divAdministrar">
                    <a href="{{URL::to('admin/exportar-clientes')}}" class="btnCalado"><i class="fa fa-pencil fa-lg"></i>Exportar Clientes</a>
                    @if(Auth::user()->can("ver_menu_admin"))
                        <a href="{{URL::to('admin/menu')}}" class="btnCalado"><i class="fa fa-pencil fa-lg"></i>Menú</a>
                    @endif
                    @if(Auth::user()->can("ver_item_admin"))
                        <a href="{{URL::to('admin/item')}}" class="btnCalado"><i class="fa fa-pencil fa-lg"></i>Items</a>
                    @endif
                    @if(Auth::user()->can("ver_seccion_admin"))
                        <a href="{{URL::to('admin/seccion')}}" class="btnCalado"><i class="fa fa-pencil fa-lg"></i>Secciones</a>
                    @endif
                </div>
                @endif

                @if(true)
                <div class="divSalir">
                    <span class="nameAdmin"><i class="fa fa-user fa-lg marginRight5"></i>{{Auth::user()->perfil()->name}}</span>
                    <a href="{{URL::to('logout')}}" class="btnCalado"><i class="fa fa-share  fa-lg"></i>Salir</a>
                </div>
                @else
                <div class="divSalir">
                    <a href="{{URL::to('login')}}" class="btnCalado"><i class="fa fa-share  fa-lg"></i>Ingresar</a>
                </div>
                @endif
            </div>
            @endif
            <!-- H E A D E R -->
            <header class="container">
                <a href="{{URL::to('')}}"><img style="height: 80px;width: 100px;" src="{{URL::to('images/tatu.jpg')}}" alt="Tatú Carreta"></a>
                <h1 style="float: right;">Tatú Carreta</h1>
                <div class="clear"></div>
            </header>

            <!-- abre nuevo slide -->

            <!-- S L I D E -->
            @include($project_name.'-slide-home')

            <!-- N A V -->
            <nav>
                <div class="menu">
                    @include('menu.'.$project_name.'-desplegar-menu')
                </div>
                <div class="clear"></div>
            </nav>
            
        @show
        <!-- abre S E C T I O N -->

        @yield('contenido')

        @section('footer')
        <!-- abre F O O T E R -->
        <footer>
        
        </footer>
        
        <script src="{{URL::to('ckeditor/ckeditor.js')}}"></script>
        <script src="{{URL::to('ckeditor/adapters/jquery.js')}}"></script>
        <script src="{{URL::to('js/jquery.previewInputFileImage.js')}}"></script>
        <script src="{{URL::to('js/jquery.lazyload.js')}}"></script>
        <script src="{{URL::to('js/jquery-ui.min.js')}}"></script>
        <script src="{{URL::to('js/jquery.Jcrop.min.js')}}"></script>
        <script src="{{URL::to('js/datepicker.js')}}"></script>
        <script src="{{URL::to('js/datepicker.es.js')}}"></script>

        <script>
            $(function () {
                $("img.lazy").lazyload({
                    effect: "fadeIn"
                });
            });
        </script>

        <!-- Div alerta  -->
        @include($project_name.'-div-alerta')
        
        @show
    </body>
</html>