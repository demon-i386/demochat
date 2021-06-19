
export function messageNotification(from, message){
	if(from != null && message != null){
		console.log(`showing notification for ${from} with content ${message}`)
    	const notification = new Notification(from,{body:message})
    }
}

console.log(Notification.permission);
if (Notification.permission === "granted") {
    messageNotification();
}
else if (Notification.permission !== "denied") {
    Notification.requestPermission().then(permission => {
        console.log(permission);
    });
}