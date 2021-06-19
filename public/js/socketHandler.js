let chat = document.getElementById('chat');
let input = document.getElementById('messageInput');
const nome = document.getElementById('nome');
const graphicUserInfo = document.getElementById('onlineUsers');
var h1 = document.createElement('a');
var request = window.indexedDB.open("demonetDB", 3);
var timerid;
import { messageNotification } from './notificationHandler.js'
var endpoint = "ws://127.0.0.1:9990/"

function webSocketConnect(){
    const socket = new WebSocket(endpoint);
    function sendData(data){
        if(socket.readyState === 1){
            console.log(JSON.stringify(data));
            socket.send(JSON.stringify(data));
            messageInput.value = '';
        }
    }
    socket.addEventListener('open', function (event) {
        	console.log("Connected to WebSocket successfully");
    });

    socket.addEventListener('close', function(event){
    	h1.innerHTML = "Offline";
    	console.log("WebSocket closed");
    	graphicUserInfo.appendChild(h1);
        webSocketConnect();
    });

    socket.addEventListener('error', function(event){
        clearInterval(timerid);
        h1.innerHTML = "Offline";
        console.log("WebSocket error");
        graphicUserInfo.appendChild(h1);
    });

    socket.addEventListener('message', function (event) {
        const data = JSON.parse(event.data);
        console.log(event.data);
        if(data != null){
            if(data.header != 1){
                h1.innerHTML = data.onlineUsers;
                graphicUserInfo.appendChild(h1);
            }
        }
        if(data.header == 1){
            chat.insertAdjacentHTML('beforeend', "<p><b>" + data.name + " : </b>" + data.message + "</p>");
            messageNotification(data.name, data.message);
            var b = chat;
            // Additional padding/border to account for in calculations
            var offset = b.scrollHeight - b.offsetHeight;
            // Amount we have scrolled down
            var scrollPos = b.scrollTop + offset;
            // Amount of scroll available, minus the visible portion (because scrollPos
            // is the *top* of the visible portion)
            var scrollBottom = (b.scrollHeight - (b.clientHeight + offset));
            // If we are at the bottom, go to the bottom again.
            if (scrollPos >= scrollBottom) {
              window.scrollTo(0, document.body.scrollHeight);
            }
        }
    });


    $('#messageSend-btn').click(function(){
        const data = {
            name: nome.value,
            message: messageInput.value,
        };
        $(this).toggleClass('active');
        sendData(data);
        $(this).toggleClass('inactive');
    });


    input.addEventListener('keyup', function (event) {
        const data = {
            name: nome.value,
            message: messageInput.value,
        };
        if (event.keyCode === 13) {
            sendData(data);
	   }
    });
}
webSocketConnect();
