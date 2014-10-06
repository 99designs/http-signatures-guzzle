HTTP Signatures Guzzle 3
===

[![Build Status](https://travis-ci.org/99designs/http-signatures-guzzle.svg)](https://travis-ci.org/99designs/http-signatures-guzzle)

Adds [99designs/http-signatures](http-signatures) support to Guzzle 3.  
For Guzzle 4 see the [99designs/http-signatures-guzzlehttp](99designs/http-signatures-guzzlehttp) repo.

Signing with Guzzle 3
---

This library includes support for automatically signing Guzzle requests using an event subscriber.

```php
use HttpSignatures\Context;
use HttpSignatures\Guzzle\RequestSubscriber;

$context = new Context(array(
  'keys' => array('examplekey' => 'secret-key-here'),
  'algorithm' => 'hmac-sha256',
  'headers' => array('(request-target)', 'Date', 'Accept'),
));

$client = new \Guzzle\Http\Client('http://example.org');
$client->addSubscriber(new RequestSubscriber($context));

// The below will now send a signed request to: http://example.org/path?query=123
$client->get('/path?query=123', array(
  'Date' => 'Wed, 30 Jul 2014 16:40:19 -0700',
  'Accept' => 'llamas',
))->send();
```

## Contributing

Pull Requests are welcome.

[99signatures]: https://github.com/99designs/http-signatures-php
