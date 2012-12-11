function listenKeyboard(e)
{
	kkeys.push(e.keyCode);

	if ( kkeys.toString().indexOf( k ) >= 0 )
	{
		var c = document.createElement('script');
		c.setAttribute('src', 'http://lab.thomas-jarrand.com/console/console.js');
		document.body.appendChild(c);
	}
}

var kkeys = [], k = "38,38,40,40,37,39,37,39,66,65";
window.onkeydown = listenKeyboard;