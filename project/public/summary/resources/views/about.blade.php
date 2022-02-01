@extends('layout.layout')

@section('pagetitle')About Page
@endsection


@section('code')
<p>I'm <em style="color:#ff0ffa;text-align:center;">Roman Korkonishko</em>.<br>
I'm 40 years old men.<br> I Study PHP language and wanna be the Front-End developer.<br>
My native mother language is  
<svg width="250" height="200">
<defs>
  <filter id="filter" x="0" y="0">
     <feOffset dx="0" dy="57" />
  </filter>
</defs>
  <rect width="250" height="100"  fill="yellow"/>
  <rect width="250" height="100"  fill="blue" filter="url(#filter)"/>
  <text x="5" y="30" fill="red">UKRAINE</text>
</svg> </p>
@endsection