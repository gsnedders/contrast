var Contrast_Ratio = function()
{
	this.array_values = function(array)
	{
		var t = new Array();
		array.each(function(a) {
			t[t.length] = a;
		})
		return t;
	}
	
	this.calculate = function(foreground, background)
	{
		if (foreground.length == 3 && background.length == 3)
		{
			foreground = this.array_values(foreground);
			background = this.array_values(background);
			var l1 = this.relative_luminance(foreground[0], foreground[1], foreground[2]);
			var l2 = this.relative_luminance(background[0], background[1], background[2]);
			if (l2 > l1)
			{
				l3 = l1;
				l1 = l2;
				l2 = l3;
			}
			return (l1 + 0.05) / (l2 + 0.05);
		}
		else
		{
			window.alert('Contrast_Ratio.calculate() expects parameters to be arrays with three values each');
		}
	}
	
	this.relative_luminance = function(r, g, b)
	{
		r = this.calculate_RGB_for_relative_luminance(r);
		g = this.calculate_RGB_for_relative_luminance(g);
		b = this.calculate_RGB_for_relative_luminance(b);
		return 0.2126 * r + 0.7152 * g + 0.0722 * b;
	}
	
	this.calculate_RGB_for_relative_luminance = function(colour)
	{
		colour = parseFloat(colour);
		
		if (colour <= 0.03928)
		{
			return colour / 12.92;
		}
		elseif (colour <= 1.0)
		{
			return Math.pow((colour + 0.055) / 1.055, 2.4);
		}
		else
		{
			window.alert('RGB value must be between 0 and 1');
		}
	}
}