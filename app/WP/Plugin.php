<?php

namespace App\WP;

use Composer\Script\Event;
use Composer\Installer\PackageEvent;
use Composer\Package\PackageInterface;
use Composer\DependencyResolver\Operation\UpdateOperation;
use Composer\DependencyResolver\Operation\OperationInterface;

class Plugin
{
    public static function enableAll(Event $e) {
        if (static::isWpCliInstalled()) {
            $io = $e->getIO();
            $composer = json_decode(file_get_contents(dirname(__DIR__, 2) . '/composer.json'), true, 512, JSON_THROW_ON_ERROR);
            $packages = array_keys($composer['require']);

            foreach ($packages as $package) {
                if (0 === strpos($package, "wpackagist-plugin")) {
                    $plugin = static::getPluginName($package);

                    $io->write("  - Enabling Plugin '$plugin'.");
                    exec("wp plugin activate $plugin", $output);

                    foreach($output as $line){
                        $io->write('      ' . $line);
                    }
                }
            }
        }
    }

    public static function enable(PackageEvent $e) {
        $io = $e->getIO();
        $package = static::getPackage($e->getOperation());

        if ($package->getType() === 'wordpress-plugin') {
            $plugin = static::getPluginName($package->getName());

            if (static::isWpCliInstalled()) {
                $io->write("  - Enabling Plugin '$plugin'.");
                exec("wp plugin activate $plugin", $output);

                foreach($output as $line){
                    $io->write('      ' . $line);
                }
            } else {
                $io->write('    wp-cli is not installed, please enable the ' . $plugin  . ' plugin manually.');
            }
        }
    }

    public static function disable(PackageEvent $e) {
        $io = $e->getIO();
        $package = static::getPackage($e->getOperation());

        if ($package->getType() === 'wordpress-plugin') {
            $plugin = static::getPluginName($package->getName());

            if (static::isWpCliInstalled()) {
                $io->write("  - Disabling Plugin '$plugin'.");
                exec("wp plugin uninstall $plugin --deactivate --skip-delete", $output);

                foreach($output as $line){
                    $io->write('      ' . $line);
                }
            } else {
                $io->write('    wp-cli is not installed.');
                $io->write('    The ' . $plugin  . ' plugin was likely not uninstalled properly, please consider reinstalling it and manually running `wp plugin disable` and `wp plugin uninstall --skip-delete` before removing this plugin through composer.');
            }
        }
    }

    /**
     * Check if wp-cli is installed.
     *
     * @return bool
     */
    protected static function isWpCliInstalled() {
        exec("wp core is-installed > /dev/null 2>&1", $output, $code);

        return $code === 0;
    }

    /**
     * Get the Package from the Operation.
     *
     * @param  \Composer\DependencyResolver\Operation\OperationInterface  $op
     * @return \Composer\Package\PackageInterface
     */
    protected static function getPackage(OperationInterface $op) {
        if ($op instanceof UpdateOperation) {
            return $op->getInitialPackage();
        }

        return $op->getPackage();
    }

    /**
     * Get the plugin name from the Package name.
     *
     * @param  string  $package
     * @return array|string|string[]|null
     */
    protected static function getPluginName($package) {
        return preg_replace('/[a-zA-Z0-9-_]+\\/([a-zA-Z0-9-_]+)/', '$1', $package);
    }
}
