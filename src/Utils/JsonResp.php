<?php

namespace App\Utils;

use Symfony\Component\HttpFoundation\Response;

class JsonResp extends Response {

	public function __construct($content = '', int $status = 200, array $headers = array()) {
		if($content !== '' || $status !== 200 || count($headers) > 0) {
			// SETUP the JSON reponse
			$content = json_encode($content);
	
			parent::__construct();
	
			$this->setStatusCode($status, Response::$statusTexts[$status]);
		} else {
			// DEFUALT
			parent::__construct();
		}
		$this->headers->set('Content-Type', 'application/json');
	}

	// public function ok(){

	// }

	/**
	 * set this as a bad request
	 *
	 * @return void
	 */
	public function badRequest($data = null) : JsonResp {
		$this->setContent(json_encode($data));
		$this->setStatusCode(Response::HTTP_BAD_REQUEST, Response::$statusTexts[Response::HTTP_BAD_REQUEST]);

		return $this;
	}

	/**
	 * set this as a created
	 *
	 * @return void
	 */
	public function created($data = null) : JsonResp {
		$this->setContent(json_encode($data));
		$this->setStatusCode(Response::HTTP_CREATED, Response::$statusTexts[Response::HTTP_CREATED]);

		return $this;
	}

	/**
	 * set this as a not found
	 *
	 * @return void
	 */
	public function notFound($data = null) : JsonResp {
		$this->setContent(json_encode($data));
		$this->setStatusCode(Response::HTTP_NOT_FOUND, Response::$statusTexts[Response::HTTP_NOT_FOUND]);

		return $this;
	}

	/**
	 * set this as a found
	 *
	 * @return void
	 */
	public function found($data = null) : JsonResp {
		$this->setContent(json_encode($data));
		$this->setStatusCode(Response::HTTP_FOUND, Response::$statusTexts[Response::HTTP_FOUND]);

		return $this;
	}


	/**
	 * set this as a not modified
	 *
	 * @return void
	 */
	public function notModified($data = null) : JsonResp {
		$this->setContent(json_encode($data));
		$this->setStatusCode(Response::HTTP_NOT_MODIFIED, Response::$statusTexts[Response::HTTP_NOT_MODIFIED]);

		return $this;
	}

	/**
	 * set this as a unauthorized
	 *
	 * @return void
	 */
	public function unauthorized($data = null) : JsonResp {
		$this->setContent(json_encode($data));
		$this->setStatusCode(Response::HTTP_UNAUTHORIZED, Response::$statusTexts[Response::HTTP_UNAUTHORIZED]);

		return $this;
	}

	/**
	 * set this as a conflict
	 *
	 * @return void
	 */
	public function conflict($data = null) : JsonResp {
		$this->setContent(json_encode($data));
		$this->setStatusCode(Response::HTTP_CONFLICT, Response::$statusTexts[Response::HTTP_CONFLICT]);

		return $this;
	}

	/**
	 * set this as a internal server error
	 *
	 * @return void
	 */
	public function internal($data = null) : JsonResp {
		$this->setContent(json_encode($data));
		$this->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR, Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR]);

		return $this;
	}



}
