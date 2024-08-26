var timeoutPeriod = 100 * 60 * 1000; // change the 5 dependes on you
/*
5 = 5mins
4 = 4mins
3 = 3mins
2 = 2mins
1 = 1min
0.5 = 50secs
0.4 = 40secs
0.3 = 30secs
0.2 = 20secs
0.1 = 10secs
*/

var timeoutHandle;

function resetTimeout() {
  clearTimeout(timeoutHandle);
  timeoutHandle = setTimeout(onTimeout, timeoutPeriod);
}

function onTimeout() {
  window.location.href = "php/logout.php";
}

document.onload = resetTimeout;
document.onmousemove = resetTimeout;
document.onkeypress = resetTimeout;

window.onload = resetTimeout;
