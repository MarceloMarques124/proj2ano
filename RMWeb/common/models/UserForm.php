<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Signup form
 */
class UserForm extends Model
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    public $userId;
    public $userInfoId;
    public $username;
    public $email;
    public $password;

    public $name;
    public $address;
    public $door_number;
    public $postal_code;
    public $nif;
    public $restaurant_id;

    public $role;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            [
                'username', 'unique', 'targetClass' => '\common\models\User',
                'when' => function ($model) {
                    if ($model->userId)
                        return $model->username != $this->getPreviousUser($model->userId)->username;
                    return true;
                }
            ],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            [
                'email', 'unique', 'targetClass' => '\common\models\User',
                'when' => function ($model) {
                    if ($model->userId)
                        return $model->email != $this->getPreviousUser($model->userId)->email;
                    return true;
                }
            ],

            // for user_info
            ['name', 'trim'],
            ['name', 'required'],
            ['name', 'string', 'min' => 2, 'max' => 80],

            ['address', 'trim'],
            ['address', 'required'],
            ['address', 'string', 'max' => 255],

            ['door_number', 'trim'],
            ['door_number', 'required'],
            ['door_number', 'string', 'max' => 5],

            ['postal_code', 'trim'],
            ['postal_code', 'required'],
            ['postal_code', 'string', 'max' => 10],
            ['postal_code', 'match', 'pattern' => '/\b\d{4}\b-\b\d{3}\b/'],

            ['nif', 'trim'],
            ['nif', 'required'],
            ['nif', 'integer'],
            //          ['nif', 'unique', 'targetClass' => '\common\models\UserInfo', 'message' => 'This nif address has already been taken.'],
            ['nif', 'match', 'pattern' => '/\b\d{9}\b/'],

            ['role', 'required'],
            ['restaurant_id', 'integer'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],

        ];
    }

    public static function getPreviousUser($id)
    {
        return User::findIdentity($id);
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function createUser()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->generateEmailVerificationToken();
        $user->status = 10;

        $password = $user->generateRandomPassword();
        $user->password = $password;
        $user->setPassword($password);
        $user->generateAuthKey();

        $user->save() && $this->sendEmail($user);

        $auth = \Yii::$app->authManager;
        $role = $auth->getRole($this->role);
        if ($role)
            $auth->assign($role, $user->id);

        $userInfo = new UserInfo();
        $userInfo->user_id = $user->id;
        $userInfo->name = $this->name;
        $userInfo->address = $this->address;
        $userInfo->door_number = $this->door_number;
        $userInfo->postal_code = $this->postal_code;
        $userInfo->nif = $this->nif;
        $userInfo->restaurant_id = $this->restaurant_id;
        $userInfo->save();
        $this->userId = $user->id;
        $this->userInfoId = $userInfo->id;

        // Armazene uma mensagem na sessão
        $message = 'Usuário criado com sucesso! A senha é: ' . $password;
        Yii::$app->session->setFlash('success', $message);
        return $user;
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }

    public function updateUser()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = User::findOne($this->userId);
        $user->id = $this->userId;
        $user->username = $this->username;
        $user->email = $this->email;


        if ($this->password) {
            $user->setPassword($this->password);
        }

        $user->generateAuthKey();
        $user->generateEmailVerificationToken();

        $auth = Yii::$app->authManager;


        if (!$auth->checkAccess($user->id, $this->role)) {
            $role = $auth->getRole($this->role);

            if ($role)
                $auth->assign($role, $user->id);
        }

        $user->update();

        $userInfo = $user->userInfo;
        $userInfo->name = $this->name;
        $userInfo->address = $this->address;
        $userInfo->door_number = $this->door_number;
        $userInfo->postal_code = $this->postal_code;
        $userInfo->nif = $this->nif;
        $userInfo->restaurant_id = $this->restaurant_id;
        $userInfo->save();

        return $user;
    }
}
