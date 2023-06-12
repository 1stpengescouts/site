<?php

namespace App\WP;

use Composer\Installer\PackageEvent;

class Plugin
{
    public static function enableAll(Event $e) {
        exec("wp core is-installed > /dev/null 2>&1", $output, $code);

        if ($code === 0) {
            $io = $e->getIO();
            $composer = json_decode(file_get_contents(dirname(__DIR__, 2) . '/composer.json'), true, 512, JSON_THROW_ON_ERROR);
            $packages = array_keys($composer['require']);

            foreach ($packages as $package) {
                if (0 === strpos($package, "wpackagist-plugin")) {
                    $plugin = preg_replace('/[a-zA-Z0-9-_]+\\/([a-zA-Z0-9-_]+)/', '$1', $package);

                    $io->write("  - Enabling Plugin '$plugin'.");
                    exec("wp plugin activate $plugin", $output);

                    foreach($output as $line){
                        $io->write('      ' . $line);
                    }
                }
            }
        }
    }

    public static function enable(PackageEvent $e){
        $io = $e->getIO();
        $package = $e->getOperation()->getPackage();

        if ($package->getType() === 'wordpress-plugin') {
            exec("wp core is-installed > /dev/null 2>&1", $output, $code);

            if ($code === 0) {
                $plugin = preg_replace('/[a-zA-Z0-9-_]+\\/([a-zA-Z0-9-_]+)/', '$1', $package->getName());

                $io->write("  - Enabling Plugin '$plugin'.");
                exec("wp plugin activate $plugin", $output);

                foreach($output as $line){
                    $io->write('      ' . $line);
                }
            }
        }
    }

    public static function disable(PackageEvent $e){
        $io = $e->getIO();
        $package = $e->getOperation()->getPackage();

        if ($package->getType() === 'wordpress-plugin') {
            exec("wp core is-installed > /dev/null 2>&1", $output, $code);

            if ($code === 0) {
                $plugin = preg_replace('/[a-zA-Z0-9-_]+\\/([a-zA-Z0-9-_]+)/', '$1', $package->getName());

                $io->write("  - Disabling Plugin '$plugin'.");
                exec("wp plugin deactivate $plugin --quiet", $output);

                foreach($output as $line){
                    $io->write('      ' . $line);
                }
            }
        }
    }
}
