<?php
namespace Lextira\PureFTPdClient\Providers;

use Illuminate\Support\ServiceProvider;

class PureFTPdServiceProvider extends ServiceProvider {
    const CONFIG_PREFIX = 'lextira_pureftpd';

    public function boot()
    {
        $this->publishes([
            $this->getConfigPath() => config_path(self::CONFIG_PREFIX . '.php'),
        ]);

        $this->loadTranslationsFrom(dirname(__DIR__) . '/translations', self::CONFIG_PREFIX);
    }

    public function register()
    {
        $this->mergeConfigFrom($this->getConfigPath(), self::CONFIG_PREFIX);
    }

    protected function getConfigPath()
    {
        return dirname(__DIR__) . '/config/' . self::CONFIG_PREFIX . '.php';
    }
}