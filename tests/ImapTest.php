<?php

class ImapTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @expectedException ArgumentCountError
     */
    public function testConstructFail()
    {
        new \BespokeSupport\Office365MailImap\Office365MailImap();
    }

    /**
     * @expectedException \BespokeSupport\Office365MailImap\Office365MailImapException
     */
    public function testConstructFailEmpty()
    {
        $user = '';
        $pass = '';
        new \BespokeSupport\Office365MailImap\Office365MailImap($user, $pass);
    }

    /**
     *
     */
    public function testConstruct()
    {
        $user = ' ';
        $pass = ' ';
        $imap = new \BespokeSupport\Office365MailImap\Office365MailImap($user, $pass);
        $imap->getBox();
    }
}
