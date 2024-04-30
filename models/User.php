<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $name
 * @property string $username
 * @property string|null $email
 * @property int $level
 * @property string $password
 * @property string $authKey
 * @property string $accessToken
 * @property string $created_at
 * @property string|null $updated_at
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'username', 'password'], 'required'],
            [['level'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'password'], 'string', 'max' => 100],
            [['username', 'email'], 'string', 'max' => 60],
            [['authKey', 'accessToken'], 'string', 'max' => 255]
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'value' => new Expression('NOW()')
            ]
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Cod.',
            'name' => 'Nome',
            'username' => 'Usuário',
            'email' => 'E-mail',
            'level' => 'Nível de Acesso',
            'password' => 'Senha',
            'authKey' => 'Chave de Autenticação',
            'accessToken' => 'Token de Acesso',
            'created_at' => 'Criado em',
            'updated_at' => 'Atualizado em',
        ];
    }
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->authKey = \Yii::$app->security->generateRandomString();
                $this->accessToken = \Yii::$app->security->generateRandomString();
                $this->level = 2;
            }

            $this->password = password_hash($this->password, PASSWORD_DEFAULT);

            return true;
        }

        return false;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return password_verify($password, $this->password);
    }

    /**
     * Localiza uma identidade pelo ID informado
     *
     * @param string|int $id o ID a ser localizado
     * @return IdentityInterface|null o objeto da identidade que corresponde ao ID informado
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Localiza uma identidade pelo token informado
     *
     * @param string $token o token a ser localizado
     * @return IdentityInterface|null o objeto da identidade que corresponde ao token informado
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['accessToken' => $token]);
    }

    /**
     * @return int|string o ID do usuário atual
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string a chave de autenticação do usuário atual
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @param string $authKey
     * @return bool se a chave de autenticação do usuário atual for válida
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * For testing
     */
    public static function findByEmail($email)
    {
        $user = User::find()->where(['email' => $email])->one();
        return $user;
    }
}
