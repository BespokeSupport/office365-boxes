<?php

class BoxTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @expectedException ArgumentCountError
     */
    public function testConstructFail()
    {
        new \BespokeSupport\Office365MailImap\Office365MailBox();
    }

    /**
     * @expectedException \BespokeSupport\Office365MailImap\Office365MailImapException
     */
    public function testConstructFailEmpty()
    {
        $user = '';
        $pass = '';
        new \BespokeSupport\Office365MailImap\Office365MailBox($user, $pass);
    }

    /**
     * @expectedException \BespokeSupport\Office365MailImap\Office365MailImapException
     */
    public function testConstruct()
    {
        $user = 'box@example.com';
        $pass = 'password';
        $shared = 'hello@example.com';
        $imap = new \BespokeSupport\Office365MailImap\Office365MailBox($user, $pass, $shared);
    }
}
