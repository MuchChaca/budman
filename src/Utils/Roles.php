<?php
namespace App\Utils;

final class Roles {
	// roles
	const ADMIN = 'ROLE_ADMIN';
	const BASIC = 'ROLE_BASIC_USER';

	private function __construct(){
		// do not instanciate
	}

	/**
	 * all retuns all the available roles
	 *
	 * @return array
	 */
	static function all() : array {
		return [
			Role::ADMIN,
			Role::BASIC,
		];
	}

	/**
	 * level1 returns an array of the first access level (lower is better)
	 *
	 * @return array
	 */
	static function level1() : array {
		return [
			Role::ADMIN,
		];
	}

	/**
	 * level5 returns an array of the 5th access level (lower is better)
	 *
	 * @return array
	 */
	static function level5() : array {
		return [
			Role::BASIC,
		];
	}

}

