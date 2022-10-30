<?php

namespace AamDsam\Bpjs\PCare;

use GuzzleHttp\Client;

class PcareService
{
    /**
     * Guzzle HTTP Client object
     * @var \GuzzleHttp\Client
     */
    private $clients;

    /**
     * Request headers
     * @var array
     */
    private $headers;

    /**
     * X-cons-id header value
     * @var int
     */
    private $cons_id;

    /**
     * X-Timestamp header value
     * @var string
     */
    private $timestamp;

    /**
     * X-Signature header value
     * @var string
     */
    private $signature;

    /**
     * X-Authorization header value
     * @var string
     */
    private $authorization;

    /**
     * @var string
     */
    private $secret_key;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $app_code;

    /**
     * @var string
     */
    private $base_url;

    /**
     * @var string
     */
    private $service_name;

    /**
     * @var string
     */
    private $user_key;

    /**
     * @var string
     */
    protected $feature;

    /**
     * @var string
     */
    public $key_decrypt;

    public function __construct($configurations = [])
    {
        $this->clients = new Client([
            'verify' => false
        ]);

        foreach ($configurations as $key => $val) {
            if (property_exists($this, $key)) {
                $this->$key = $val;
            }
        }

        //set X-Timestamp, X-Signature, and finally the headers
        $this->setTimestamp()->setSignature()->setAuthorization()->setHeaders();
    }

    public function keyword($keyword)
    {
        $this->feature .= "/{$keyword}";
        return $this;
    }

    public function responseDecoded($response)
    {
        // ubah ke array
        $responseArray = json_decode($response, true);
        if (!is_array($responseArray)) {
            return [
                "metaData" => [
                    "message" => $responseArray,
                    "code" => 201
                ]
            ];
        }

        if (!isset($responseArray["response"])) {
            return $responseArray;
        }


        $responseDecrypt = $this->stringDecrypt($responseArray["response"]);
        $responseArrayDecrypt = json_decode($responseDecrypt, true);

        // apabila bukan array
        if (!is_array($responseArrayDecrypt) || $responseDecrypt == '') {
            return $responseArray;
        }

        $responseArray["response"] = $responseArrayDecrypt;

        return $responseArray;
    }

    public function index($start = null, $limit = null)
    {
        $feature = $this->feature;
        if ($start !== null and $limit !== null) {
            $response = $this->get("{$feature}/{$start}/{$limit}");
        } else {
            $response = $this->get("{$feature}");
        }

        return $this->responseDecoded($response);
    }

    public function show($keyword = null, $start = null, $limit = null)
    {
        $feature = $this->feature;
        if ($start !== null and $limit !== null) {
            $response = $this->get("{$feature}/{$keyword}/{$start}/{$limit}");
        } elseif ($keyword !== null) {
            $response = $this->get("{$feature}/{$keyword}");
        } else {
            $response = $this->get("{$feature}");
        }
        return $this->responseDecoded($response);
    }

    public function store($data = [])
    {
        $response = $this->post($this->feature, $data);
        return $this->responseDecoded($response);
    }

    public function update($data = [])
    {
        $response = $this->put($this->feature, $data);
        return $this->responseDecoded($response);
    }

    public function destroy($keyword = null, $parameters = [])
    {
        $response = $this->delete($this->feature, $keyword, $parameters);
        return $this->responseDecoded($response);
    }

    protected function setHeaders()
    {
        $this->headers = [
            'X-cons-id'       => $this->cons_id,
            'X-Timestamp'     => $this->timestamp,
            'X-Signature'     => $this->signature,
            'X-Authorization' => $this->authorization,
            'user_key' => $this->user_key,
        ];

        return $this;
    }

    protected function setTimestamp()
    {
        date_default_timezone_set('UTC');
        $this->timestamp = strval(time() - strtotime('1970-01-01 00:00:00'));
        return $this;
    }

    protected function setSignature()
    {
        $data = "{$this->cons_id}&{$this->timestamp}";
        $signature = hash_hmac('sha256', $data, $this->secret_key, true);
        $encodedSignature = base64_encode($signature);
        $this->key_decrypt = "$this->cons_id$this->secret_key$this->timestamp";
        $this->signature = $encodedSignature;
        return $this;
    }

    protected function setAuthorization()
    {
        $data = "{$this->username}:{$this->password}:{$this->app_code}";
        $encodedAuth = base64_encode($data);
        $this->authorization = "Basic {$encodedAuth}";
        return $this;
    }

    protected function getClients()
    {
        return $this->clients;
    }

    protected function addHeader($key, $value)
    {
        $this->headers[$key] = $value;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function getBaseUrl()
    {
        return $this->base_url;
    }

    public function getServiceName()
    {
        return $this->service_name;
    }

    function stringDecrypt($string)
    {
        $encrypt_method = 'AES-256-CBC';
        $key_hash = hex2bin(hash('sha256', $this->key_decrypt));
        $iv = substr(hex2bin(hash('sha256', $this->key_decrypt)), 0, 16);
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);

        return \LZCompressor\LZString::decompressFromEncodedURIComponent($output);
    }

    protected function get($feature, $parameters = [])
    {
        $params = $this->getParams($parameters);
        $this->headers['Content-Type'] = 'application/json; charset=utf-8';
        try {
            $response = $this->clients->request(
                'GET',
                "{$this->base_url}/{$this->service_name}/{$feature}{$params}",
                [
                    'headers' => $this->headers
                ]
            )->getBody()->getContents();
        } catch (\Exception $e) {
            $response = $e->getMessage();
        }

        return $response;
    }

    protected function post($feature, $data = [], $headers = [])
    {
        // $this->headers['Content-Type'] = 'application/json';
        $this->headers['Accept'] = 'application/json';
        $this->headers['Content-Type'] = 'text/plain';

        if (!empty($headers)) {
            $this->headers = array_merge($this->headers, $headers);
        }
        try {
            $response = $this->clients->request(
                'POST',
                "{$this->base_url}/{$this->service_name}/{$feature}",
                [
                    'headers' => $this->headers,
                    'body'    => json_encode($data),
                ]
            )->getBody()->getContents();
        } catch (\Exception $e) {
            $response = $e->getMessage();
        }
        return $response;
    }

    protected function put($feature, $data = [])
    {
        // $this->headers['Content-Type'] = 'application/json';
        $this->headers['Content-Type'] = 'text/plain';
        $this->headers['Accept'] = 'application/json';
        try {
            $response = $this->clients->request(
                'PUT',
                "{$this->base_url}/{$this->service_name}/{$feature}",
                [
                    'headers' => $this->headers,
                    'body'    => json_encode($data),
                ]
            )->getBody()->getContents();
        } catch (\Exception $e) {
            $response = $e->getMessage();
        }
        return $response;
    }

    protected function delete($feature, $id, $parameters = [])
    {
        $params = $this->getParams($parameters);
        $this->headers['Content-Type'] = 'application/json';
        $this->headers['Accept'] = 'application/json';
        $url = "{$this->base_url}/{$this->service_name}";
        if ($id !== null) {
            $url .= "/{$feature}/{$id}";
        } else {
            $url .= "/{$feature}";
        }
        try {
            $response = $this->clients->request(
                'DELETE',
                "{$url}{$params}",
                [
                    'headers' => $this->headers,
                ]
            )->getBody()->getContents();
        } catch (\Exception $e) {
            $response = $e->getMessage();
        }
        return $response;
    }

    private function getParams($parameters)
    {
        $params = '';
        foreach ($parameters as $key => $value) {
            if (is_int($key)) {
                $params .= "/{$value}";
            } else {
                $params .= "/{$key}/{$value}";
            }
        }
        return $params;
    }
}
