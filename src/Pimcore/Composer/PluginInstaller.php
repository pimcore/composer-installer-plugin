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
		$pluginNameParts = explode("/",$package->getPrettyName());
		$pluginName = ucfirst($pluginNameParts[1]); 
		$pluginName = preg_replace_callback("/\-[a-z]/", function ($matches) {
            $replacement = str_replace("-","",$matches[0]);
            return strtoupper($replacement);
        }, $pluginName);
		
		
		$docRootName = "./"; 
		if($configDocRoot = $this->composer->getConfig()->get("document-root-path")) {
			$docRootName = rtrim($configDocRoot,"/");
		}
		
        return $docRootName . '/plugins/' . $pluginName . "/";
    }

    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
        return 'pimcore-plugin' === $packageType;
    }
}
