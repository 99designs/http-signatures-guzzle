<?php

namespace HttpSignatures\Guzzle;

use Guzzle\Http\Message\RequestInterface;

class MessageHeaders
{
    private $request;

    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    public function has($header)
    {
        return $this->request->hasHeader($header);
    }

    public function get($header)
    {
        return $this->request->getHeader($header);
    }

    public function set($header, $value)
    {
        $this->request->setHeader($header, $value);
    }
}
