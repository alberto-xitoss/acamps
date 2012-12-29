<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Template{
	
	private $template;
	private $template_dir;
	private $meta = array();
	private $js = array();
	private $vars = array();
	//private $parts = array(); // TODO
	
	private $CI;
	
	// --------------------------------------------------------------------
	
	public function __construct($config = array())
	{
		$this->CI =& get_instance();
		$this->CI->load->helper('template');
		
		foreach ($config as $key => $val)
		{
			if($key == 'default_template')
			{
				$this->template = $val;
			}
			else
			{
				$this->$key = $val;
			}
		}
	}
	
	// --------------------------------------------------------------------
	
	public function set_template($new_template)
	{
		$this->template = $new_template;
		
		return $this;
	}
	
	// --------------------------------------------------------------------
	
	public function set($name, $value = NULL)
	{
		if(isset($value))
		{
			if(is_array($name) OR is_object($name))
			{
				foreach ($name as $item => $value)
				{
					$this->vars[$item] = $value;
				}
			}
			else
			{
				$this->vars[$name] = $value;
			}
		}

		return $this;
	}
	
	// --------------------------------------------------------------------
	
	public function css($href, $more)
	{
		// Se não for um caminho absoluto, completa a URL com o valor configurado
		if(preg_match('/\w*:?\/\/.*/i', $href) === 0)
		{
			$href = $this->css_url . $href;
		}
		return '<link rel="stylesheet" href="' . $href . '" ' . $more . '>';
	}
	
	public function add_css($href, $more = '')
	{
		$this->meta[] = css($href, $more);
		
		return $this;
	}
	
	// --------------------------------------------------------------------
	
	public function link($rel, $href, $more)
	{
		// Precisa ser um caminha absoluto
		return '<link rel="' . $rel . '" href="' . $href . '" ' . $more . '>';
	}
	
	public function add_link($rel, $href, $more = '')
	{
		$this->meta[] = link($rel, $href, $more);
		
		return $this;
	}
	
	// --------------------------------------------------------------------
	
	public function js($src)
	{
		if(ENVIRONMENT === "production")
		{
			if($src === 'jquery.min.js')
			{
				$src = "http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js";
			}
			if($src === 'jquery-ui.min.js')
			{
				$src = "http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js";
			}
			if($src === 'jquery.ui.datepicker-pt-BR.js')
			{
				$src = "http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/i18n/jquery.ui.datepicker-pt-BR.js";
			}
		}
		
		// Se não for um caminho absoluto, completa a URL com o valor configurado
		if(preg_match('/\w*:?\/\/.*/i', $src) === 0)
		{
			$src = $this->js_url . $src;
		}
		return '<script src="' . $src . '"></script>';
	}
	
	public function add_js($src)
	{
		$this->js[] = js($src);
		
		return $this;
	}
	
	// --------------------------------------------------------------------
	
	public function meta($name, $content, $more)
	{
		return '<meta name="' . $name . '" content="' . $content . '" ' . $more . '>';
	}
	
	public function add_meta($name, $content, $more = '')
	{
		$this->meta[] = meta($name, $content, $more);
		
		return $this;
	}
	
	// --------------------------------------------------------------------
	
	public function load_view($view, $data = array())
	{
		// Carrega a view escolhida e substitui as primeiras variáveis
		$loaded_view = $this->CI->load->view($view, $data, TRUE);
		
		// Criando variáveis do template
		$template['meta'] = implode("\n", $this->meta);
		$template['js'] = implode("\n", $this->js);
		foreach ($this->vars as $key => $value) {
			$template[$key] = $value;
		}
		$template['content'] = $loaded_view;
		
		// Substitui as variáveis do template
		$page_data['template'] =& $template;
		
		$this->CI->load->view($this->template_dir . $this->template, $page_data);
		
		// Manda a página completa pro navegador
		//$this->CI->output->set_output($page);
	}
	
}
