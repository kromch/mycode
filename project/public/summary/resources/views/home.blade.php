@extends('layout.layout')

@section('pagetitle')Home Page
@endsection
@section('code')
@if($errors->any())
<div class="alert alert-danger">
<ul>
@foreach($errors->all() as $error)
<li> {{$error}}</li>
@endforeach
</ul>
</div> 
@endif
<h1 id="myHeader">Main Page</h1><br>
<img src="./gifts.jpg" alt="Beautiful picture" referrerpolicy="origin" width="1250" >
@endsection