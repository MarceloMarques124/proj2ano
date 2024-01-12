<?php


namespace frontend\tests\Functional;

use Yii;
use common\models\User;
use common\models\Zone;
use common\models\Table;
use common\models\Restaurant;
use common\fixtures\UserFixture;
use frontend\tests\FunctionalTester;

class reservesCest
{
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'login_data.php'
            ]
        ];
    }

    protected $restaurantId;
    protected $tableId;
    protected $zoneId;


    public function _before(FunctionalTester $I)
    {
        $authManager = \Yii::$app->authManager;
        //$authManager->assign($authManager->getRole('admin'), User::findOne(['username' => 'test.test'])->id);
        // Criar um restaurante no _before() e armazenar o ID
        $restaurant = new Restaurant();
        $restaurant->name = 'Test Restaurant';
        $restaurant->address = 'Test';
        $restaurant->nif = 123321123;
        $restaurant->email = 'Test@rest.com';
        $restaurant->mobile_number = '321123321';
        $restaurant->save();
        $this->restaurantId = $restaurant->id;

        $table = new Table();
        $table->description = 'table teste';
        $table->capacity = 4;
        $table->save();
        $this->tableId = $table->id;


        $zone = new Zone();
        $zone->name = 'zona 1';
        $zone->capacity = '4';
        $zone->restaurant_id = $this->restaurantId;
        $zone->save();
        $this->zoneId = $zone->id;


        $I->amOnPage('/site/index');
    }

    public function createReserve(FunctionalTester $I)
    {
        /*          //Realizar login e adicionar artigo ao carrinho
        $I->amLoggedInAs(User::findByUsername('erau')); */
        $I->see('Login');
        $I->Click('Login');
        $I->see('Sign Up');
        $I->submitForm('#login-form', ['LoginForm[username]' => 'test.test', 'LoginForm[password]' => 'Test1234']);
        $I->amOnPage('reservation/create');

        $I->amOnPage('/reservation/create');

        // Preencha os campos do formulário conforme necessário
        $I->fillField('Reservation[date_time]', '2024-01-01 12:00:00'); // Substitua com a data e hora desejadas
        $I->selectOption('select[name="Reservation[zone_id]"]', (string)$this->zoneId); // Use um método para gerar dados dinâmico
        $I->fillField('Reservation[people_number]', '5'); // Substitua com o número desejado
        $I->fillField('Reservation[remarks]', 'Teste de reserva'); // Substitua com os comentários desejados

        // Envie o formulário
        $I->click('Save');

        $I->see('AAAA');
    }

}
