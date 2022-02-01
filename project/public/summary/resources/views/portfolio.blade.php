@extends('layout.layout')

@section('pagetitle')Portfolio Page
@endsection
@section('code')
<script>
function operator(op) {
	document.getElementById("taskform").action='./'+op;
    document.getElementById("taskform").submit(); 
}
</script>
@if($errors->any())
<div class="alert alert-danger">
<ul>
@foreach($errors->all() as $error)
<li> {{$error}}</li>
@endforeach
</ul>
</div> 
@endif
<h4 style="text-align:left; color:#f50ea0">Add new task item, however registered first</h4><hr>
<form action="#" id="taskform" method="POST">
@csrf
<label for="descr">Input describe of task item:</label><br>
<input type="text" id="descr" name="descr" required minlength="10" autofocus><br>
<label for="pict">Upload:</label><br>
<input type="file" id="pict" name="pict" accept="image/png, image/jpeg" required >
<input type="hidden" id="param" name="param" ><br><br><br>
@if(Session::has('is_auth'))
<button type="button" id="sm" onclick="operator('add')">ADD</button>
@else
<button type="button" id="sm" onclick="operator('add')" disabled >ADD</button>	
@endif
</form>
<hr>
<main>
@if(Session::has('portfolio'))
<script>
operator('select');
</script>
@endif
@if(Session::has('datas'))
{{Session::forget('portfolio')}}
<div id="entity" class="container px-4 py-5">
<div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
@foreach(Session::get('datas') as $data)
    <div class="feature col">
	<div class="feature-icon bg-primary bg-gradient">
    <svg class="bi" width="1em" height="1em">
	 <defs>
    <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="0%">
      <stop offset="0%" style="stop-color:rgb(255,255,0);stop-opacity:1" />
      <stop offset="100%" style="stop-color:rgb(255,0,0);stop-opacity:1" />
    </linearGradient>
    </defs>
	<rect x="50" y="20" rx="10" ry="10" width="150" height="30" style="fill:url(#grad1)"/>
    </svg>
    </div>
	<div class="card-header py-3">
	<h4 class="my-0 fw-normal">Task item</h4>
	</div>
		<div class="card-body" id="cardbody">
		<h5 id="desc" class="card-title pricing-card-title">'{{$data->descr}}</h5>';
		<script>
		var element = document.getElementById("desc");
		element.id='desc'+'{{$data->id}}';
		</script>
		<div style="max-height: 170px; overflow: hidden;">
		<img id="pic" width="128" align="top" src="{{$data->image}}">';
		<script>
		var element = document.getElementById("pic");
		element.id='pic'+'{{$data->id}}';
		</script>
		</div>
		</div>
		@if(Session::has('is_auth'))
		<div id="card-foot">
		<button type="button" id="bt" class="w-100 btn btn-lg btn-outline-primary" onclick="operator('delete')")>Delete</button>
		<script>
		var element = document.getElementById("bt");
		element.id='bt'+'{{$data->id}}';
		</script>
		</div>
		@endif
	</div>
@endforeach
 </div>
 </div>
{{Session::forget('datas')}}
@endif
</main>
@endsection