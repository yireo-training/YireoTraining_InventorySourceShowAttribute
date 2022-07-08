# Live tests with PHPUnit

To run these tests, make sure to pass a bootstrap parameter to PHPUnit with similar content like below:

```php
<?php declare(strict_types=1);

use Magento\Framework\App\Bootstrap;

require __DIR__ . '/app/bootstrap.php';

$bootstrap = Bootstrap::create(BP, $_SERVER);
$bootstrap->createApplication(\Magento\Framework\App\Http::class);
```