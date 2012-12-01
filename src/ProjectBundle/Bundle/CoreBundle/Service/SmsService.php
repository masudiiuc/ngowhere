<?php

namespace ProjectBundle\Bundle\CoreBundle\Service;

class SmsService extends BaseService
{
    public function send($data = array())
    {
        $host = $this->container->getParameter('sms_host');
        $port = $this->container->getParameter('sms_port');
        $user = $this->container->getParameter('sms_username');
        $pass = $this->container->getParameter('sms_password');

        $messageType = $this->container->getParameter('sms_message_type');
        $deliveryReport = $this->container->getParameter('sms_del_report');

        $this->setEndpoint("http://$host:$port");

        $params = http_build_query(array(
            'username'    => $user,
            'password'    => $pass,
            'type'        => $messageType,
            'dlr'         => $deliveryReport,
            'destination' => (substr($data['mobileNumber'], 0, 2) == '88') ? $data['mobileNumber'] : '88' . $data['mobileNumber'],
            'source'      => $data['sender'],
            'message'     => $data['message']
        ));

        $response = $this->get('/bulksms/bulksms?' . $params);
        return $this->getStatus($response);
    }

    private function getStatus($response)
    {
        $status = explode('|', $response);

        switch ($status[0]) {
            case '1701': $message = 'OK'; break;
            case '1702': $message = 'Invalid URL'; break;
            case '1703': $message = 'Invalid username/password'; break;
            case '1704': $message = 'Invalid type'; break;
            case '1705': $message = 'Invalid Message'; break;
            case '1706': $message = 'Invalid Destination'; break;
            case '1707': $message = 'Invalid Source'; break;
            case '1709': $message = 'User validation failed'; break;
            case '1710': $message = 'Internal Error'; break;
            case '1025': $message = 'Insufficient Credit'; break;
        }

        return $message;
    }
}