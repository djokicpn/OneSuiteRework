<?php

declare(strict_types=1);

namespace PackageVersions;

use Composer\InstalledVersions;
use OutOfBoundsException;

class_exists(InstalledVersions::class);

/**
 * This class is generated by composer/package-versions-deprecated, specifically by
 * @see \PackageVersions\Installer
 *
 * This file is overwritten at every run of `composer install` or `composer update`.
 *
 * @deprecated in favor of the Composer\InstalledVersions class provided by Composer 2. Require composer-runtime-api:^2 to ensure it is present.
 */
final class Versions
{
    /**
     * @deprecated please use {@see self::rootPackageName()} instead.
     *             This constant will be removed in version 2.0.0.
     */
    const ROOT_PACKAGE_NAME = 'laravel/laravel';

    /**
     * Array of all available composer packages.
     * Dont read this array from your calling code, but use the \PackageVersions\Versions::getVersion() method instead.
     *
     * @var array<string, string>
     * @internal
     */
    const VERSIONS          = array (
  'asm89/stack-cors' => 'v2.0.1@23f469e81c65e2fb7fc7bce371fbdc363fe32adf',
  'brick/math' => '0.9.1@283a40c901101e66de7061bd359252c013dcc43c',
  'clue/stream-filter' => 'v1.4.1@5a58cc30a8bd6a4eb8f856adf61dd3e013f53f71',
  'composer/package-versions-deprecated' => '1.11.99@c8c9aa8a14cc3d3bec86d0a8c3fa52ea79936855',
  'dnoegel/php-xdg-base-dir' => 'v0.1.1@8f8a6e48c5ecb0f991c2fdcf5f154a47d85f9ffd',
  'doctrine/inflector' => '2.0.3@9cf661f4eb38f7c881cac67c75ea9b00bf97b210',
  'doctrine/lexer' => '1.2.1@e864bbf5904cb8f5bb334f99209b48018522f042',
  'dragonmantank/cron-expression' => 'v2.3.0@72b6fbf76adb3cf5bc0db68559b33d41219aba27',
  'egulias/email-validator' => '2.1.20@f46887bc48db66c7f38f668eb7d6ae54583617ff',
  'fideloper/proxy' => '4.4.0@9beebf48a1c344ed67c1d36bb1b8709db7c3c1a8',
  'fruitcake/laravel-cors' => 'v2.0.2@4b19bfc3bd422948af37a42a62fad7f49025894a',
  'guzzlehttp/guzzle' => '6.5.5@9d4290de1cfd701f38099ef7e183b64b4b7b0c5e',
  'guzzlehttp/promises' => 'v1.3.1@a59da6cf61d80060647ff4d3eb2c03a2bc694646',
  'guzzlehttp/psr7' => '1.6.1@239400de7a173fe9901b9ac7c06497751f00727a',
  'http-interop/http-factory-guzzle' => '1.0.0@34861658efb9899a6618cef03de46e2a52c80fc0',
  'jean85/pretty-package-versions' => '1.5.0@e9f4324e88b8664be386d90cf60fbc202e1f7fc9',
  'laravel/framework' => 'v7.27.0@17777a92da9b3cf0026f26462d289d596420e6d0',
  'laravel/tinker' => 'v2.4.2@58424c24e8aec31c3a3ac54eb3adb15e8a0a067b',
  'laravel/ui' => 'v2.2.0@fb1404f04ece6eee128e3fb750d3a1e064238b33',
  'league/commonmark' => '1.5.4@21819c989e69bab07e933866ad30c7e3f32984ba',
  'league/flysystem' => '1.1.3@9be3b16c877d477357c015cec057548cf9b2a14a',
  'league/mime-type-detection' => '1.4.0@fda190b62b962d96a069fcc414d781db66d65b69',
  'monolog/monolog' => '2.1.1@f9eee5cec93dfb313a38b6b288741e84e53f02d5',
  'nesbot/carbon' => '2.39.1@7af467873250583cc967a59ee9df29fabab193c1',
  'nikic/php-parser' => 'v4.9.1@88e519766fc58bd46b8265561fb79b54e2e00b28',
  'opis/closure' => '3.5.7@4531e53afe2fc660403e76fb7644e95998bff7bf',
  'paragonie/random_compat' => 'v9.99.99@84b4dfb120c6f9b4ff7b3685f9b8f1aa365a0c95',
  'php-http/client-common' => '2.3.0@e37e46c610c87519753135fb893111798c69076a',
  'php-http/discovery' => '1.10.0@88ff14cad4a0db68b343260fa7ac3f1599703660',
  'php-http/guzzle6-adapter' => 'v2.0.1@6074a4b1f4d5c21061b70bab3b8ad484282fe31f',
  'php-http/httplug' => '2.2.0@191a0a1b41ed026b717421931f8d3bd2514ffbf9',
  'php-http/message' => '1.9.0@2c7256e3c1aba0bfca70f099810f1c7712e00945',
  'php-http/message-factory' => 'v1.0.2@a478cb11f66a6ac48d8954216cfed9aa06a501a1',
  'php-http/promise' => '1.1.0@4c4c1f9b7289a2ec57cde7f1e9762a5789506f88',
  'phpoption/phpoption' => '1.7.5@994ecccd8f3283ecf5ac33254543eb0ac946d525',
  'psr/container' => '1.0.0@b7ce3b176482dbbc1245ebf52b181af44c2cf55f',
  'psr/event-dispatcher' => '1.0.0@dbefd12671e8a14ec7f180cab83036ed26714bb0',
  'psr/http-client' => '1.0.1@2dfb5f6c5eff0e91e20e913f8c5452ed95b86621',
  'psr/http-factory' => '1.0.1@12ac7fcd07e5b077433f5f2bee95b3a771bf61be',
  'psr/http-message' => '1.0.1@f6561bf28d520154e4b0ec72be95418abe6d9363',
  'psr/log' => '1.1.3@0f73288fd15629204f9d42b7055f72dacbe811fc',
  'psr/simple-cache' => '1.0.1@408d5eafb83c57f6365a3ca330ff23aa4a5fa39b',
  'psy/psysh' => 'v0.10.4@a8aec1b2981ab66882a01cce36a49b6317dc3560',
  'ralouphie/getallheaders' => '3.0.3@120b605dfeb996808c31b6477290a714d356e822',
  'ramsey/collection' => '1.1.0@044184884e3c803e4cbb6451386cb71562939b18',
  'ramsey/uuid' => '4.1.1@cd4032040a750077205918c86049aa0f43d22947',
  'sentry/sdk' => '2.1.0@18921af9c2777517ef9fb480845c22a98554d6af',
  'sentry/sentry' => '2.4.3@89fd1f91657b33ec9139f33f8a201eb086276103',
  'sentry/sentry-laravel' => '1.9.0@8567e70d03081cbc04e35eb3fa7389d06816196e',
  'swiftmailer/swiftmailer' => 'v6.2.3@149cfdf118b169f7840bbe3ef0d4bc795d1780c9',
  'symfony/console' => 'v5.1.5@186f395b256065ba9b890c0a4e48a91d598fa2cf',
  'symfony/css-selector' => 'v5.1.5@e544e24472d4c97b2d11ade7caacd446727c6bf9',
  'symfony/deprecation-contracts' => 'v2.1.3@5e20b83385a77593259c9f8beb2c43cd03b2ac14',
  'symfony/error-handler' => 'v5.1.5@525636d4b84e06c6ca72d96b6856b5b169416e6a',
  'symfony/event-dispatcher' => 'v5.1.5@94871fc0a69c3c5da57764187724cdce0755899c',
  'symfony/event-dispatcher-contracts' => 'v2.1.3@f6f613d74cfc5a623fc36294d3451eb7fa5a042b',
  'symfony/finder' => 'v5.1.5@2b765f0cf6612b3636e738c0689b29aa63088d5d',
  'symfony/http-foundation' => 'v5.1.5@41a4647f12870e9d41d9a7d72ff0614a27208558',
  'symfony/http-kernel' => 'v5.1.5@3e32676e6cb5d2081c91a56783471ff8a7f7110b',
  'symfony/mime' => 'v5.1.5@89a2c9b4cb7b5aa516cf55f5194c384f444c81dc',
  'symfony/options-resolver' => 'v5.1.5@9ff59517938f88d90b6e65311fef08faa640f681',
  'symfony/polyfill-ctype' => 'v1.18.1@1c302646f6efc070cd46856e600e5e0684d6b454',
  'symfony/polyfill-iconv' => 'v1.18.1@6c2f78eb8f5ab8eaea98f6d414a5915f2e0fce36',
  'symfony/polyfill-intl-grapheme' => 'v1.18.1@b740103edbdcc39602239ee8860f0f45a8eb9aa5',
  'symfony/polyfill-intl-idn' => 'v1.18.1@5dcab1bc7146cf8c1beaa4502a3d9be344334251',
  'symfony/polyfill-intl-normalizer' => 'v1.18.1@37078a8dd4a2a1e9ab0231af7c6cb671b2ed5a7e',
  'symfony/polyfill-mbstring' => 'v1.18.1@a6977d63bf9a0ad4c65cd352709e230876f9904a',
  'symfony/polyfill-php70' => 'v1.18.1@0dd93f2c578bdc9c72697eaa5f1dd25644e618d3',
  'symfony/polyfill-php72' => 'v1.18.1@639447d008615574653fb3bc60d1986d7172eaae',
  'symfony/polyfill-php73' => 'v1.18.1@fffa1a52a023e782cdcc221d781fe1ec8f87fcca',
  'symfony/polyfill-php80' => 'v1.18.1@d87d5766cbf48d72388a9f6b85f280c8ad51f981',
  'symfony/polyfill-uuid' => 'v1.18.1@da48e2cccd323e48c16c26481bf5800f6ab1c49d',
  'symfony/process' => 'v5.1.5@1864216226af21eb76d9477f691e7cbf198e0402',
  'symfony/routing' => 'v5.1.5@47b0218344cb6af25c93ca8ee1137fafbee5005d',
  'symfony/service-contracts' => 'v2.1.3@58c7475e5457c5492c26cc740cc0ad7464be9442',
  'symfony/string' => 'v5.1.5@0de4cc1e18bb596226c06a82e2e7e9bc6001a63a',
  'symfony/translation' => 'v5.1.5@917b02cdc5f33e0309b8e9d33ee1480b20687413',
  'symfony/translation-contracts' => 'v2.1.3@616a9773c853097607cf9dd6577d5b143ffdcd63',
  'symfony/var-dumper' => 'v5.1.5@b43a3905262bcf97b2510f0621f859ca4f5287be',
  'tijsverkoyen/css-to-inline-styles' => '2.2.3@b43b05cf43c1b6d849478965062b6ef73e223bb5',
  'vlucas/phpdotenv' => 'v4.1.8@572af79d913627a9d70374d27a6f5d689a35de32',
  'voku/portable-ascii' => '1.5.3@25bcbf01678930251fd572891447d9e318a6e2b8',
  'doctrine/instantiator' => '1.3.1@f350df0268e904597e3bd9c4685c53e0e333feea',
  'facade/flare-client-php' => '1.3.5@25907a113bfc212a38d458ae365bfb902b4e7fb8',
  'facade/ignition' => '2.3.6@d7d05dba5a0bdbf018a2cb7be268f22f5d73eb81',
  'facade/ignition-contracts' => '1.0.1@aeab1ce8b68b188a43e81758e750151ad7da796b',
  'filp/whoops' => '2.7.3@5d5fe9bb3d656b514d455645b3addc5f7ba7714d',
  'fzaninotto/faker' => 'v1.9.1@fc10d778e4b84d5bd315dad194661e091d307c6f',
  'hamcrest/hamcrest-php' => 'v2.0.1@8c3d0a3f6af734494ad8f6fbbee0ba92422859f3',
  'mockery/mockery' => '1.4.2@20cab678faed06fac225193be281ea0fddb43b93',
  'myclabs/deep-copy' => '1.10.1@969b211f9a51aa1f6c01d1d2aef56d3bd91598e5',
  'nunomaduro/collision' => 'v4.2.0@d50490417eded97be300a92cd7df7badc37a9018',
  'phar-io/manifest' => '1.0.3@7761fcacf03b4d4f16e7ccb606d4879ca431fcf4',
  'phar-io/version' => '2.0.1@45a2ec53a73c70ce41d55cedef9063630abaf1b6',
  'phpdocumentor/reflection-common' => '2.2.0@1d01c49d4ed62f25aa84a747ad35d5a16924662b',
  'phpdocumentor/reflection-docblock' => '5.2.1@d870572532cd70bc3fab58f2e23ad423c8404c44',
  'phpdocumentor/type-resolver' => '1.3.0@e878a14a65245fbe78f8080eba03b47c3b705651',
  'phpspec/prophecy' => '1.11.1@b20034be5efcdab4fb60ca3a29cba2949aead160',
  'phpunit/php-code-coverage' => '7.0.10@f1884187926fbb755a9aaf0b3836ad3165b478bf',
  'phpunit/php-file-iterator' => '2.0.2@050bedf145a257b1ff02746c31894800e5122946',
  'phpunit/php-text-template' => '1.2.1@31f8b717e51d9a2afca6c9f046f5d69fc27c8686',
  'phpunit/php-timer' => '2.1.2@1038454804406b0b5f5f520358e78c1c2f71501e',
  'phpunit/php-token-stream' => '3.1.1@995192df77f63a59e47f025390d2d1fdf8f425ff',
  'phpunit/phpunit' => '8.5.8@34c18baa6a44f1d1fbf0338907139e9dce95b997',
  'scrivo/highlight.php' => 'v9.18.1.2@efb6e445494a9458aa59b0af5edfa4bdcc6809d9',
  'sebastian/code-unit-reverse-lookup' => '1.0.1@4419fcdb5eabb9caa61a27c7a1db532a6b55dd18',
  'sebastian/comparator' => '3.0.2@5de4fc177adf9bce8df98d8d141a7559d7ccf6da',
  'sebastian/diff' => '3.0.2@720fcc7e9b5cf384ea68d9d930d480907a0c1a29',
  'sebastian/environment' => '4.2.3@464c90d7bdf5ad4e8a6aea15c091fec0603d4368',
  'sebastian/exporter' => '3.1.2@68609e1261d215ea5b21b7987539cbfbe156ec3e',
  'sebastian/global-state' => '3.0.0@edf8a461cf1d4005f19fb0b6b8b95a9f7fa0adc4',
  'sebastian/object-enumerator' => '3.0.3@7cfd9e65d11ffb5af41198476395774d4c8a84c5',
  'sebastian/object-reflector' => '1.1.1@773f97c67f28de00d397be301821b06708fca0be',
  'sebastian/recursion-context' => '3.0.0@5b0cd723502bac3b006cbf3dbf7a1e3fcefe4fa8',
  'sebastian/resource-operations' => '2.0.1@4d7a795d35b889bf80a0cc04e08d77cedfa917a9',
  'sebastian/type' => '1.1.3@3aaaa15fa71d27650d62a948be022fe3b48541a3',
  'sebastian/version' => '2.0.1@99732be0ddb3361e16ad77b68ba41efc8e979019',
  'theseer/tokenizer' => '1.2.0@75a63c33a8577608444246075ea0af0d052e452a',
  'webmozart/assert' => '1.9.1@bafc69caeb4d49c39fd0779086c03a3738cbb389',
  'laravel/laravel' => 'No version set (parsed as 1.0.0)@',
);

    private function __construct()
    {
    }

    /**
     * @psalm-pure
     *
     * @psalm-suppress ImpureMethodCall we know that {@see InstalledVersions} interaction does not
     *                                  cause any side effects here.
     */
    public static function rootPackageName() : string
    {
        if (!class_exists(InstalledVersions::class, false) || !InstalledVersions::getRawData()) {
            return self::ROOT_PACKAGE_NAME;
        }

        return InstalledVersions::getRootPackage()['name'];
    }

    /**
     * @throws OutOfBoundsException If a version cannot be located.
     *
     * @psalm-param key-of<self::VERSIONS> $packageName
     * @psalm-pure
     *
     * @psalm-suppress ImpureMethodCall we know that {@see InstalledVersions} interaction does not
     *                                  cause any side effects here.
     */
    public static function getVersion(string $packageName): string
    {
        if (class_exists(InstalledVersions::class, false) && InstalledVersions::getRawData()) {
            return InstalledVersions::getPrettyVersion($packageName)
                . '@' . InstalledVersions::getReference($packageName);
        }

        if (isset(self::VERSIONS[$packageName])) {
            return self::VERSIONS[$packageName];
        }

        throw new OutOfBoundsException(
            'Required package "' . $packageName . '" is not installed: check your ./vendor/composer/installed.json and/or ./composer.lock files'
        );
    }
}
