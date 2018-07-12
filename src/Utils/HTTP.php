<?php

namespace App\Utils;

final class HTTP {

	/**
	 * Continue	The server has received the request headers, and the client should proceed to send the request body
	 */
	const CONTINUE = 100;
	
	/**
	 * Switching Protocols	The requester has asked the server to switch protocols
	 */
	const SWITCH_PROTOCOL = 101;
	
	/**
	 * Checkpoint	Used in the resumable requests proposal to resume aborted PUT or POST requests
	 */
	const CHECKPOINT = 103;
	

	/**
	 * The request was fulfilled.
	 */
	const OK = 200;

	/**
	 * Following a POST command, this indicates success, but the textual part of the response line indicates the URI by which the newly created document should be known.
	 */
	const CREATED = 201;

	/**
	 * The request has been accepted for processing, but the processing has not been completed. The request may or may not eventually be acted upon, as it may be disallowed when processing actually takes place. there is no facility for status returns from asynchronous operations such as this.
	 */
	const ACCEPTED = 202;

	/**
	 * When received in the response to a GET command, this indicates that the returned metainformation is not a definitive set of the object from a server with a copy of the object, but is from a private overlaid web. This may include annotation information about the object, for example.
	 */
	const PARTIAL_INFORMATION = 203;


	/**
	 * Server has received the request but there is no information to send back, and the client should stay in the same document view. This is mainly to allow input for scripts without changing the document at the same time.
	 */
	const NO_RESPONSE = 204;


	/**
	 * The request had bad syntax or was inherently impossible to be satisfied.
	 */
	const BAD_REQUEST = 400;

	/**
	 * The parameter to this message gives a specification of authorization schemes which are acceptable. The client should retry the request with a suitable Authorization header.
	 */
	const UNAUTHORIZED = 401;

	/**
	 * The parameter to this message gives a specification of charging schemes acceptable. The client may retry the request with a suitable ChargeTo header.
	 */
	const PAYMENT_REQUIRED = 402;


	/**
	 * The request is for something forbidden. Authorization will not help.
	 */
	const FORBIDDEN = 403;


	/**
	 * The server has not found anything matching the URI given
	 */
	const NOT_FOUND = 404;

	/**
	 * The server encountered an unexpected condition which prevented it from fulfilling the request.
	 */
	const INTERNAL_ERROR = 500;


	/**
	 * The server does not support the facility required.
	 */
	const NOT_IMPLEMENTED = 501;


	/**
	 * The server cannot process the request due to a high load (whether HTTP servicing or other requests). The implication is that this is a temporary condition which maybe alleviated at other times.
	 */
	const OVERLOADED = 502;

	/**
	 * This is equivalent to Internal Error 500, but in the case of a server which is in turn accessing some other service, this indicates that the respose from the other service did not return within a time that the gateway was prepared to wait. As from the point of view of the clientand the HTTP transaction the other service is hidden within the server, this maybe treated identically to Internal error 500, but has more diagnostic value.
	 *
	 * Note: The 502 and 503 codes are new and for discussion, September 19, 1994
	 */
	const GATEWAY_TIMEOUT = 503;


	/**
	 * The data requested has been assigned a new URI, the change is permanent. (N.B. this is an optimisation, which must, pragmatically, be included in this definition. Browsers with link editing capabiliy should automatically relink to the new reference, where possible)
	 * 
	 * The response contains one or more header lines of the form
	 * 
	 *        URI: <url> String CrLf
	 * 
	 * Which specify alternative addresses for the object in question. The String is an optional comment field. If the response is to indicate a set of variants which each correspond to the requested URI, then the multipart/alternative wrapping may be used to distinguish different sets
	 * 
	*/
	const MOVED = 301;

	/**
	 * The data requested actually resides under a different URL, however, the redirection may be altered on occasion (when making links to these kinds of document, the browser should default to using the Udi of the redirection document, but have the option of linking to the final document) as for "Forward".
	 *
	 *The response format is the same as for Moved .
	*/
	const FOUND = 302;


	/**
	 * 	Method: <method> <url>
	 * 	body-section
	 * Note: This status code is to be specified in more detail. For the moment it is for discussion only.
	 * 
	 * Like the found response, this suggests that the client go try another network address. In this case, a different method may be used too, rather than GET.
	 * 
	 * The body-section contains the parameters to be used for the method. This allows a document to be a pointer to a complex query operation.
	 * 
	 * The body may be preceded by the following additional fields as listed.
	*/
	const METHOD = 303;

	/**
	 * If the client has done a conditional GET and access is allowed, but the document has not been modified since the date and time specified in If-Modified-Since field, the server responds with a 304 status code and does not send the document body to the client.
	 *
	 * Response headers are as if the client had sent a HEAD request, but limited to only those headers which make sense in this context. This means only headers that are relevant to cache managers and which may have changed independently of the document's Last-Modified date. Examples include Date , Server and Expires .
	 */
	const NOT_MODIFIED = 304;

	private const CODES = [
		// 1XX
		HTTP::CONTINUE				=> "The server has received the request headers, and the client should proceed to send the request body",
		HTTP::SWITCH_PROTOCOL	=> "The requester has asked the server to switch protocols",
		HTTP::CHECKPOINT			=> "Used in the resumable requests proposal to resume aborted PUT or POST requests",
		// 2XX
		HTTP::OK						=> "The request is OK (this is the standard response for successful HTTP requests)",
		HTTP::CREATED				=> "The request has been fulfilled, and a new resource is created ",
		HTTP::ACCEPTED				=> "The request has been accepted for processing, but the processing has not been completed",
		HTTP::PARTIAL_INFORMATION => "The server is delivering only part of the resource due to a range header sent by the client",
		HTTP::NO_RESPONSE			=> "The request has been successfully processed, but is not returning any content",
		// 3XX
		HTTP::MOVED					=> "The requested page has moved to a new URL",
		HTTP::FOUND					=> "The requested page has moved temporarily to a new URL",
		HTTP::METHOD				=> "",
		HTTP::NOT_MODIFIED		=> "Indicates the requested page has not been modified since last requested",
		// 4XX
		HTTP::BAD_REQUEST			=> "The request cannot be fulfilled due to bad syntax",
		HTTP::UNAUTHORIZED		=> "The request was a legal request, but the server is refusing to respond to it. For use when authentication is possible but has failed or not yet been provided",
		HTTP::PAYMENT_REQUIRED	=> "Reserved for future use",
		HTTP::FORBIDDEN			=> "The request was a legal request, but the server is refusing to respond to it",
		HTTP::NOT_FOUND			=> "The requested page could not be found but may be available again in the future",
		// 5XX
		HTTP::INTERNAL_ERROR		=> "A generic error message, given when no more specific message is suitable",
		HTTP::NOT_IMPLEMENTED	=> "The server either does not recognize the request method, or it lacks the ability to fulfill the request",
		HTTP::OVERLOADED			=> "",
		HTTP::GATEWAY_TIMEOUT	=> "	The server was acting as a gateway or proxy and did not receive a timely response from the upstream server",
	];

	/**
	 * This class can't be instanciated !
	 */
	private function __construct() {
		// empty, can't be instanciated
	}

	/**
	 * Returns the associated message to the HTTP code.
	 *
	 * @param integer $code
	 * @return string
	 */
	static function MESSAGE(int $code) : string {
		return HTTP::CODES[$code];
	}
}
