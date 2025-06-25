<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "queue_statuses".
 *
 * @property int $id
 * @property string $s_name
 * @property string $c_name
 * @property string $c_id
 * @property string $a_type
 * @property string $direction
 * @property string $activation
 * @property string $c_state
 * @property string $control
 * @property string|null $created_at
 */
class QueueStatus extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'queue_statuses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['s_name', 'c_name', 'c_id', 'a_type', 'direction', 'activation', 'c_state', 'control'], 'required'],
            [['s_name'], 'string', 'max' => 512],
            [['c_name'], 'string', 'max' => 512],
            [['c_id'], 'string', 'max' => 32],
            [['a_type'], 'string', 'max' => 128],
            [['direction'], 'string', 'max' => 32],
            [['activation'], 'string', 'max' => 32],
            [['c_state'], 'string', 'max' => 32],
            [['control'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            's_name' => Yii::t('app', 'S Name'),
            'c_name' => Yii::t('app', "C Name"),
            'c_id' => Yii::t('app', "C ID"),
            'a_type' => Yii::t('app', "A Type"),
            'direction' => Yii::t('app', "Direction"),
            'activation' => Yii::t('app', "Activation"),
            'c_state' => Yii::t('app', "C State"),
            'control' => Yii::t('app', "Control"),
        ];
    }

    /**
     * Метод для поиска существующей записи по уникальным полям.
     */
    public static function findExisting($attributes)
    {
        return self::find()->where($attributes)->one();
    }
}