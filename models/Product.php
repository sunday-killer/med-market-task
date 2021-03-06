<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property int $category_id
 * @property int|null $price
 * @property string|null $description
 *
 * @property Category $category
 * @property ProductImages[] $productImages
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'category_id'], 'required'],
            [['category_id', 'price'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'category_id' => 'Категория товара',
            'price' => 'Цена',
            'description' => 'Описание',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductImages()
    {
        return $this->hasMany(ProductImage::className(), ['product_id' => 'id']);
    }

    public static function getProductsWithImagesAndCategories()
    {
        return self::find()->with("productImages")->joinWith([
          'category' => function ($query) {
              $category_id = \Yii::$app->request->get('category_id');
              if (!empty($category_id)) {
                  $query->where(["category.id" => $category_id]);
              }
          }
        ])->asArray()->all();
    }


    public static function getProductWithImagesAndCategory($whereOptions = [])
    {
        return self::find()->where($whereOptions)->with("productImages")->with('category')->asArray()->one();
    }



}
