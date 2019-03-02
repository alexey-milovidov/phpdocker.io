<?php
/**
 * Copyright 2019 Luis Alberto Pabón Flores
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 */

namespace App\Contact;

use PHPDocker\Contact\DispatcherInterface;

class Dispatcher implements DispatcherInterface
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var string
     */
    private $emailFrom;

    /**
     * @var string
     */
    private $emailTo;

    /**
     * @var \Twig_Environment
     */
    private $twig;

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig, string $emailFrom, string $emailTo)
    {
        $this->mailer    = $mailer;
        $this->twig      = $twig;
        $this->emailFrom = $emailFrom;
        $this->emailTo   = $emailTo;
    }

    /**
     * Sends a message.
     *
     * @param Message $message
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function send(Message $message): void
    {
        $messageBody = $this->twig->render('contact-email.html.twig', [
            'senderEmail' => $message->getEmail(),
            'message'     => $message->getMessage(),
        ]);

        $swiftMessage = new \Swift_Message();
        $swiftMessage
            ->setSubject('PHPDocker.io - Contact request')
            ->setFrom($this->emailFrom)
            ->setReplyTo($message->getEmail())
            ->setTo($this->emailTo)
            ->setBody($messageBody, 'text/html');

        $this->mailer->send($swiftMessage);
    }
}