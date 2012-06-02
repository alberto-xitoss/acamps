<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('css'))
{
	function css($href, $more)
	{
		if (($OBJ =& _get_template_object()) !== FALSE)
		{
			return $OBJ->css($href, $more);
		}
	}
}

if ( ! function_exists('link'))
{
	function link($rel, $href, $more)
	{
		if (($OBJ =& _get_template_object()) !== FALSE)
		{
			return $OBJ->link($rel, $href, $more);
		}
	}
}

if ( ! function_exists('js'))
{
	function js($src)
	{
		if (($OBJ =& _get_template_object()) !== FALSE)
		{
			return $OBJ->js($src);
		}
	}
}

if ( ! function_exists('meta'))
{
	function meta($name, $content, $more)
	{
		if (($OBJ =& _get_template_object()) !== FALSE)
		{
			return $OBJ->meta($name, $content, $more);
		}
	}
}

if ( ! function_exists('css_url'))
{
	function css_url()
	{
		$CI =& get_instance();
		$CI->config->load('template');
		return $CI->config->item('css_url');
	}
}

if ( ! function_exists('js_url'))
{
	function js_url()
	{
		$CI =& get_instance();
		$CI->config->load('template');
		return $CI->config->item('js_url');
	}
}

if ( ! function_exists('img_url'))
{
	function img_url()
	{
		$CI =& get_instance();
		$CI->config->load('template');
		return $CI->config->item('img_url');
	}
}

if ( ! function_exists('_get_template_object'))
{
	function &_get_template_object()
	{
		$CI =& get_instance();

		// We set this as a variable since we're returning by reference.
		$return = FALSE;
		
		if (FALSE !== ($object = $CI->load->is_loaded('template')))
		{
			if ( ! isset($CI->$object) OR ! is_object($CI->$object))
			{
				return $return;
			}
			
			return $CI->$object;
		}
		
		return $return;
	}
}