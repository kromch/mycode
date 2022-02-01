<!DOCTYPE html>
<html>
<head>
<title>@yield('pagetitle')</title>
<meta name="viewport" content="initial-scale=1">
<meta name="keywords" content="Summary project">
<meta name="description" content="Summary project">
<style>
h1 {text-align:center;font-family:Arial, sans-serif;letter-spacing:5px;color:#ffaa40;background-color:#805580;}
h4 {text-align:center;}
p {font-family:Georgia, serif;font-size:24px;font-style:normal;font-weight:normal;color:#0f0a0b;background-color:#f0fff0;}
.modal {
  display: none; 
  position: fixed; 
  z-index: 1; 
  padding-top: 100px; 
  left: 0;
  top: 0;
  width: 60%; 
  height: 80%; 
  overflow: auto; 
  background-color: rgb(0,245,255); 
  background-color: rgba(0,0,0,0.4);
}
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}
.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<script type="text/javascript"> 
function clk(op,rep) {
	let modal = document.getElementById("myModal");
	modal.style.display = "none";
	if(op=="login"&&rep)  {
      modal.style.display = "block";
	  return;
	}
	document.getElementById("logform").action='./'+op;
    document.getElementById("logform").submit(); 
}
</script>
</head>
<body>
@if(Session::has('is_load'))
@include('layout/header')
@endif
@yield('code')

<div id="myModal" class="modal">
<div class="modal-content">
  <span class="close">&times;</span><br>
    <h3>User Login Authentification</h3><hr>
        <form action="/" id="logform" method="POST">
	    @csrf
        <label for="login">Input user Login:</label><br>
        <input type="text" id="login" name="login" required minlength="4" autofocus><br>
        <label for="password">Input user Password:</label><br>
        <input type="password" id="password" name="password" required minlength="4"><br><br>
        <button type="button" onclick="clk('login',false)">OK</button>
    </form>
</div>
</div>
@if(Session::has('is_auth'))
<script>
 var login='{!!Session::get('login')!!}';
 if(login)
 {{Session::reflash(Session::get('login'))}}
 document.getElementById("user").innerHTML="User <em>"+login+"</em> successful logined";
 document.getElementById("lin").disabled = true;
 document.getElementById("lot").disabled = false;
</script>
@endif

@if(Session::has('is_out'))
<script>	
 document.getElementById("lin").disabled = false;
 document.getElementById("lot").disabled = true;
 document.getElementById("user").innerHTML="Any user not logged";
 {{Session::forget('is_out')}}
 </script>
@endif

@if(Session::has('is_err'))
<script>
alert("Invalid Login or Password");
</script>
{{Session::forget('is_err')}}
@endif
<script>
var modal = document.getElementById("myModal");
var span = document.getElementsByClassName("close")[0];

span.onclick = function() {
  modal.style.display = "none";
}
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
</body>
</html>