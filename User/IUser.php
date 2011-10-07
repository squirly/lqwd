<?php
namespace lqwd;

/**
 * Description of IUser
 *
 * @todo Document Code
 * @author Tyler Jones <tylerjones64@gmail.com>
 */
interface IUser {
	public function getId();
	public function getNick();
	public function getName();
	public function authenticate($password);
	public function isAuthenticated();
}
?>
