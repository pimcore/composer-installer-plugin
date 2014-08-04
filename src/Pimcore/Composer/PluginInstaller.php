<?php 

namespace Pimcore\Composer;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;

class PluginInstaller extends LibraryInstaller
{
    /**
     * {@inheritDoc}
     */
    public function getInstallPath(PackageInterface $package)
    {
		$pluginName = ucfirst($package->getName()); 
		$pluginName = preg_replace_callback("/\-[a-z]/", function ($matches) {
            $replacement = str_replace("-","",$matches[0]);
            return strtoupper($replacement);
        }, $pluginName);
		
        return './www/plugins/' . $pluginName . "/";
    }

    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
        return 'pimcore-plugin' === $packageType;
    }
}
