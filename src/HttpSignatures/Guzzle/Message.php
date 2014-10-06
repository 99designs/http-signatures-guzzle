<?php

namespace HttpSignatures\Guzzle;

use Guzzle\Http\Message\RequestInterface;

class Message
{
    private $request;
    public $headers;

    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
        $this->headers = new MessageHeaders($request);
    }

    public function getQueryString()
    {
        $qs = $this->request->getQuery(true);
        return !empty($qs) ? $qs : null;
    }

    public function getMethod()
    {
        return $this->request->getMethod();
    }

    public function getPathInfo()
    {
        return $this->request->getPath();
    }
}
