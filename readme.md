## pureftp-client

### Installation

- Add lextira/pureftpd-client repo to composer.json
```
"repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/lextira/pureftpd-client"
        }
    ],
```

- Run
```
composer require lextira/pureftpd-client
```
- Set environment variables LEXTIRA_PUREFTPD_HOST and LEXTIRA_PUREFTPD_AUTH_KEY for configuration

### Usage

- Register PureFTPdServiceProvider

```
<?php
namespace App\Services\Backend\Providers;

...
use Lextira\PureFTPdClient\Providers\PureFTPdServiceProvider;

/**
 * Class BackendServiceProvider
 * @package App\Services\Backend\Providers
 */
class BackendServiceProvider extends ServiceProvider
{
    ...

    /**
    * Register the Backend service provider.
    *
    * @return void
    */
    public function register()
    {
        ...
        
        $this->app->register(PureFTPdServiceProvider::class);
    }
}

```

- Inject PureFTPdClient wherever you want

```
<?php
namespace App\Domains\FTP\Jobs;

use Illuminate\Http\Request;
use Lextira\PureFTPdClient\Services\PureFTPdClient;
use Lucid\Foundation\Job;

class GetAccountsJob extends Job {
    public function handle(PureFTPdClient $ftpClient, Request $request)
    {
        return $ftpClient->accounts()->getPage($request->input('page', 1));
    }
}
```

### Available methods

```
<?php
$ftpClient->accounts()->get($id);

$ftpClient->accounts()->getPage($pageNumber);

$ftpClient->accounts()->create([
   'login' => 'my_login,
   'password' => 'pass',
   'relative_dir' => 'dir',
   'description' => 'desc',
]);

$ftpClient->accounts()->update($id, [
   'login' => 'my_login,
   'password' => 'pass',
   'relative_dir' => 'dir',
   'description' => 'desc',
]);

$ftpClient->domains()->getPage($pageNumber);

$ftpClient->health()->check();
```