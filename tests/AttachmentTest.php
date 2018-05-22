<?php

use BespokeSupport\Office365MailImap\Office365MailImapStatics;

class AttachmentTest extends \PHPUnit\Framework\TestCase
{
    public function testSingle()
    {
        $attachment = new \PhpImap\IncomingMailAttachment();

        $file = Office365MailImapStatics::attachmentToFileEntity($attachment);

        $this->assertInstanceOf(\BespokeSupport\DocumentStorage\EntityFile::class, $file);
    }

    public function testArray()
    {
        $mail = new \PhpImap\IncomingMail();
        $mail->addAttachment(new \PhpImap\IncomingMailAttachment());

        $files = Office365MailImapStatics::attachmentsToFileEntities($mail);

        $this->assertCount(1, $files);
        $this->assertInstanceOf(\BespokeSupport\DocumentStorage\EntityFile::class, $files[0]);
    }
}
