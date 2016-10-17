<?php

namespace HttpSignatures\Guzzle;

use Guzzle\Common\Event;
use HttpSignatures\Context;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class RequestSubscriber implements EventSubscriberInterface
{
    /** @var Context */
    private $context;

    /**
     * @param Context $context
     */
    function __construct($context)
    {
        $this->context = $context;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            'client.create_request' => 'signRequest'
        );
    }

    /**
     * @param Event $e
     */
    public function signRequest($e)
    {
        $request = new Message($e['request']);
        $this->context->signer()->sign($request);
    }
}
