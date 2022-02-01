<?php

namespace App\Http\Controllers;

use App\Http\Requests\summaryRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;

class summaryController extends Controller {
  public function login (summaryRequest $req) {
  $dat=DB::table('auth_users')->where('login',$_POST['login'])->value('password');
  if ($dat==$_POST['password']&&$dat) {
    $req->session()->put('is_auth', 'true');
	$req->session()->forget('is_out');
	}	  
  else
	$req->session()->put('is_err', 'true');
  $dat=$_POST['login'];
  return redirect()->back()->with('login',$dat);
}
  public function logout (summaryRequest $req) {
  $req->session()->forget('is_auth');
  $req->session()->put('is_out', 'true');
  return redirect()->back();
}
public function addrec (summaryRequest $req) {
  DB::insert('insert into porfolio (descr,image) values(?,LOAD_FILE(?))',[$_POST['descr'], $_POST['pict']]);
  $req->session()->put('portfolio','true');
  return redirect()->back();
}
public function deleterec (summaryRequest $req) {
  DB::table('porfolio')->where('id', $_POST['param'])->delete();
  $req->session()->put('portfolio','true');
  return redirect()->back();
}
public function selectrec (summaryRequest $req) {
  ini_set('memory_limit','528M');
  $dat=DB::select('select * from portfolio'); 	
  if($dat) {
	foreach($dat as $d)
	$d->image='data:image/jpg;base64,'.base64_encode($d->image);
  }  
  $req->session()->put('datas',$dat);
  return redirect()->back();
}

}
