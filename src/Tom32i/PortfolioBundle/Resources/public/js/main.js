/* INIT */

(function() {
    var lastTime = 0;
    var vendors = ['ms', 'moz', 'webkit', 'o'];
    for(var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
        window.requestAnimationFrame = window[vendors[x]+'RequestAnimationFrame'];
        window.cancelAnimationFrame = 
          window[vendors[x]+'CancelAnimationFrame'] || window[vendors[x]+'CancelRequestAnimationFrame'];
    }
 
    if (!window.requestAnimationFrame)
        window.requestAnimationFrame = function(callback, element) {
            var currTime = new Date().getTime();
            var timeToCall = Math.max(0, 16 - (currTime - lastTime));
            var id = window.setTimeout(function() { callback(currTime + timeToCall); }, timeToCall);
            lastTime = currTime + timeToCall;
            return id;
        };
 
    if (!window.cancelAnimationFrame)
        window.cancelAnimationFrame = function(id) {
            clearTimeout(id);
        };
}());

function initPage()
{
	animFrame = { 
		slider0: {index: 0, loop: loopSlider0, motion: false}, 
		slider1: {index: 1, loop: loopSlider1, motion: false},
	};

	framerate = 0.06;
	kkeys = [], k = "38,38,40,40,37,39,37,39,66,65";
	main = document.getElementById("main");
	prefix = detectPrefix(main);
	dpr = detectDpr();
	sliders = [new Slider('languages', 0), new Slider('projects', 1)];
	ie = hasClass(document.getElementsByTagName('html')[0], 'lt-ie9');
	iPad = navigator.userAgent.match(/iPad/i) != null;

	if(ie)
	{
	    if (!('indexOf' in Array.prototype)) {
	        Array.prototype.indexOf= function(find, i /*opt*/) {
	            if (i===undefined) i= 0;
	            if (i<0) i+= this.length;
	            if (i<0) i= 0;
	            for (var n= this.length; i<n; i++)
	                if (i in this && this[i]===find)
	                    return i;
	            return -1;
	        };
	    }
	}

	window.onkeydown = listenKeyboard;

	resizeHandler();
}

function loopSlider0()
{
    animFrame.slider0.index = window.requestAnimationFrame(loopSlider0);
    sliders[0].update();
}

function loopSlider1()
{
    animFrame.slider1.index = window.requestAnimationFrame(loopSlider1);
    sliders[1].update();
}

/* HANDLERS */

function resizeHandler()
{
	windowWidth = window.innerWidth;

    for (var i = sliders.length - 1; i >= 0; i--) 
    {
        sliders[i].resizeHandler();
    }
}

/* METHODS */

function detectPrefix(element)
{
        if(ie) return false;

        var properties = [ 'Webkit', 'MS', 'Moz', 'O', 'webkit', 'ms', 'moz', 'o', 'Ms' ];
        var p = '';
        while (p = properties.shift()) {
            if (typeof(element.style[p+'Transform']) != 'undefined') {
                return p;
                }
        }

        return false;
}

function detectDpr()
{
    if(window.devicePixelRatio !== undefined) return window.devicePixelRatio;
   	return 1;
}

function addClass(obj, classname)
{
    if(!hasClass(obj, classname))
    {
        obj.className +=  " " + classname;
    }
}

function hasClass(obj, classname)
{
    var reg = new RegExp("(^" + classname + "$)|( +" + classname + "$)|(^" + classname + " +)|( +" + classname + " +)");
    return obj.className.search(reg) >= 0;
}

function removeClass(obj, classname)
{
    var reg = new RegExp("(^" + classname + "$)|( +" + classname + "$)|(^" + classname + " +)|( +" + classname + " +)");
    obj.className = obj.className.replace(reg, '');
}

function addEvent(obj, e, fn)
{
    if(window.addEventListener)
    {
        obj.addEventListener(e, fn, false);
    }
    else if(window.attachEvent)
    {
        obj.attachEvent(e, fn, false);
    }
}

function toArray(obj)
{
    var array = new Array();

    if(obj.length)
    {
        for (var i = 0; i < obj.length; i++) 
        {
            array[i] = obj[i];
        }
    }

    return array;
}

function hide(obj)
{
    //obj.setAttribute('data-display', obj.style.display);
    obj.style.display = "none";
    obj.style.visibility = "hidden";
}

function show(obj)
{
    if(typeof(obj) != 'undefined')
    {
        //var display = obj.getAttribute('data-display') ? obj.getAttribute('data-display') : "block";
        obj.offsetHeight;
        obj.style.display = "block";
        obj.style.visibility = "visible";
    }
}

function setMotion(on, anim)
{
    if(on)
    {
        if(!animFrame[anim].motion) 
        {
            animFrame[anim].motion = true;
            animFrame[anim].index = window.requestAnimationFrame(animFrame[anim].loop);
        }
    }
    else
    {
        if(animFrame[anim].motion)
        {
            animFrame[anim].motion = false;
            window.cancelAnimationFrame(animFrame[anim].index);
        } 
    }
}

function logEvent(event) 
{
        console.log(event.type);
}

function listenKeyboard(e)
{
	kkeys.push(e.keyCode);

	if (kkeys.toString().indexOf( k ) >= 0 )
	{
        window.onkeydown = null;

		var c = document.createElement('script');
		c.setAttribute('src', 'http://lab.thomas-jarrand.com/console/console.js');
		document.body.appendChild(c);

        console.log("added");
	}
}

/* VARS */
var windowWidth, animFrame, framerate, kkeys,  main, prefix, dpr, sliders, ie, iPad;

/*
var tefairefoutre = "Masaya";
var icelle = "Merci j'ai déjà donnée"

if(icelle!="Merci j'ai déjà donnée")
{
	icelle=true;
}
else
{
	icelle++;
}
*/