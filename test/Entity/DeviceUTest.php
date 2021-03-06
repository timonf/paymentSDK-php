<?php
/**
 * Shop System SDK - Terms of Use
 *
 * The SDK offered are provided free of charge by Wirecard AG and are explicitly not part
 * of the Wirecard AG range of products and services.
 *
 * They have been tested and approved for full functionality in the standard configuration
 * (status on delivery) of the corresponding shop system. They are under General Public
 * License Version 3 (GPLv3) and can be used, developed and passed on to third parties under
 * the same terms.
 *
 * However, Wirecard AG does not provide any guarantee or accept any liability for any errors
 * occurring when used in an enhanced, customized shop system configuration.
 *
 * Operation in an enhanced, customized configuration is at your own risk and requires a
 * comprehensive test phase by the user of the plugin.
 *
 * Customers use the SDK at their own risk. Wirecard AG does not guarantee their full
 * functionality neither does Wirecard AG assume liability for any disadvantages related to
 * the use of the SDK. Additionally, Wirecard AG does not guarantee the full functionality
 * for customized shop systems or installed SDK of other vendors of plugins within the same
 * shop system.
 *
 * Customers are responsible for testing the SDK's functionality before starting productive
 * operation.
 *
 * By installing the SDK into the shop system the customer agrees to these terms of use.
 * Please do not use the SDK if you do not agree to these terms of use!
 */

namespace WirecardTest\PaymentSdk\Entity;

use Wirecard\PaymentSdk\Entity\Device;

class DeviceUTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Device
     */
    private $device;

    public function setUp()
    {
        $this->device = new Device();
    }

    public function testGetMappedPropertiesFingerprint()
    {
        $fingerprint = 'ABCD1234EFG';
        $this->device->setFingerprint($fingerprint);

        $this->assertEquals(
            [
                'fingerprint' => $fingerprint
            ],
            $this->device->mappedProperties()
        );
    }

    public function testGetFingerprint()
    {
        $fingerprint = 'ABCD1234EFG';
        $this->device->setFingerprint($fingerprint);

        $this->assertEquals($fingerprint, $this->device->getFingerprint());
    }

    public function testConstructor()
    {
        $device = new Device();
        $this->assertEmpty($device->getType());
        $this->assertEmpty($device->getOperatingSystem());
    }

    public function testConstructorWithUserAgentStringDesktopLinux()
    {
        $device = new Device('User-Agent: Mozilla/5.0 (X11; U; Linux i686; xx; rv:1.9.1.9) ' .
            'Gecko/20100330 Fedora/3.5.9-2.fc12 Firefox/3.5.9');
        $this->assertEquals('pc', $device->getType());
        $this->assertEquals('other', $device->getOperatingSystem());
    }

    public function testConstructorWithUserAgentStringDesktopWindows()
    {
        $device = new Device('User-Agent: Mozilla/5.0 (Windows; U; Windows NT 6.1; xx; rv:1.8.1.22pre) ' .
            'Gecko/20090330 BonEcho/2.0.0.22pre');
        $this->assertEquals('pc', $device->getType());
        $this->assertEquals('windows', $device->getOperatingSystem());
    }

    public function testConstructorWithUserAgentStringTabletIOS()
    {
        $device = new Device('User-Agent: Mozilla/5.0 (iPad; U; CPU OS 4_3_3 like Mac OS X; xx) AppleWebKit/534.46.0 ' .
            '(KHTML, like Gecko) CriOS/21.0.1180.82 Mobile/8J2 Safari/7534.48.3 ' .
            '(841B1A38-329C-4D7B-9F54-FB50CC35E37D)');
        $this->assertEquals('tablet', $device->getType());
        $this->assertEquals('ios', $device->getOperatingSystem());
    }

    public function testConstructorWithUserAgentStringMobileIOS()
    {
        $device = new Device('User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 9_0_1 like Mac OS X) AppleWebKit/600.' .
            '1.4 (KHTML, like Gecko) CriOS/43.0.2357.56 Mobile/13A404 Safari/600.1.4');
        $this->assertEquals('mobile', $device->getType());
        $this->assertEquals('ios', $device->getOperatingSystem());
    }

    public function testConstructorWithUserAgentStringMobileAndroid()
    {
        $device = new Device('User-Agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 6P Build/MDB08L) AppleWebKit/537.36 ' .
            '(KHTML, like Gecko) Chrome/47.0.2526.69 Mobile Safari/537.36');
        $this->assertEquals('mobile', $device->getType());
        $this->assertEquals('android', $device->getOperatingSystem());
    }

    public function testConstructorWithUserAgentStringTabletAndroid()
    {
        $device = new Device('User-Agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 7 Build/MDB08M) AppleWebKit/537.36 ' .
            '(KHTML, like Gecko) Chrome/48.0.2564.8 Safari/537.36');
        $this->assertEquals('tablet', $device->getType());
        $this->assertEquals('android', $device->getOperatingSystem());
    }

    public function testConstructorWithUserAgentStringOtherOther()
    {
        $device = new Device('User-Agent: Mozilla/5.0 (Linux; U; Linux 2.6.32; xx;) AppleWebKit/534(KHTML, like ' .
            'Gecko) NX/2.1 (DTV; HTML; R1.0;) InettvBrowser/2.2 (38E08E;0014GAIAV3;001;000) Hybridcast/1.0 ' .
            '(;38E08E;0014GAIAV3;001;000;)');
        $this->assertEquals('other', $device->getType());
        $this->assertEquals('other', $device->getOperatingSystem());
    }

    public function testConstructorWithUserAgentStringWindowsMobile()
    {
        $device = new Device('User-Agent: Mozilla/5.0 (Windows Phone 10.0; Android 4.2.1; NOKIA; Lumia 925) ' .
            'AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Mobile Safari/537.36 Edge/12.0');
        $this->assertEquals('mobile', $device->getType());
        $this->assertEquals('windows-mobile', $device->getOperatingSystem());
    }

    public function testConstructorWithUserAgentStringUnknown()
    {
        $device = new Device('User-Agent: Mozilla/5.0 (XXX');
        $this->assertNull($device->getType());
        $this->assertNull($device->getOperatingSystem());
    }
}
