<?php

namespace ProjetNormandie\EmailBundle\Infrastructure;

/**
 * Utility class that manages the attachments defined from the Email entity to a Swift_Attachment.
 */
class AttachmentManager
{
    /**
     * Builds a Swift_Attachment object with management of filename.
     *
     * @param string $attachmentPath
     * @param string|int $name If integer, will be ignored.
     * @return \Swift_Attachment
     */
    public static function buildSwift($attachmentPath, $name)
    {
        $file = \Swift_Attachment::fromPath($attachmentPath);
        if (is_string($name)) {
            $file->setFilename($name);
        }

        return $file;
    }
}
