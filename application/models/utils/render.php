<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Render extends CI_Model
{
	/**
	 * 
	 * 渲染器
	 * 
	 * 提供页面最终渲染的拼接操作
	 * 
	 * @author Johnny EVEN
	 * @version Pulse utils/render.php - 1.0.1.20130123 17:32
	 */
	public function __construct()
	{
		parent::__construct();
	}
	
	public function render($pageName = null, $data = null)
	{
		$header = $this->load->view('std_header', $data, true);
		$nav = $this->load->view('std_nav', $data, true);
		$sidebar = $this->load->view('std_sidebar', $data, true);
		$content = $this->load->view("{$pageName}", $data, true);
		$footer = $this->load->view('std_footer', $data, true);
		
		$value = array(
			'std_header'	=>	$header,
			'std_nav'		=>	$nav,
			'std_sidebar'	=>	$sidebar,
			'std_content'		=>	$content,
			'std_footer'	=>	$footer
		);
		$this->load->view('std_frame', $value);
	}
}
?>