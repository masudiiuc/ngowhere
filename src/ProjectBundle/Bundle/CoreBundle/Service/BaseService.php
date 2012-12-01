<?php

namespace ProjectBundle\Bundle\CoreBundle\Service;

use ProjectBundle\Bundle\CoreBundle\Utility\Http\Factory;
use ProjectBundle\Bundle\CoreBundle\Utility\Http\HttpInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

class BaseService
{
    /** @var bool */
    protected $debug;

    /** @var string */
    protected $endpoint;

    /** @var ContainerAwareInterface */
    protected $container;

    /** @var HttpInterface */
    protected $httpClient;

    public function __construct($container)
    {
        $this->container = $container;
        $this->httpClient = Factory::get($this->container->getParameter('http_client'));

        if ((bool) $this->container->getParameter('service_debug')) {
            $this->debug(true);
        }
    }

    public function get($path, $cache = false)
    {
        if (is_null($this->endpoint)) {
            throw new \Exception('Endpoint must be defined first before making any service call.');
        }

        if ($cache) {
            $data = apc_fetch($path);
        } else {
            $data = null;
        }

        if (!$data) {

            $this->httpClient->get($this->endpoint . $path);
            $this->logServiceCalls();

            $data = $this->httpClient->getResponseBody();

            if ($cache) {
                apc_store($path, $data);
            }
        }

        return $data;
    }

    public function post($path, $data)
    {
        if (is_null($this->endpoint)) {
            throw new \Exception('Endpoint must be defined first before making any service call.');
        }

        $this->httpClient->post($this->endpoint . $path, $data);
        $this->logServiceCalls();

        return $this->httpClient->getResponseBody();
    }

    public function put($path, $data)
    {
        if (is_null($this->endpoint)) {
            throw new \Exception('Endpoint must be defined first before making any service call.');
        }

        $this->httpClient->put($this->endpoint . $path, $data);
        $this->logServiceCalls();

        return $this->httpClient->getResponseBody();
    }

    public function delete($path)
    {
        if (is_null($this->endpoint)) {
            throw new \Exception('Endpoint must be defined first before making any service call.');
        }

        $this->httpClient->delete($this->endpoint . $path);
        $this->logServiceCalls();

        return $this->httpClient->getResponseBody();
    }

    protected function logServiceCalls()
    {
        if ($this->debug) {

            $file = $this->container->getParameter('kernel.logs_dir') . '/service_calls.log';

            $data = '[' . date('Y-m-d H:i:s') . '] '
                  . $this->httpClient->getRawRequestMessage()
                  . PHP_EOL . PHP_EOL
                  . $this->httpClient->getRawResponseMessage()
                  . PHP_EOL . PHP_EOL . PHP_EOL;

            file_put_contents($file, $data, FILE_APPEND);

        }
    }

    public function setHttpClient($client)
    {
        $this->httpClient = $client;
    }

    public function getHttpClient()
    {
        return $this->httpClient;
    }

    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
    }

    public function getEndpoint()
    {
        return $this->endpoint;
    }

    public function debug($mode)
    {
        $this->debug = (bool) $mode;
    }
}