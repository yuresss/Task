<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "autor".
 *
 * @property int $id
 * @property string $name
 * @property string $birth
 * @property string $biography
 *
 * @property Book[] $books
 */
class Autor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'autor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'birth', 'biography'], 'required'],
            [['birth'], 'safe'],
            ['birth', 'date', 'format' => 'php:d.m.Y'],
            [['biography'], 'string'],
            [['name'], 'string', 'max' => 255],
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
            'birth' => 'Birth',
            'biography' => 'Biography',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['autor' => 'id']);
    }
}
