<?php

namespace BespokeSupport\Office365MailImap;

use PhpImap\Mailbox;

class Office365MailBox extends Mailbox
{
    /**
     * Office365MailImap constructor.
     * @param string $user
     * @param string $pass
     * @param string|null $sharedUser
     * @throws \PhpImap\Exception
     * @throws Office365MailImapException
     */
    public function __construct(string $user, string $pass, string $sharedUser = null, string $inbox = 'INBOX')
    {
        if (!$user || !$pass) {
            throw new Office365MailImapException('User / Pass invalid');
        }

        if ($sharedUser && strpos($sharedUser, '@') !== false) {
            throw new Office365MailImapException('$sharedUser box only');
        }

        $userStr = $user . (($sharedUser) ? '\\' . $sharedUser : '');

        parent::__construct(
            '{outlook.office365.com:993/imap/ssl/novalidate-cert}' . $inbox,
            $userStr,
            $pass,
            null,
            'US-ASCII'
        );

        $this->setConnectionArgs(0, 0, [
            'DISABLE_AUTHENTICATOR' => 'PLAIN'
        ]);
    }

    /**
     * @param string $attachmentsDir
     * @throws Office365MailImapException
     */
    public function setAttachmentsDir($attachmentsDir)
    {
        if (!$attachmentsDir) {
            return;
        }

        if (!is_dir($attachmentsDir)) {
            throw new Office365MailImapException('Directory "' . $attachmentsDir . '" not found');
        }

        $this->attachmentsDir = rtrim(realpath($attachmentsDir), '\\/');
    }
}
