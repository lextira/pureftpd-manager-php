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

/*
stdClass Object
(
    [data] => stdClass Object
        (
            [id] => 1
            [domain_id] => 1
            [relative_dir] => /
            [description] => 
            [login] => abc@lexgate.ch
            [status] => 1
            [created_at] => 2018-10-26 15:10:37
            [updated_at] => 2018-10-26 15:10:37
        )

    [status] => 200
)
*/

$ftpClient->accounts()->getPage($pageNumber);

/*
stdClass Object
(
    [data] => stdClass Object
        (
            [current_page] => 1
            [data] => Array
                (
                    [0] => stdClass Object
                        (
                            [id] => 1
                            [domain_id] => 1
                            [relative_dir] => /
                            [description] => 
                            [login] => abc@lexgate.ch
                            [status] => 1
                            [created_at] => 2018-10-26 15:10:37
                            [updated_at] => 2018-10-26 15:10:37
                        )

                )

            [first_page_url] => http://development.lexfile.ch/api/v1/accounts?page=1
            [from] => 1
            [last_page] => 1
            [last_page_url] => http://development.lexfile.ch/api/v1/accounts?page=1
            [next_page_url] => 
            [path] => http://development.lexfile.ch/api/v1/accounts
            [per_page] => 15
            [prev_page_url] => 
            [to] => 1
            [total] => 1
        )

    [status] => 200
)
*/

$ftpClient->accounts()->create([
   'login' => 'my_login',
   'password' => 'pass',
   'relative_dir' => 'dir',
   'description' => 'desc',
]);

/*
stdClass Object
(
    [data] => stdClass Object
        (
            [domain_id] => 1
            [login] => my_login@lexgate.ch
            [status] => 1
            [relative_dir] => dir
            [description] => desc
            [updated_at] => 2018-10-30 11:33:41
            [created_at] => 2018-10-30 11:33:41
            [id] => 2
            [domain] => stdClass Object
                (
                    [id] => 1
                    [name] => lexgate.ch
                    [created_at] => 2018-10-26 15:07:15
                    [updated_at] => 2018-10-26 15:07:15
                )

        )

    [status] => 200
)
*/


$ftpClient->accounts()->update($id, [
   'login' => 'my_login,
   'password' => 'pass',
   'relative_dir' => 'dir',
   'description' => 'desc',
]);

/*
stdClass Object
(
    [data] => stdClass Object
        (
            [id] => 2
            [domain_id] => 1
            [relative_dir] => dir1
            [description] => desc
            [login] => my_login@lexgate.ch
            [status] => 1
            [created_at] => 2018-10-30 11:33:41
            [updated_at] => 2018-10-30 11:34:35
            [domain] => stdClass Object
                (
                    [id] => 1
                    [name] => lexgate.ch
                    [created_at] => 2018-10-26 15:07:15
                    [updated_at] => 2018-10-26 15:07:15
                )

        )

    [status] => 200
)
*/

$ftpClient->domains()->getPage($pageNumber);

/*
stdClass Object
(
    [data] => stdClass Object
        (
            [current_page] => 1
            [data] => Array
                (
                    [0] => stdClass Object
                        (
                            [id] => 1
                            [name] => lexgate.ch
                            [created_at] => 2018-10-26 15:07:15
                            [updated_at] => 2018-10-26 15:07:15
                        )

                )

            [first_page_url] => http://development.lexfile.ch/api/v1/domains?page=1
            [from] => 1
            [last_page] => 1
            [last_page_url] => http://development.lexfile.ch/api/v1/domains?page=1
            [next_page_url] => 
            [path] => http://development.lexfile.ch/api/v1/domains
            [per_page] => 15
            [prev_page_url] => 
            [to] => 1
            [total] => 1
        )

    [status] => 200
)
*/

$ftpClient->health()->check();

/*
stdClass Object
(
    [data] => stdClass Object
        (
            [db_status] => OK
            [ftp_status] => OK
            [ssl_status] => OK
        )

    [status] => 200
)
*/

```