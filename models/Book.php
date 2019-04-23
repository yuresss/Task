<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string $name
 * @property string $date
 * @property int $autor_id
 * @property string $edition
 * @property string $description
 *
 * @property Autor $autor
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
            [['name', 'autor_id'], 'required'],
            [['date'], 'safe'],
            [['autor_id'], 'integer'],
            [['description'], 'string'],
            [['name', 'edition'], 'string', 'max' => 255],
            [['autor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Autor::className(), 'targetAttribute' => ['autor_id' => 'id']],
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
            'autor_id' => 'Autor ID',
            'edition' => 'Edition',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAutor()
    {
        return $this->hasOne(Autor::className(), ['id' => 'autor_id']);
    }
}
