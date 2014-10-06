<?php

namespace HttpSignatures\Test;

use HttpSignatures\Guzzle\RequestSubscriber;
use HttpSignatures\Context;
use HttpSignatures\Guzzle\Message;

class GuzzleSignerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Context
     */
    private $context;

    /**
     * @var \Guzzle\Http\Client
     */
    private $client;

    public function setUp()
    {
        $this->context = new Context(array(
            'keys' => array('pda' => 'secret'),
            'algorithm' => 'hmac-sha256',
            'headers' => array('(request-target)', 'date'),
        ));

        $this->client = new \Guzzle\Http\Client();
        $this->client->addSubscriber(new RequestSubscriber($this->context));
    }

    public function testGuzzleRequestHasExpectedHeaders()
    {
        $message = $this->client->get('/path?query=123', array('date' => 'today', 'accept' => 'llamas'));

        $expectedString = implode(
            ',',
            array(
                'keyId="pda"',
                'algorithm="hmac-sha256"',
                'headers="(request-target) date"',
                'signature="SFlytCGpsqb/9qYaKCQklGDvwgmrwfIERFnwt+yqPJw="',
            )
        );

        $this->assertEquals(
            $expectedString,
            (string) $message->getHeader('Signature')
        );

        $this->assertEquals(
            'Signature ' . $expectedString,
            (string) $message->getHeader('Authorization')
        );
    }

    public function testGuzzleRequestHasExpectedHeaders2()
    {
        $message = $this->client->get('/path', array('date' => 'today', 'accept' => 'llamas'));

        $expectedString = implode(
            ',',
            array(
                'keyId="pda"',
                'algorithm="hmac-sha256"',
                'headers="(request-target) date"',
                'signature="DAtF133khP05pS5Gh8f+zF/UF7mVUojMj7iJZO3Xk4o="',
            )
        );

        $this->assertEquals(
            $expectedString,
            (string) $message->getHeader('Signature')
        );

        $this->assertEquals(
            'Signature ' . $expectedString,
            (string) $message->getHeader('Authorization')
        );
    }

    public function testVerifyGuzzleRequest()
    {
        $message = $this->client->get('/path?query=123', array('date' => 'today', 'accept' => 'dogs'));
        $this->assertTrue($this->context->verifier()->isValid(new Message($message)));
    }
}
