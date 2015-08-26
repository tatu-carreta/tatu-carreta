@if (Session::has('mensaje'))
    <script src="{{URL::to('js/divAlertaFuncs.js')}}"></script>
    <div class="divAlerta alert alert-warning @if(Session::has('ok')) ok @endif @if(Session::has('error')) error @endif">{{ Session::get('mensaje') }}<button type="button" class="close" data-dismiss="alert">&times;</button></div>
@endif