<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $email;
    public $rememberMe = true;
    public $city_id;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['email', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            ['city_id', 'integer'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUserByEmailAndCityId();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUserByEmailAndCityId(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        
        return false;
    }

    public function loginAdmin(){

        return Yii::$app->user->login($this->getUserByEmailAndRole(), $this->rememberMe ? 3600 * 24 * 30 : 0);

    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUserByEmail()
    {
        if ($this->_user === null) {
            $this->_user = User::findByEmail($this->email);
        }

        return $this->_user;
    }
    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUserByEmailAndCityId()
    {
        if ($this->_user === null) {
            $this->_user = User::findByEmailAndCityId($this->email, $this->city_id);
        }

        //dd($this->_user);

        return $this->_user;
    }



    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUserByEmailAndRole()
    {
        if ($this->_user === null) {
            $this->_user = User::findByEmailAndRole($this->email, 'admin');
        }

        return $this->_user;
    }
}
