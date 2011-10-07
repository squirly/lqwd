<?php
namespace lqwd;

/**
 * A complex class and namespace autoloader.
 *
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
class ClassLoader {
	/**
	 * DEFAULTS
	 */
	const DEFAULT_PATH = '';
	const DEFAULT_SEPERATOR = '\\';
	const DEFAULT_EXTENSION = 'php';

	/**
	 * SETTINGS
	 */
	const PATH = 'path';
	const SEPERATOR = 'seperator';
	const EXTENSION = 'extension';

	/**
	 * The keys of the array are the namespaces and the values are the
	 * corresponding parameters, the keys are the settings constants.
	 * @var array
	 */
	private $namespaces;
	/**
	 * The keys of the array are classes and the values are the corresponding
	 * paths to the classes.
	 * @var array
	 */
	private $classes;

	/**
	 * This initializes the class loader. It must be registered before it is effective.
	 * @param array $namespaces The key is the namespace and
	 *  the value is an array of parameters defined in the A_ constants.
	 * @param array $classes The key is the class name and the value is the file.
	 */
	public function __construct(array $namespaces = array(), array $classes = array()) {
		$this->namespaces = $namespaces;
		$this->classes = $classes;
		$this->loadClass('HTMLPurifier');
	}

	/**
	 * Add a class that can be autoloaded when first used.
	 * @param string $className The name of the class
	 * @param <type> $path The path to the file that contains the class
	 * @return ClassLoader Fluent
	 */
	public function addClass($className, $path) {
		$this->classes[$className] = $path;
		return $this;
	}

	/**
	 * Remove a class from the autoloader.
	 * @param string $className The class to unload
	 * @return ClassLoader Fluent
	 */
	public function removeClass($className) {
		unset($this->classes[$className]);
		return $this;
	}

	/**
	 * Add a namespace to the autoloader.
	 * @param string $namespace The namespace to add.
	 * @param string $path The path to the base of the namespace structure.
	 * @param string $namespaceSeperator The class path seperator.
	 * @param string $phpExtension The extention that the files have without the dot.
	 * @return ClassLoader Fluent
	 */
	public function addNamespace(
		$namespace,
		$path = null,
		$namespaceSeperator = self::DEFAULT_SEPERATOR,
		$phpExtension = self::DEFAULT_EXTENSION)
	{
		$this->namespaces[$namespace] = array(
			self::PATH => $path,
			self::SEPERATOR => $namespaceSeperator,
			self::EXTENSION => $phpExtension
		);
		return $this;
	}

	/**
	 * Remove a namespace from the autoloader.
	 * @param string $namespace The namespace to remove.
	 * @return ClassLoader Fluent
	 */
	public function removeNamespace($namespace) {
		unset($this->namespaces[$namespace]);
		return $this;
	}

	/**
	 * Register this class loader.
	 * @return ClassLoader Fluent
	 */
	public function register() {
		spl_autoload_register(array($this, 'loadClass'));
		return $this;
	}

	/**
	 * Unregister this class loader.
	 * @return ClassLoader Fluent
	 */
	public function unregister() {
		spl_autoload_unregister(array($this, 'loadClass'));
		return $this;
	}

	/**
	 *
	 * @param <type> $className
	 * @return bool true on success false on faliure.
	 */
	public function loadClass($className) {
		//check classes
		if (isset($this->classes[$className])) {
			require_once( $this->classes[$className] );
			return true;
		}
		//check namespaces
		if ($namespace = $this->getNamespace($className)) {
			require($this->getPath($namespace)
				.str_replace(
          $this->getNamespaceSeperator($namespace),
					DIRECTORY_SEPARATOR,
					$className)
				.'.'.$this->getExtension($namespace));
			return true;
		}
		return false;
	}

	/**
	 *
	 * @param <type> $className
	 * @return <type>
	 */
	private function getNamespace($className) {
		foreach ($this->namespaces as $ns => $prams) {
			if ( $className === $ns || strpos($className, $ns.$this->getNamespaceSeperator($ns)) === 0 ) {
				return $ns;
			}
		}
		return null;
	}

	/**
	 *
	 * @param <type> $namespace The namespace.
	 * @return <type>
	 */
	private function getPath($namespace) {
		return (! empty($this->namespaces[$namespace][self::PATH])?
			$this->namespaces[$namespace][self::PATH] . DIRECTORY_SEPARATOR
			: '')
      ;
	}

	/**
	 * 
	 * @param string $namespace The namespace.
	 * @return string The seperator the namespace uses
	 */
	private function getNamespaceSeperator($namespace) {
		return isset($this->namespaces[$namespace][self::SEPERATOR])?
			$this->namespaces[$namespace][self::SEPERATOR]
			:self::DEFAULT_SEPERATOR;
	}

	/**
	 * Get the fileextension for the namespace.
	 * @param string $namespace The namespace.
	 * @return string The file extension.
	 */
	private function getExtension($namespace) {
		return isset($this->namespaces[$namespace][self::EXTENSION])?
			$this->namespaces[$namespace][self::EXTENSION]
			:self::DEFAULT_EXTENSION;
	}
}