function Slider(id, index)
{
	var slider = this;

	this.animIndex = index;
	this.domElement = document.getElementById(id);
	this.slider = document.getElementById('slider-' + id);
	this.total = this.slider.children.length;
	this.touched = false;
	this.moved = false;
	this.horizontal = true;
	this.dragX = 0;
	this.dragY = 0;
	this.currentX = 0;
	this.newX = 0;
	this.sliderWidth = 0;
	this.pas = 0;
	this.toRight;

	this.pasFastLimit = 1;
	this.minX = -100 * (this.total - 1);
	this.maxX = 0;
    this.mode3d;

	addEvent(this.domElement, 'touchstart', function(e){ slider.touchStart(e); });
    addEvent(this.domElement, 'touchend', function(e){ slider.touchEnd(e); });
    addEvent(this.domElement, 'touchmove', function(e){ slider.touchMove(e); });

    this.touchStart = function(e)
    {
    	console.log("touch length: %i", e.targetTouches.length);

    	if(e.targetTouches.length == 1)
    	{
	        this.touched = true;
			this.horizontal = true;
	        this.dragX = parseInt( e.targetTouches[0].screenX ); 
	        this.dragY = parseInt( e.targetTouches[0].screenY ); 
    	}
    }
    
    this.touchEnd = function(e)
    {
        this.touched = false;
        this.moved = false;

        console.log("Horizontal: %s", this.horizontal);

        if(this.horizontal)
        {
	        for (var i = this.total - 1; i >= 0; i--) 
	        {
	        	var max = i * -100;
	        	var min = (i+1) * -100;

	        	if( this.currentX > min && this.currentX < max )
	        	{
	        		var diffToMax = Math.abs(max - this.currentX);
	        		var diffToMin = Math.abs(min - this.currentX);

	        		console.log("%i >= %i", this.pas, this.pasFastLimit);

	        		if(Math.abs(this.pas) >= Math.abs(this.pasFastLimit))
	        		{
	        			this.newX = this.toRight ? min : max;
	        		}
	        		else
	        		{
	        			this.newX = diffToMax > diffToMin ? min : max;
	        		}
	        	}
	        }

	        if(this.newX != this.currentX)
	        {
	        	setMotion(true, 'slider' + this.animIndex);
	        }
        }
    }

    this.touchMove = function(e)
    {
    	if(this.horizontal == false)
    	{
    		return true;
    	}

        var dragX = parseInt(e.targetTouches[0].screenX); 
        var diff = (parseInt(dragX - this.dragX) / windowWidth) * 100;

    	if(this.moved == false)
    	{
	        var dragY = parseInt(e.targetTouches[0].screenY); 
	        var diffY = (parseInt(dragY - this.dragY) / windowWidth) * 100;

	        console.log("%s <> %s", diffY, diff);

	        if(Math.abs(diffY) > Math.abs(diff))
	        {
	        	this.horizontal = false;

	        	return this.touchEnd();
	        }
    	} 

    	e.preventDefault();

    	this.toRight = diff < 0;

        var newX = this.currentX + diff;

        this.moved = true;
        this.pas = Math.abs(diff);

        if(newX < this.minX){ newX = this.minX; }
        if(newX > this.maxX){ newX = this.maxX; }

        //this.mode3d = true;
        this.currentX = newX;
        this.newX = newX;
        this.dragX = dragX; 

        this.render();
    }

    this.render = function() 
    {
    	this.slider.style.marginLeft = this.currentX + "%";
        /*var is3d = iPad ? this.mode3d : true;

        if(prefix)
        {
            this.domElement.style[prefix+'Transform']= "translate" + (is3d ? '3d' : '') + "("+this.currentX+"px, "+this.currentY+"px" + (is3d ? ',0' : '') + ")";
        }
        else if(ie == false)
        {
            this.domElement.style.transform= "translate" + (is3d ? '3d' : '') + "("+this.currentX+"px, "+this.currentY+"px" + (is3d ? ',0' : '') + ")";
        }
        else
        {
            this.domElement.style.left= this.currentX + "px";
            this.domElement.style.top= this.currentY + "px";
        }*/
    }

    this.update = function()
    {
        if(this.currentX != this.newX)
        {
            this.currentX = this.currentX + this.getPas();
            this.render();
        }
        else
        {
        	this.pas = 0;
            setMotion(false, 'slider' + this.animIndex);
        }
    }

    this.getPas = function()
    {
		var sign = (this.currentX > this.newX) ? -1 : 1;
		var diff = Math.abs(this.currentX - this.newX);

		if(this.pas <= this.pasFastLimit)
		{
			this.pas = diff / (10);
		}

		return (diff > this.pas) ? (sign * this.pas) : sign * diff;
    }
}