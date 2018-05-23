<?php

namespace BespokeSupport\Office365MailImap;

use PhpImap\Mailbox;

class Office365MailImap
{
    /**
     * @var string
     */
    private $tmpDir;
    /**
     * @var Mailbox
     */
    private $box;

    /**
     * @param string $user
     * @param string $pass
     * @param string $tmpDir
     * @param string|null $sharedUser
     * @throws \PhpImap\Exception
     * @throws Office365MailImapException
     */
    public function __construct(string $user, string $pass, string $tmpDir = null, string $sharedUser = null)
    {
        $this->tmpDir = $tmpDir;

        $this->box = new Office365MailBox($user, $pass, $sharedUser);
        $this->box->setAttachmentsDir($tmpDir);
    }

    /**
     * @return Mailbox
     */
    public function getBox()
    {
        return $this->box;
    }

    /**
     * @return array
     */
    public function getAllMessages()
    {
        return $this->box->searchMailbox('ALL');
    }

    /**
     * @param string $search
     * @return array
     */
    public function searchUnseen()
    {
        return $this->box->searchMailbox("UNSEEN");
    }

    /**
     * @param string $search
     * @return array
     */
    public function searchFrom(string $search)
    {
        return $this->box->searchMailbox("FROM $search");
    }

    /**
     * @param string $search
     * @return array
     */
    public function searchTo(string $search)
    {
        return $this->box->searchMailbox("TO $search");
    }

    /**
     * @param string $search
     * @return array
     */
    public function searchSubject(string $search)
    {
        return $this->box->searchMailbox("SUBJECT $search");
    }
}
