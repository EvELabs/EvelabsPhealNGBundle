<?php
namespace Evelabs\PhealNGBundle\Pheal;

use Pheal\Pheal;
use Pheal\Core\Config;
use Pheal\Access\StaticCheck;
use Pheal\Cache\HashedNameFileStorage;
use Pheal\RateLimiter\FileLockRateLimiter;
use Pheal\Log\PsrLogger;
use Psr\Log\LoggerInterface;

class PhealFactory
{

    public function configurePheal(array $bundle_config){

        $config = Config::getInstance();
        if (!is_dir($bundle_config['cache_dir'])) {
            if (false === @mkdir($bundle_config['cache_dir'], 0777, true)) {
                throw new \RuntimeException(sprintf(
                        'Could not create cache directory "%s".',
                        $bundle_config['cache_dir'])
                );
            }
        }

        $config->cache               = new HashedNameFileStorage($bundle_config['cache_dir']);
        $config->access              = new StaticCheck();
        $config->rateLimiter         = new FileLockRateLimiter($bundle_config['cache_dir']);
        $config->log                 = new PsrLogger($bundle_config['logger']);
        $config->http_user_agent     = $bundle_config['user_agent'];
        $config->http_ssl_verifypeer = $bundle_config['verify_peer'];
    }

    public function getPheal($keyId = null, $vCode = null, $scope = 'account'){
        return new Pheal($keyId, $vCode, $scope);
    }
}