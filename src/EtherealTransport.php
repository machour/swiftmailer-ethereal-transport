<?php

namespace Machour\SwiftMailerEtherealTransport;

use Closure;

/**
 * @property array[] $plugins
 */
class EtherealTransport extends \Swift_SmtpTransport
{
    public const EVENT_TRANSPORT_DONE = 'transportDone';

    private ?Closure $callback = null;

    public function __construct($host = 'smtp.ethereal.email', $port = 587, $encryption = 'tls')
    {
        parent::__construct($host, $port, $encryption);
    }

    public function executeCommand($command, $codes = [], &$failures = null, $pipeline = false, $address = null): ?string
    {
        $response = parent::executeCommand($command, $codes, $failures, $pipeline, $address);

        if ($this->callback && preg_match('!^250 Accepted \[STATUS=new MSGID=(.*)]$!', trim($response), $matches)) {
            call_user_func($this->callback, "https://ethereal.email/message/$matches[1]");
        }

        return $response;
    }

    public function setCallback(Closure $callback)
    {
        $this->callback = $callback;
    }
}
