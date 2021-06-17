<?php

namespace common\models;

use Imagine\Gd\Image;
use Imagine\Image\Box;
use phpDocumentor\Reflection\DocBlock\Tags\Param;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\FileHelper;
use yii\imagine\BaseImage;


/**
 * This is the model class for table "{{%video}}".
 *
 * @property string $video_id
 * @property string $title
 * @property string|null $description
 * @property string|null $tags
 * @property int|null $status
 * @property int|null $ha_thumbnail
 * @property string|null $video_name
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 */
class Video extends \yii\db\ActiveRecord
{
    const STATUS_UNLISTED = 0;
    const STATUS_PUBLISHED = 1;
    /**
     * @var \yii\web\UploadedFile
     */
     public  $video;
    /**
     * @var \yii\web\UploadedFile
     */
    public  $thumbnail;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%video}}';
    }

    public function behaviors()
    {
        return [
          TimestampBehavior::class,
            [
                'class' => BlameableBehavior::class,
                'updatedByAttribute' => false,
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['video_id', 'title'], 'required'],
            [['description'], 'string'],
            [['status', 'ha_thumbnail', 'created_at', 'updated_at', 'created_by'], 'integer'],
            [['video_id'], 'string', 'max' => 16],
            ['status', 'default', 'value' => self::STATUS_UNLISTED],
            ['ha_thumbnail', 'default', 'value' => 0],
            [['title', 'tags', 'video_name'], 'string', 'max' => 255],
            ['thumbnail', 'image'],
            ['video', 'file', 'extensions'=>['mp4'], 'max'=>0],
            [['video_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(){
       return [
            'status' => 'Status',
            'ha_thumbnail' => 'Has Thumbnail',
            'video_name' => 'Video Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'thumbnail' => 'Thumbnail',
        ];
    }
    public function getStatusLabels(){
        return[
          self:: STATUS_UNLISTED => 'Unlisted',
            self::STATUS_PUBLISHED => 'Published',
        ];
}
    /**
     * @return \yii\db\ActiveQuery
     */
 public function getCreatedBy(){
     return $this->hasOne(User::className(), ['id' => 'createdby']);
 }
    /**
    {
    return [
    'video_id' => 'Video ID',
    'title' => 'Title',
    'description' => 'Description',
    'tags' => 'Tags',
     * {@inheritdoc}
     * @return \common\models\query\VideoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\VideoQuery(get_called_class());
    }
    public function save($runValidation = true, $attributeNames = null)
    {
        $isInsert = $this->isNewRecord;
        if ($isInsert){
            $this->video_id = Yii::$app->security->generateRandomString(8);
            $this->title = $this->video->name;
            $this->video_name = $this->video->name;
        }
        if ($this->thumbnail){
            $this->ha_thumbnail = 1;
        }
        $saved = parent::save($runValidation, $attributeNames);
         if (!$saved){
             return false;
         }
         if ($isInsert){
             $videoPath = Yii:: getAlias('@frontend/web/storage/video' . $this->video_id. '.mp4');
             if (!is_dir(dirname($videoPath))){
                 FileHelper:: createDirectory(dirname($videoPath));
             }
             $this->video->saveAs($videoPath);
         }
         if ($this->thumbnail){
             $thumbnailPath = Yii:: getAlias('@frontend/web/storage/thumbs' . $this->title. '.jpg');
             if (!is_dir(dirname($thumbnailPath))){
                 FileHelper:: createDirectory(dirname($thumbnailPath));
             }
             $this->thumbnail->saveAs($thumbnailPath);

            /* Image:: getImagine()
             ->open($thumbnailPath)
             ->thumbnail(new box(width: 1280, height: 1280))
             ->save();*/
         }
         return true;
    }
    public function getVideoLink()
    {
        return  Yii:: getAlias('@frontend/web/storage/video' . $this->video_id. '.mp4');
    }
    public function getThumbLink()
    {
        return Yii:: getAlias('@frontend/web/storage/thumbs' . $this->title. '.jpg');
    }
}
