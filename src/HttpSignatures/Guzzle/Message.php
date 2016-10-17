<?php

namespace HttpSignatures\Guzzle;

use Guzzle\Http\Message\RequestInterface;

class Message
{
    /** @var RequestInterface */
    private $request;

    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    /**
     * @return RequestInterface
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasHeader($name)
    {
        return $this->request->hasHeader($name);
    }

    /**
     * @param string $name
     * @return string[]
     */
    public function getHeader($name)
    {
        return $this->request->getHeader($name)->toArray();
    }

    /**
     * @param string $name
     * @param string|string[] $value
     * @return static
     * @throws \InvalidArgumentException
     */
    public function withAddedHeader($name, $value)
    {
        $this->request->setHeader($name, $value);
        return $this;
    }

    /**
     * @return $this
     */
    public function getUri()
    {
        return $this;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->request->getPath();
    }

    /**
     * @return string
     */
    public function getQuery()
    {
        $qs = (string) $this->request->getQuery();
        return !empty($qs) ? $qs : null;
    }

    /**
     * Retrieves the HTTP method of the request.
     *
     * @return string Returns the request method.
     */
    public function getMethod()
    {
        return $this->request->getMethod();
    }
}
