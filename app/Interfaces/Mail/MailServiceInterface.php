<?php

namespace App\Interfaces\Mail;

interface MailServiceInterface
{
    /**
     * @param string $to
     * @return mixed
     */
    public function setTo(string $to);

    /**
     * @param string $template
     * @return mixed
     */
    public function setTemplate(string $template);

    /**
     * @param array $body
     * @return mixed
     */
    public function setBody(array $body);

    /**
     * @param string $subject
     * @return mixed
     */
    public function setSubject(string $subject);

    /**
     * @return mixed
     */
    public function send();
}
