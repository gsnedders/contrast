<?php

class Contrast_Ratio
{
	private function __construct()
	{
	}
	
	public static function calculate($foreground, $background)
	{
		if (count($foreground) == 3 && count($background) == 3)
		{
			$foreground = array_values($foreground);
			$background = array_values($background);
			$l1 = self::relative_luminance($foreground[0], $foreground[1], $foreground[2]);
			$l2 = self::relative_luminance($background[0], $background[1], $background[2]);
			if ($l2 > $l1)
			{
				$l3 = $l1;
				$l1 = $l2;
				$l2 = $l3;
			}
			return ($l1 + 0.05) / ($l2 + 0.05);
		}
		else
		{
			throw new Exception('Contrast_Ratio::calculate() expects parameters to be arrays with three values each');
		}
	}
	
	private static function relative_luminance($r, $g, $b)
	{
		$r = self::calculate_RGB_for_relative_luminance($r);
		$g = self::calculate_RGB_for_relative_luminance($g);
		$b = self::calculate_RGB_for_relative_luminance($b);
		return 0.2126 * $r + 0.7152 * $g + 0.0722 * $b;
	}
	
	private static function calculate_RGB_for_relative_luminance($colour)
	{
		if (is_int($colour))
		{
			$colour /= 255;
		}
		else
		{
			$colour = (float) $colour;
		}
		
		if ($colour <= 0.03928)
		{
			return $colour / 12.92;
		}
		elseif ($colour <= 1.0)
		{
			return pow(($colour + 0.055) / 1.055, 2.4);
		}
		else
		{
			throw new Exception('RGB value must be between 0 and 1');
		}
	}
}