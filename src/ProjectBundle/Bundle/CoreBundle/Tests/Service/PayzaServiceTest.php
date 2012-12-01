<?php

namespace ProjectBundle\Bundle\CoreBundle\Tests\Service;

use ProjectBundle\Bundle\CoreBundle\Service\PayzaService;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;
use Symfony\Component\DependencyInjection\Container;

class PayzaServiceTest extends \PHPUnit_Framework_Testcase
{
    /** @var PayzaService */
    private $payzaService;

    /** @var \Mockery\MockInterface */
    private $httpClient;

    public function setUp()
    {
        $this->httpClient = \Mockery::mock('ProjectBundle\Bundle\CoreBundle\Utility\HttpRequest');
        $this->httpClient->shouldReceive('post')->withAnyArgs();

        $container = new Container(new ParameterBag(array(
            'payza_sandbox_host' => 'https://sandbox.payza.com/api/api.svc',
            'payza_sandbox_username' => 'test@ProjectBundlebd.com',
            'payza_sandbox_password' => '123456',
            'payza_sandbox_apikey' => 'ABCD-EFGH-IJKL-MNOP-QRST-UVWX-YZ',
            'payza_sandbox_purch_type' => '0',
            'payza_sandbox_testmode' => '0',
            'http_client' => 'HttpRequest',
            'service_debug' => '0'
        )));

        $this->payzaService = new PayzaService($container);
        $this->payzaService->setSandboxMode(true);
        $this->payzaService->setHttpClient($this->httpClient);
    }

    public function testAuthenticationIsSuccessful()
    {
        $username = 'client_3_chris@havefuture.com';
        $password = '69E7TH';

        $this->prepareHttpClientForAuthentication();
        $authenticated = $this->payzaService->authenticate($username, $password);

        $this->assertTrue($authenticated);
    }

    public function testAccountBalanceCanBeRetrieved()
    {
        $expected = array(
            'USD' => 4445.35,
            'CAD' => 2743.00
        );

        $this->prepareHttpClientForAccountBalance();
        $balances = $this->payzaService->getBalance();

        $this->assertEquals($expected, $balances);
    }

    public function testUserProfileCanBeRetrieved()
    {
        $expected = array(
            'firstName' => 'Client_3_Fname_Chris',
            'lastName'  => 'Client_3_Lname_Chris',
            'country'   => 'United States',
            'verified'  => true
        );

        $this->prepareHttpClientForUserProfile();
        $profile = $this->payzaService->getUserProfile();

        $this->assertEquals($expected, $profile);
    }

    private function prepareHttpClientForAuthentication()
    {
        $this->httpClient
             ->shouldReceive('getResponseBody')
             ->withAnyArgs()
             ->andReturn('RETURNCODE=100&RETURNDESCRIPTION=Transaction%20was%20completed%20successfully&SESSIONKEY=6a133200-fb54-43a3-a8dc-7b6ac01d92c9');

        $this->payzaService->setHttpClient($this->httpClient);
    }

    private function prepareHttpClientForAccountBalance()
    {
        $this->httpClient
             ->shouldReceive('getResponseBody')
             ->withAnyArgs()
             ->andReturn('RETURNCODE=100&DESCRIPTION=Transaction%20was%20completed%20successfully&AVAILABLEBALANCE_1=4445.35&CURRENCY_1=USD&AVAILABLEBALANCE_2=2743.00&CURRENCY_2=CAD');

        $this->payzaService->setHttpClient($this->httpClient);
    }

    private function prepareHttpClientForUserProfile()
    {
        $this->httpClient
             ->shouldReceive('getResponseBody')
             ->withAnyArgs()
             ->andReturn('RETURNCODE=100&RETURNDESCRIPTION=Transaction%20was%20completed%20successfully&FIRSTNAME=Client_3_Fname_Chris&LASTNAME=Client_3_Lname_Chris&COUNTRYNAME=United%20States&ISVERIFIED=True');

        $this->payzaService->setHttpClient($this->httpClient);
    }
}