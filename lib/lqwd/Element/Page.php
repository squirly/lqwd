<?php
namespace lqwd\Element;

use lqwd\Render\Renderable;
use lqwd\Element\Head\Metadata;

/**
 * Description of Class
 * 
 * add ability to remove dojo or a class that you pass that enables dojo or jscript, etc.
 *
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
class Page extends \lqwd\Render\RenderGroup {
  /**
   * @var Element
   */
  private $head;
  /**
   * @var Element
   */
  private $body;
  /**
   * @var Text
   */
  private $title;

  /**
   *
   * @return Page
   */
  public static function create() {
    return new self;
  }

  public function __construct() {
    $this->head = Head::create();
    $this->title = Text::create('');
    $this->body = Body::create();
    parent::add(Head\Doctype::createHTML5());
    parent::add(Html::create('html', false)
      ->addInner($this->head
       ->addInner(Metadata::createCharacterSet("UTF-8"))
        ->addInner(Head\Title::create()
          ->setInner($this->title)))
      ->addInner($this->body));
    $this->addJavascript('dojo', "http://ajax.googleapis.com/ajax/libs/dojo/1.7.1/dojo/dojo.js", true)
    ->addJavascript('pageLoader', '/javascript/lqwd.js', true);
  }
  
  public function getBody() {
    return $this->body;
  }

  public function getTitle() {
    return $this->title->getText();
  }
  public function setTitle($text) {
    $this->title->setText($text);
    return $this;
  }

  public function addCSS($name, $value, $path = false) {
    if ($path) $this->addLink($name, 'stylesheet', 'text/css', $value);
    else /** @todo Implement inline css */;
    return $this;
  }
  public function removeCSS($name) {
    $this->removeHead($name);
    return $this;
  }

  public function addLink($name, $relationship, $type, $path) {
    $this->addHead(Head\Link::create($relationship, $type, $path, $name));
    return $this;
  }
  public function removeLink($name) {
    $this->removeHead($name);
    return $this;
  }

  public function addJavascript($name, $value, $path = true) {
    $this->head->addInner($path
      ?$js = Head\Script::createWithUri($name, 'text/javascript', $value)
      :$js = Head\Script::createWithText ($name, 'text/javascript', $value)
    );
    return $this;
  }
  public function removeScript($name) {
    return $this;
  }

  public function addHead(Renderable $renderable) {
    $this->head->addInner($renderable);
    return $this;
  }
  public function removeHead($renderable) {
    $this->head->removeInner($renderable);
    return $this;
  }

  public function add(Renderable $renderable) {
    $this->body->addInner($renderable);
    return $this;
  }
  public function remove($renderable) {
    $this->body->removeInner($renderable);
    return $this;
  }
}