<html>
<head>
<title>Paathshaala2</title>

<style>
 html,body{font:normal 0.9em arial,helvetica;}
 #log {width:230px; height:200px; border:1px solid #7F9DB9; overflow:auto;}
 #msg {width:330px;}
</style>

<script>
var socket;

function init(){
  var host = "ws://localhost:1234/websocket/server.php";
  try{
    socket = new WebSocket(host);
    log('WebSocket - status '+socket.readyState);
    socket.onopen    = function(msg){ log("Welcome - status "+this.readyState); };
    socket.onmessage = function(msg){ log(msg.data);};
    socket.onclose   = function(msg){ log("Disconnected - status "+this.readyState); };
  }
  catch(ex){ log(ex); }
  $("msg").focus();
}

function send(){
  var txt,msg;
  txt = $("msg");
  msg = txt.value;
  if(!msg){ alert("Message can not be empty"); return; }
  txt.value="";
  txt.focus();
  msg = $("username").value + " : "+ msg ;
  try{ socket.send(msg); log(msg); } catch(ex){ log(ex); }
}
function quit(){
  log("Goodbye!");
  socket.close();
  socket=null;
}

// Utilities
function $(id){ return document.getElementById(id); }
function log(msg){ $("log").innerHTML+="<br>"+msg; }
function onkey(event){ if(event.keyCode==13){ send(); } }
</script>

</head>
<body onload="init()">
 <h3>Paathshaala Question Box</h3>
 <input id=username type="text" value="Student's User Name"></input>
 <div id="log"></div>
 <input id="msg" type="textbox" onkeypress="onkey(event)"></input>
 <button onclick="send()">Send</button>
 <button onclick="quit()">Quit</button>
 
</body>
</html>
