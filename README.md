## PHP UUID Version 4 Generator

A simple and lightweight class to create and validate uuid version 4 in PHP.

### Requirements

- PHP 7.0 or higher
- Composer for installation

### Installation
composer require hraw/uuid

### Implementation

```php
<?php

require_once __DIR__.'/vendor/autoload.php';

use Hraw\Uuid\UuidV4;

//Generating a version 4 uuid.
echo UuidV4::get();
//Output -> 42ebbe3f-f47e-43d6-b2b2-3b19f5fa6a20

//Validating a version 4 uuid.
UuidV4::validate('42ebbe3f-f47e-43d6-b2b2-3b19f5fa6a20');
//Output -> true/false
```

## Run Dev Server
php -S localhost:8000

## Other Frameworks
If you want to integrate it into any other composer based framework/project then simple install it via composer and follow the implementation section.