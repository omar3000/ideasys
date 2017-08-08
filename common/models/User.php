<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $alias
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    const USUARIO_OPERADOR = 'operador';
    const USUARIO_ISOPORTE = 'Isoporte';
    const USUARIO_PRODUCCION = 'jefeProduccion';
    const USUARIO_PAGOS = 'pagos';
    const USUARIO_ADMINISTRATIVO = 'administrativo';
    
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function getUsers()
    {
        $langValues = (new \yii\db\Query())
                    ->select('u.id AS id, u.username')
                    ->from('user u ')
                    ->innerJoin('auth_assignment a','u.id = a.user_id and a.item_name =\'' .User::USUARIO_ISOPORTE . '\'')
                    ->all();

            return \yii\helpers\ArrayHelper::map($langValues,'id','username');
    }

    public function getUsersSinContacto()
    {
        $langValues = (new \yii\db\Query())
            ->select('u.id AS id, u.username')
            ->from('user u ')
            ->leftJoin('contacto c','c.fkuser = u.id')
            ->innerJoin('auth_assignment a', 'u.id = a.user_id and a.item_name !=\''.User::USUARIO_ISOPORTE.'\'and a.item_name !=\''.User::USUARIO_ADMINISTRATIVO. '\'') 
            ->Where(['c.fkuser' => null])
            ->all();
 
            /*
            SELECT u.id
            FROM user as u
            left join contacto as c on u.id = c.fkuser 
            where c.fkuser is null
            */
        return \yii\helpers\ArrayHelper::map($langValues,'id','username');
    }

    public  function getEmailUser($id)
    {
        $post = Yii::$app->db->createCommand('SELECT c.correo from notificar as n inner join contacto as c on n.fkcontacto_notificar = c.idcontacto inner join user as u on u.id='.$id.' inner join contacto as c2 on n.fkcontacto = c2.idcontacto where c2.fkuser = u.id')->queryAll();

        return $post;
    }
}
