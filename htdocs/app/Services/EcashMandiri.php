<?php

namespace App\Services;

/**
 * Instagram API class
 *
 * API Documentation: https://www.ng.bluemix.net/docs/services/APIManagement/apim_014.html
 * Class Documentation: https://www.ng.bluemix.net/docs/services/APIManagement/apim_014.html
 *
 * @author EcashMandiri
 * @since 24.2.2011
 * @copyright
 * @version
 * @license BSD
 */
class EcashMandiri {

  /**
   * The API base URL
   */
  const API_URL = env('ECASH_URL', 'https://api.apim.ibmcloud.com/ex-icha-fmeirisidibmcom-ecash-be/sb/emoney/v1');

  /**
   * The Instagram API Key
   *
   * @var string
   */
  private $_apikey;

  /**
   * The Instagram OAuth API secret
   *
   * @var string
   */
  private $_apisecret;

  /**
   * The callback URL
   *
   * @var string
   */
  private $_callbackurl;

  /**
   * The user access token
   *
   * @var string
   */
  private $_accesstoken;

  /**
   * Whether a signed header should be used
   *
   * @var boolean
   */
  private $_signedheader = false;

  /**
   * Default constructor
   *
   * @param array|string $config          Instagram configuration data
   * @return void
   */
  public function __construct($config) {
    if (true === is_array($config)) {
      // if you want to access user data
      $this->setApiKey(env('ECASH_ID', 'e986e8da-4e37-4dcd-a727-a9b1515af9fd'));
      $this->setApiSecret(env('ECASH_SECRET', 'U8qJ1xQ6iW5bI6eA6gN1wY5mL0hM6iA5qU1cI0jS8bD5qQ4xQ0'));
    } else if (true === is_string($config)) {
      // if you only want to access public data
      $this->setApiKey($config);
    } else {
      throw new \Exception("Error: __construct() - Configuration data is missing.");
    }
  }

  /**
   * Generates the OAuth login URL
   *
   * @param array [optional] $scope       Requesting additional permissions
   * @return string                       Instagram OAuth login URL
   */
  public function getLoginUrl($scope = array('basic')) {
    if (is_array($scope) && count(array_intersect($scope, $this->_scopes)) === count($scope)) {
      return self::API_OAUTH_URL . '?client_id=' . $this->getApiKey() . '&redirect_uri=' . urlencode($this->getApiCallback()) . '&scope=' . implode('+', $scope) . '&response_type=code';
    } else {
      throw new \Exception("Error: getLoginUrl() - The parameter isn't an array or invalid scope permissions used.");
    }
  }

  /**
   * Search for a user
   *
   * @param string $name                  Instagram username
   * @param integer [optional] $limit     Limit of returned results
   * @return mixed
   */
  public function searchUser($name, $limit = 0) {
    return $this->_makeCall('users/search', false, array('q' => $name, 'count' => $limit));
  }

  /**
   * Get user info
   *
   * @param integer [optional] $id        Instagram user ID
   * @return mixed
   */
  public function getUser($id = 0) {
    $auth = false;
    if ($id === 0 && isset($this->_accesstoken)) { $id = 'self'; $auth = true; }
    return $this->_makeCall('users/' . $id, $auth);
  }

  /**
   * Get user activity feed
   *
   * @param integer [optional] $limit     Limit of returned results
   * @return mixed
   */
  public function getUserFeed($limit = 0) {
    return $this->_makeCall('users/self/feed', true, array('count' => $limit));
  }

  /**
   * Get user recent media
   *
   * @param integer [optional] $id        Instagram user ID
   * @param integer [optional] $limit     Limit of returned results
   * @return mixed
   */
  public function getUserMedia($id = 'self', $limit = 0) {
    return $this->_makeCall('users/' . $id . '/media/recent', ($id === 'self'), array('count' => $limit));
  }

  /**
   * Get the liked photos of a user
   *
   * @param integer [optional] $limit     Limit of returned results
   * @return mixed
   */
  public function getUserLikes($limit = 0) {
    return $this->_makeCall('users/self/media/liked', true, array('count' => $limit));
  }

  /**
   * Get the list of users this user follows
   *
   * @param integer [optional] $id        Instagram user ID
   * @param integer [optional] $limit     Limit of returned results
   * @return mixed
   */
  public function getUserFollows($id = 'self', $limit = 0) {
    return $this->_makeCall('users/' . $id . '/follows', true, array('count' => $limit));
  }

  /**
   * Get the list of users this user is followed by
   *
   * @param integer [optional] $id        Instagram user ID
   * @param integer [optional] $limit     Limit of returned results
   * @return mixed
   */
  public function getUserFollower($id = 'self', $limit = 0) {
    return $this->_makeCall('users/' . $id . '/followed-by', true, array('count' => $limit));
  }

  /**
   * Get information about a relationship to another user
   *
   * @param integer $id                   Instagram user ID
   * @return mixed
   */
  public function getUserRelationship($id) {
    return $this->_makeCall('users/' . $id . '/relationship', true);
  }

  /**
   * Pagination feature
   *
   * @param object  $obj                  Instagram object returned by a method
   * @param integer $limit                Limit of returned results
   * @return mixed
   */
  public function pagination($obj, $limit = 0) {
    if (true === is_object($obj) && !is_null($obj->pagination)) {
      if (!isset($obj->pagination->next_url)) {
        return;
      }
      $apiCall = explode('?', $obj->pagination->next_url);
      if (count($apiCall) < 2) {
        return;
      }
      $function = str_replace(self::API_URL, '', $apiCall[0]);
      $auth = (strpos($apiCall[1], 'access_token') !== false);
      if (isset($obj->pagination->next_max_id)) {
        return $this->_makeCall($function, $auth, array('max_id' => $obj->pagination->next_max_id, 'count' => $limit));
      } else {
        return $this->_makeCall($function, $auth, array('cursor' => $obj->pagination->next_cursor, 'count' => $limit));
      }
    } else {
      throw new \Exception("Error: pagination() | This method doesn't support pagination.");
    }
  }

  /**
   * Get the OAuth data of a user by the returned callback code
   *
   * @param string $code                  OAuth2 code variable (after a successful login)
   * @param boolean [optional] $token     If it's true, only the access token will be returned
   * @return mixed
   */
  public function getOAuthToken($code, $token = false) {
    $apiData = array(
      'grant_type'      => 'authorization_code',
      'client_id'       => $this->getApiKey(),
      'client_secret'   => $this->getApiSecret(),
      'redirect_uri'    => $this->getApiCallback(),
      'code'            => $code
    );

    $result = $this->_makeOAuthCall($apiData);
    return (false === $token) ? $result : $result->access_token;
  }

  /**
   * The call operator
   *
   * @param string $function              API resource path
   * @param array [optional] $params      Additional request parameters
   * @param boolean [optional] $auth      Whether the function requires an access token
   * @param string [optional] $method     Request type GET|POST
   * @return mixed
   */
  protected function _makeCall($function, $auth = false, $params = null, $method = 'GET') {
    if (false === $auth) {
      // if the call doesn't requires authentication
      $authMethod = '?client_id=' . $this->getApiKey();
    } else {
      // if the call needs an authenticated user
      if (true === isset($this->_accesstoken)) {
        $authMethod = '?token=' . $this->getAccessToken();
      } else {
        throw new \Exception("Error: _makeCall() | $function - This method requires an authenticated users access token.");
      }
    }

    if (isset($params) && is_array($params)) {
      $paramString = '&' . http_build_query($params);
    } else {
      $paramString = null;
    }

    $apiCall = self::API_URL . $function . $authMethod . (('GET' === $method) ? $paramString : null);

    // signed header of POST/DELETE requests
    $headerData = array('Accept: application/json');
    if (true === $this->_signedheader && 'GET' !== $method) {
      $headerData[] = 'X-Insta-Forwarded-For: ' . $this->_signHeader();
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiCall);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headerData);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    if ('POST' === $method) {
      curl_setopt($ch, CURLOPT_POST, count($params));
      curl_setopt($ch, CURLOPT_POSTFIELDS, ltrim($paramString, '&'));
    } else if ('DELETE' === $method) {
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    }

    $jsonData = curl_exec($ch);
    if (false === $jsonData) {
      throw new \Exception("Error: _makeCall() - cURL error: " . curl_error($ch));
    }
    curl_close($ch);

    return json_decode($jsonData);
  }

  /**
   * The OAuth call operator
   *
   * @param array $apiData                The post API data
   * @return mixed
   */
  private function _makeOAuthCall($apiData) {
    $apiHost = self::API_OAUTH_TOKEN_URL;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiHost);
    curl_setopt($ch, CURLOPT_POST, count($apiData));
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($apiData));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $jsonData = curl_exec($ch);
    if (false === $jsonData) {
      throw new \Exception("Error: _makeOAuthCall() - cURL error: " . curl_error($ch));
    }
    curl_close($ch);

    return json_decode($jsonData);
  }

  /**
   * Sign header by using the app's IP and its API secret
   *
   * @return string                       The signed header
   */
  private function _signHeader() {
    $ipAddress = $_SERVER['SERVER_ADDR'];
    $signature = hash_hmac('sha256', $ipAddress, $this->_apisecret, false);
    return join('|', array($ipAddress, $signature));
  }

  /**
   * Access Token Setter
   *
   * @param object|string $data
   * @return void
   */
  public function setAccessToken($data) {
    (true === is_object($data)) ? $token = $data->access_token : $token = $data;
    $this->_accesstoken = $token;
  }

  /**
   * Access Token Getter
   *
   * @return string
   */
  public function getAccessToken() {
    return $this->_accesstoken;
  }

  /**
   * API-key Setter
   *
   * @param string $apiKey
   * @return void
   */
  public function setApiKey($apiKey) {
    $this->_apikey = $apiKey;
  }

  /**
   * API Key Getter
   *
   * @return string
   */
  public function getApiKey() {
    return $this->_apikey;
  }

  /**
   * API Secret Setter
   *
   * @param string $apiSecret 
   * @return void
   */
  public function setApiSecret($apiSecret) {
    $this->_apisecret = $apiSecret;
  }

  /**
   * API Secret Getter
   *
   * @return string
   */
  public function getApiSecret() {
    return $this->_apisecret;
  }
  
  /**
   * API Callback URL Setter
   *
   * @param string $apiCallback
   * @return void
   */
  public function setApiCallback($apiCallback) {
    $this->_callbackurl = $apiCallback;
  }

  /**
   * API Callback URL Getter
   *
   * @return string
   */
  public function getApiCallback() {
    return $this->_callbackurl;
  }

  /**
   * Enforce Signed Header
   *
   * @param boolean $signedHeader
   * @return void
   */
  public function setSignedHeader($signedHeader) {
    $this->_signedheader = $signedHeader;
  }

}
