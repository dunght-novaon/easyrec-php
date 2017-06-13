Easyrec PHP Library (beta)
==========================


## What is easyrec?
easyrec is an open source recommendation engine system that provides personalized recommendations using a RESTful API.

## The recommendation engine server
You can use the server and call the associated RESTful API maintained by the easyrec team or download easyrec and call the API on one of your servers.

For additional information, take a look at the [easyrec website](http://easyrec.org).

#### Use easyrec with the server maintained by the team
This is the ready-to-go solution. You may want to use this if you don't want to configure another server dedicated to easyrec.

- Create a easyrec account: http://easyrec.org/register
- Open up your mailbox and activate your account
- Create a new Tenant in your dashboard
- Fill your API key and your Tenant ID in the configuration file

#### Configure your own easyrec server
Take a look at the [easyrec installation guide](http://easyrec.sourceforge.net/wiki/index.php?title=Installation_Guide).

## Installation

[PHP](https://php.net) 5.4+ or [HHVM](http://hhvm.com) 3.3+, and [Composer](https://getcomposer.org) are required.

To get the latest version of Easyrec PHP, simply add the following line to the require block of your `composer.json` file:

```
"hafael/easyrec-php": "~1.0"
```