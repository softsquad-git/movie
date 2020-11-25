<?php

namespace App\Services\Mail;

use App\Interfaces\Mail\MailServiceInterface;
use App\Mail\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class MailService implements MailServiceInterface
{
    /**
     * @var string $to
     */
    private $to;

    /**
     * @var string $template
     */
    private $template;

    /**
     * @var array $body
     */
    private $body;

    /**
     * @var string $subject
     */
    private $subject;

    /**
     * @return string
     */
    public function getTo(): string
    {
        return $this->to;
    }

    /**
     * @param string $to
     * @return $this
     */
    public function setTo(string $to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->template;
    }

    /**
     * @param string $template
     * @return $this
     */
    public function setTemplate(string $template)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * @return array
     */
    public function getBody(): array
    {
        return $this->body;
    }

    /**
     * @param array $body
     * @return $this
     */
    public function setBody(array $body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     * @return $this
     */
    public function setSubject(string $subject)
    {
        $this->subject = $subject;

        return $this;
    }

    public function send()
    {
        return Mail::to($this->getTo())
            ->send(new SendMail([
                'to' => $this->getTo(),
                'subject' => $this->getSubject(),
                'template' => $this->getTemplate(),
                'body' => $this->getBody()
            ]));
    }
}
