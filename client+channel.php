<html>
<head>
<title>Paathshaala</title>

<style>
 html,body{font:normal 0.9em arial,helvetica;}
 #log {width:330px; height:300px; border:1px solid #7F9DB9; overflow:auto;}
 #msg {width:330px;}
</style>

<script>
var socket;

function init(){
  //var host = "ws://localhost:12345/websocket/server2.php";
  var host = "ws://localhost:8000/test";
  try{
    socket = new WebSocket(host);
    log('WebSocket - status '+socket.readyState);
    socket.onopen    = function(msg){ log("Welcome - status "+this.readyState); };
    socket.onmessage = function(msg){ 
	msg_new = eval('(' + msg.data + ')');   
	if(msg_new.channel_id == "vinni_client1"){
	
		log("Received: "+msg_new.str);
	}//if, message belongs to right channel	
    };//on message
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

	var Newmsg = '{"channel_id" : "vinni_client1", "str":"' + msg + '"}';

  try{ socket.send(Newmsg); log('Sent: '+msg); } catch(ex){ log(ex); }
}
//function quit(){
//  log("Goodbye!");
 // socket.close();
 // socket=null;
//}

// Utilities
function $(id){ return document.getElementById(id); }
function log(msg){ $("log").innerHTML+="<br>"+msg; }
function onkey(event){ if(event.keyCode==13){ send(); } }
</script>

</head>
<body onload="init()">
 <h3>Teacher's Writing Pad (Only for Admin)</h3>
 <div id="log"></div>
 <input id="msg" type="textbox" onkeypress="onkey(event)"/>
 <button onclick="send()">Send</button>

 
</body>
</html>


