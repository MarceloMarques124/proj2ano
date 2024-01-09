<?php


namespace backend\tests\Unit;

use common\models\Table;
use backend\tests\UnitTester;

class tableTest extends \Codeception\Test\Unit
{

    protected UnitTester $tester;
    protected $tableId;


    protected function _before()
    {
        $table = new Table();
        $table->description = 'table teste';
        $table->capacity = 4;
        $this->assertTrue($table->save());
        $this->tableId = $table->id;
    }

    public function testSaveTable()
    {
        $table = new Table();
        $table->description = 'table 1';
        $table->capacity = 4;
        $this->assertTrue($table->save());

        // Ensure the record is saved in the database
        $dbTable = Table::findOne($table->id);
        $this->assertNotNull($dbTable);
        $this->assertEquals('table 1', $dbTable->description);
        $this->assertEquals(4, $dbTable->capacity);
    }

    public function testFindTableById()
    {
        $table = Table::findOne($this->tableId);

        $this->assertInstanceOf(Table::class, $table);
        $this->assertEquals('table teste', $table->description);
        $this->assertEquals(4, $table->capacity);
    }

    
    public function testCreateTableWrongInfo()
    {
        $table = new Table();
        $table->description = 191991;
        $table->capacity = 'wrong capacity';
        $this->assertFalse($table->save());
    }
    
}
