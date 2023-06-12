<?php

namespace App\WP;

use Composer\Installer\PackageEvent;

class Plugin
{
    public static function enable(PackageEvent $e){
        $io = $e->getIO();
        $package = $e->getOperation()->getPackage()->getName();

        if (0 === strpos($package, "wpackagist-plugin")) {
            $plugin = preg_replace('/[a-zA-Z0-9-_]+\\/([a-zA-Z0-9-_]+)/', '$1', $package);

            exec("wp core is-installed > /dev/null 2>&1", $output, $code);

            if ($code === 0) {
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
        $package = $e->getOperation()->getPackage()->getName();

        if (0 === strpos($package, "wpackagist-plugin")) {
            $plugin = preg_replace('/[a-zA-Z0-9-_]+\\/([a-zA-Z0-9-_]+)/', '$1', $package);

            exec("wp core is-installed > /dev/null 2>&1", $output, $code);

            if ($code === 0) {
                $io->write("  - Disabling Plugin '$plugin'.");
                exec("wp plugin deactivate $plugin --quiet", $output);

                foreach($output as $line){
                    $io->write('      ' . $line);
                }
            }
        }
    }
}
