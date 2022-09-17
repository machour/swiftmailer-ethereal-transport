# Ethereal transport for Swift Mailer

This is a simple transport for Swift Mailer that uses [Ethreal](https://ethereal.email/), the fake SMTP service.

This transport is meant to be used while developing your application, in order to preview the message, without it getting actually sent.

Using this transport, you can set a callback that will be invoked with the URL to the message preview as its first and only argument.

## Installation

```shell
composer require machour/swiftmailer-ethereal-transport
```

## Usage

```php
use Machour\SwiftMailerEtherealTransport\EtherealTransport;

// Create the Transport
$transport = (new EtherealTransport())
  ->setUsername('your username')
  ->setPassword('your password')
  ->setCallback(fn(string $url) => $logger->debug("Email sent to Ethereal, see it at $url"));

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

// Create a message
$message = (new Swift_Message('Wonderful Subject'))
  ->setFrom(['john@doe.com' => 'John Doe'])
  ->setTo(['receiver@domain.org', 'other@domain.org' => 'A name'])
  ->setBody('Here is the message itself');

// Send the message
$result = $mailer->send($message);
```


## Note

Swift Mailer have been deprecated, use this extension if you're stuck with a legacy app

## See also
- [Ethereal](https://ethereal.email/)
- [Swift Mailer](https://swiftmailer.symfony.com/)