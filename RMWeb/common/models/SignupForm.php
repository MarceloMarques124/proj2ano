<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    public $name;
    public $address;
    public $door_number;
    public $postal_code;
    public $nif;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],

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
            ['nif', 'unique', 'targetClass' => '\common\models\UserInfo', 'message' => 'This nif address has already been taken.'],
            ['nif', 'match', 'pattern' => '/\b\d{9}\b/'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->status = 10;
        $user->save() && $this->sendEmail($user);

        // the following three lines were added:
        $auth = \Yii::$app->authManager;
        $role_client = $auth->getRole('client');
        $auth->assign($role_client, $user->getId());

        $user_info = new UserInfo();
        $user_info->user_id = $user->id;
        $user_info->name = $this->name;
        $user_info->address = $this->address;
        $user_info->door_number = $this->door_number;
        $user_info->postal_code = $this->postal_code;
        $user_info->nif = $this->nif;
        $user_info->save();


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
}
