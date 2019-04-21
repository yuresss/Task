<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string $name
 * @property string $date
 * @property int $autor
 * @property string $edition
 * @property string $description
 *
 * @property Autor $autor0
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'autor'], 'required'],
            [['date'], 'safe'],
            [['autor'], 'integer'],
            [['description'], 'string'],
            [['name', 'edition'], 'string', 'max' => 255],
            [['autor'], 'exist', 'skipOnError' => true, 'targetClass' => Autor::className(), 'targetAttribute' => ['autor' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'date' => 'Date',
            'autor' => 'Autor',
            'edition' => 'Edition',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAutor0()
    {
        return $this->hasOne(Autor::className(), ['id' => 'autor']);
    }
}
