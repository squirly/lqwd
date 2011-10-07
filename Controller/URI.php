<?php
namespace lqwd\Controller;

class URI implements IURI
{
	private $filename;
	private $extra = array();
	private $extension;
	private $query;

	public static function parse($string) {
    $uri = new URI;
    $start = $uri->strtochar(\trim($string, '/'), "?");
    $query = \explode('&', \substr($string, \strlen($start)));
		$values = \explode( '/',  $start);
		list($uri->filename, $uri->extension) = array_merge(\explode('.', array_pop($values)), array(null));
		$uri->extra = array_filter($values);
    return $uri;
	}

	public static function create($page, array $query = array(), $mode = 'php') {
    $uri = new self();
		$uri->filename = $page;
		$uri->query = $query;
		$uri->setExtension($mode);
    return $uri;
	}

	/**
 *
 * @param string $str
 * @param char $char
 * @param int $start
 * @return string
 */
	private function strtochar($str, $char, $start=0) {
		$pos = strpos($str,$char,$start);
		return $pos==""?
			\substr($str, $start):
			\substr($str, $start, $pos-$start);
	}

  public function copy() {
    
  }

	public function build() {
		$page = \implode('/', $this->extra).'/'.$this->filename;
    $extension = '.'.$this->extension;
    $query = '?'.http_build_query($this->query);
    return $page.
      (empty($this->extension)?'':$extension).
      (empty($this->query)?'':$query);
	}
  
	public function getPage() {
		return $this->filename;
	}
	public function getExtension() {
		return $this->extension;
	}
	public function getExtra() {
		return $this->extra;
	}

	public function setPage($value) {
		$this->filename = $value;
    return $this;
	}
	public function setExtension($value) {
		$this->extension = ($value == 'php' ? '' : $value);
    return $this;
	}
	public function setExtra($value) {
		$this->extra = $value;
    return $this;
	}
  public function setQueries($value) {
    $this->query = $value;
    return $this;
  }
}