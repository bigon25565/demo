<?php

namespace app\modules\admin\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\web\UploadedFile;

/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property string $status Статус заявки
 * @property string|null $name Имя заявки
 * @property string|null $before_img Картинка до
 * @property string $after_img Картинка после
 * @property string $why_not Причина отмены
 * @property string $created_at Когда создана
 * @property int $created_by Кем создана
 * @property int $category_id Категория
 * @property string $updated_by Когда обновлена
 *
 * @property Category $category
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $imageFile;
    public $imageFile2;

    public function __construct(array $config = [])
    {
        parent::__construct($config);
        $this->status = 'Новая';
    }

    public static function tableName()
    {
        return 'request';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }

    public function upload()
    {
        if($this->validate()) {
            if($this->imageFile){
                $path = 'uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
                $this->imageFile->saveAs($path);    
                $this->before_img = $path;
            }
            if($this->imageFile2){
                $path2 = 'uploads/' . $this->imageFile2->baseName . '.' . $this->imageFile2->extension;
                $this->imageFile2->saveAs($path2); 
                $this->after_img = $path2;               
            }
            return true;
        } else{
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','category_id'], 'required'],
            [['created_at', 'updated_by'], 'safe'],
            [['created_by', 'category_id'], 'integer'],
            [['status', 'name', 'before_img', 'after_img', 'why_not'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, bmp', 'maxSize' => 10 * 1024 * 1024],
            [['imageFile2'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, bmp', 'maxSize' => 10 * 1024 * 1024],
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
            'status' => 'Статус заявки',
            'name' => 'Имя заявки',
            'before_img' => 'Картинка до',
            'after_img' => 'Картинка после',
            'why_not' => 'Причина отмены',
            'created_at' => 'Когда создана',
            'created_by' => 'Кем создана',
            'category_id' => 'Категория',
            'updated_by' => 'Кем обновлена',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}
