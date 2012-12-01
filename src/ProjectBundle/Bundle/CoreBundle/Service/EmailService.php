<?php

namespace ProjectBundle\Bundle\CoreBundle\Service;

class EmailService extends BaseService
{
    public function send($data = array())
    {
        $message = \Swift_Message::newInstance()
                   ->setSubject('You have received money!')
                   ->setFrom($data['sender'], $data['senderName'])
                   ->setTo($data['emailAddress'])
                   ->setBody($data['message']);

        try {
            $this->container->get('mailer')->send($message);
            return 'OK';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function sendReport($data = array())
    {
        $message = \Swift_Message::newInstance()
                   ->setSubject('ProjectBundle Report')
                   ->setFrom($data['sender'], $data['senderName'])
                   ->setTo($data['emailAddress'])
                   ->setBody($data['message']);

        if (!empty($data['report'])) {
            $message->attach(\Swift_Attachment::fromPath($data['report']));
        }

        try {
            $this->container->get('mailer')->send($message);
            return 'OK';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}