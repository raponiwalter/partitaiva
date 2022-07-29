<?php
/**
 * Unit test PartitaivaTest.php
 * 
 * @author Walter Raponi <walter.raponi@gmail.com>
 * 
 */

use PHPUnit\Framework\TestCase;
use Wraps\Partitaiva;

/**
 * Class PartitaivaTest
 */
class PartitaivaTest extends TestCase
{

    protected $partitaiva;

    public function setUp() : void
    {
        $this->partitaiva = new Partitaiva();
        parent::setUp();
    }

    /**
     * data provider ok
     *
     * @return array
     */
    public function providerOk()
    {
        return [[
            '05091320159',
            '13454210157',
            '05724831002',
            '08450891000',
            '05006900962',
        ]];
    }

    /**
     * data provider ko
     *
     * @return array
     */
    public function providerKo()
    {
        return [[
            [],
            null,
            false,
            true,
            1,
            120003,
            7777777777,
            'abc-dddd-dddd',
            (new \stdClass()),
        ]];
    }

    /**
     * @dataProvider providerOk
     */
    public function testCheckSyntaxPartitaivaOk($piva)
    {
        $this->assertTrue($this->partitaiva->checkSyntaxPartitaiva($piva));
    }

    /**
     * @dataProvider providerKo
     */
    public function testCheckSyntaxPartitaivaKo($piva)
    {
        $this->assertFalse($this->partitaiva->checkSyntaxPartitaiva($piva));
    }

    /**
     * @dataProvider providerOk
     */
    public function testIsPartitaivaOk($piva)
    {
        $this->assertTrue($this->partitaiva->isPartitaiva($piva));
    }

    /**
     * @dataProvider providerKo
     */
    public function testIsPartitaivaKo($piva)
    {
        $this->assertFalse($this->partitaiva->isPartitaiva($piva));
    }

    public function tearDown() : void
    {
        unset($this->partitaiva);
        parent::tearDown();
    }
}