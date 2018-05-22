<?php

namespace BespokeSupport\Office365MailImap;

use BespokeSupport\DocumentStorage\DocumentStorage;
use BespokeSupport\DocumentStorage\EntityFile;
use PhpImap\IncomingMail;
use PhpImap\IncomingMailAttachment;

class Office365MailImapStatics
{
    /**
     * @param IncomingMail $mail
     * @return EntityFile[]
     */
    public static function attachmentsToFileEntities(IncomingMail $mail)
    {
        $entities = [];

        foreach ($mail->getAttachments() as $attachment) {
            $entities[] = self::attachmentToFileEntity($attachment);
        }

        return $entities;
    }

    /**
     * @param IncomingMailAttachment $attachment
     * @return EntityFile
     */
    public static function attachmentToFileEntity(IncomingMailAttachment $attachment)
    {
        $file = new EntityFile($attachment->filePath);

        $file = DocumentStorage::entityPopulate($file);

        return $file;
    }
}
