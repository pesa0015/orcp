<?php
/**
 * MailChimp API Integration
 */
class ORCP_Newsletter {

	/**
	 * API Key
	 * @var string
	 */
	protected $api_key;

	/**
	 * List ID
	 * @var string
	 */
	protected $list_id;

	/**
	 * API Endpoint
	 * @var string
	 */
	protected $endpoint;

	public function __construct() {

		// Set the API key
		$this->api_key = 'f9ab835d3410e7bd760b9ac9c2ecf8c9-us10';

		// Set the list ID
		$this->list_id = 'e8a73da059';

		// Set the endpoint
		$this->endpoint = 'https://us10.api.mailchimp.com/3.0';

	}

	/**
	 * apicall()
	 *
	 * Function to make the API call to the MailChimp API.
	 * Uses the MailChimp API v3
	 *
	 * @param  string $method 	GET/POST
	 * @param  string $endpoint MailChimp API Endpoint
	 * @param  string $data   	POST Data in JSON format
	 * @return array          	Response from MailChimp
	 */
	protected function apicall( $method = '', $endpoint = '', $data = false ) {

		if ( $method && $endpoint ) {

			// Set the API Call URL
			$api_call_url = $this->endpoint . $endpoint;

			// Set the args
			$args = array(
				'headers' => array(
					'Authorization' => 'Basic ' . $this->api_key,
				),
			);

			if ( $data ) {
				$args['body'] = $data;
			}

			if ( $method == 'GET' ) {
				$response = wp_remote_get( $api_call_url, $args );
			} elseif ( $method == 'POST' ) {
				$response = wp_remote_post( $api_call_url, $args );
			}

			if ( ! is_wp_error( $response ) ) {

				return $response;

			} else {
				$error_message = $response->get_error_message();
				echo "An error occured: $error_message";
			}

		} else {
			return WP_Error( 'no call', __( 'No method and/or endpoint was specified when making the API call.', 'orcp' ) );
		}

	}

	/**
	 * subscribe_email()
	 *
	 * Subscribe an email user to a list
	 *
	 * @param  [type]  $email   [description]
	 * @param  boolean $list_id [description]
	 * @return [type]           [description]
	 */
	public function subscribe_email( $email, $list_id = false ) {

		if ( false == $list_id ) {
			$list_id = $this->list_id;
		}

		if ( ! is_email( $email ) ) {
			return WP_Error( 'bad email', __( 'The email address is not a valid email address.', 'orcp' ) );
		}

		$request_body = array(
			'email_address' => $email,
			'status'		=> 'subscribed',
		);

		$request_body_json = json_encode( $request_body );

		// Do the MailChimp API Call
		$response = $this->apicall( 'POST', '/lists/' . $list_id . '/members', $request_body_json );

		if ( '200' == $response['response']['code'] ) {
			return true;
		} else {
			return false;
		}

	}

}