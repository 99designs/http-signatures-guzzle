<?php

namespace HttpSignatures\Guzzle;

class Message
{
    private $request;
    public $headers;

    public function __construct($request)
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
