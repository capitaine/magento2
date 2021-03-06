<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @copyright   Copyright (c) 2013 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Magento_Config_Dom_Converter_ArrayConverterTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Magento_Config_Dom_Converter_ArrayConverter
     */
    protected $_model;

    /**
     * Path to fixtures
     *
     * @var string
     */
    protected $_fixturePath;

    protected function setUp()
    {
        $this->_model = new Magento_Config_Dom_Converter_ArrayConverter();
        $this->_fixturePath = realpath(__DIR__ . '/../../')
            . DIRECTORY_SEPARATOR . '_files'
            . DIRECTORY_SEPARATOR . 'dom'
            . DIRECTORY_SEPARATOR . 'converter'
            . DIRECTORY_SEPARATOR;
    }

    /**
     * @param string $xml
     * @param string $array
     *
     * @dataProvider convertDataProvider
     */
    public function testConvert($xml, $array)
    {
        $xmlPath = $this->_fixturePath . $xml;
        $expected = require ($this->_fixturePath . $array);

        $dom = new DOMDocument();
        $dom->load($xmlPath);

        $actual = $this->_model->convert($dom->childNodes);
        $this->assertEquals($expected, $actual);
    }

    public function convertDataProvider()
    {
        return array(
            'no attributes'   => array('no_attributes.xml', 'no_attributes.php'),
            'with attributes' => array('with_attributes.xml', 'with_attributes.php'),
            'cdata' => array('cdata.xml', 'cdata.php'),
        );
    }
}
