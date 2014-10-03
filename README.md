HTTP Signatures Guzzle 3 & Guzzle 4
===

[![Build Status](https://travis-ci.org/99designs/http-signatures-guzzle.svg)](https://travis-ci.org/99designs/http-signatures-guzzle)

Adds Guzzle 3 and Guzzle 4 support to [99designs/http-signatures][99signatures]
The API for Guzzle 4 has some differences in how to subscribe to events, so make sure use the correct example!
And to use the classes from the `HttpSignatures\Guzzle4` namespace!

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

Signing with Guzzle 4
---

This library includes support for automatically signing Guzzle requests using an event subscriber.

```php
use HttpSignatures\Context;
use HttpSignatures\Guzzle4\RequestSubscriber;

$context = new Context(array(
  'keys' => array('examplekey' => 'secret-key-here'),
  'algorithm' => 'hmac-sha256',
  'headers' => array('(request-target)', 'Date', 'Accept'),
));

$client = new \Guzzle\Http\Client('http://example.org');
$client->getEmiter()->attach(new RequestSubscriber($context));

// The below will now send a signed request to: http://example.org/path?query=123
$client->get('/path?query=123', array(
  'Date' => 'Wed, 30 Jul 2014 16:40:19 -0700',
  'Accept' => 'llamas',
));
```

## Contributing

Pull Requests are welcome.

[99signatures]: https://github.com/99designs/http-signatures-php
