# Laravel WsOpp [Artisan Command]

## Description

WSDL to Object PHP package generator by artisan

------

### Install

`composer require nekoos/wsopp`

### Usage

```shell script
php artisan wsopp:generate --wsdl uri-contact-wsdl [--namespace NamespaceName] [--target=target-directory]
```

#### Example

```shell script
php artisan wsopp:generate --wsdl http://www.dneonline.com/calculator.asmx?WSDL --namespace Example
```

```php
use App\Service\Soap\Example\Add;

$calculator = new \App\Service\Soap\Example\Calculator();   
$calculator->Add(new Add(3,9))->getAddResult();
```

## Lumen

subscribe service provider in class `app/Console/Kernel.php`

```php
protected $commands = [
    NekoOs\Console\Commands\WsOpp\GenerateCommand::class,
];
```


 