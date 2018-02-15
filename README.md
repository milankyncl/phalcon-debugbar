# Phalcon Debugbar

[![Latest Stable Version](https://poser.pugx.org/milankyncl/phalcon-debugbar/v/stable)](https://packagist.org/packages/milankyncl/phalcon-debugbar)
[![Total Downloads](https://poser.pugx.org/milankyncl/phalcon-debugbar/downloads)](https://packagist.org/packages/milankyncl/phalcon-debugbar)
[![Latest Unstable Version](https://poser.pugx.org/milankyncl/phalcon-debugbar/v/unstable)](https://packagist.org/packages/milankyncl/phalcon-debugbar)
[![License](https://poser.pugx.org/milankyncl/phalcon-debugbar/license)](https://packagist.org/packages/milankyncl/phalcon-debugbar)

Phalcon Debugbar for PHP Phalcon 3.x.x. You can view 4 standard panels right now - execution timer, view renderering status, database profiler and router result. You can optionally enable specific remote addresses, so you can view debugbar even in production mode.

## Installation

1. Include packagist repository into your project.

```
composer require milankyncl/phalcon-debugbar
```

2. Include this snippet into your bootstrap file, just before creating Application instance. Enable specific remote addresses.

```php
$phalconDebugbar = new \MilanKyncl\Debugbar\PhalconDebugbar();

// Your remote addresses or just bool (true|false)
$phalconDebugbar->setDebugMode([
	'127.0.0.1', '::1'
]);

// listen to services
$phalconDebugbar->listen();
```

3. That's the magic!

Enjoy.
