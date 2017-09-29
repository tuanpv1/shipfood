<?php

namespace common\models;

use backend\models\Image;
use Yii;
use yii\base\InvalidParamException;
use yii\behaviors\TimestampBehavior;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;


/**
 * This is the model class for table "{{%news}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $url_video_new
 * @property string $title_ascii
 * @property string $content
 * @property string $images
 * @property integer $type
 * @property integer $id_cat
 * @property string $tags
 * @property string $short_description
 * @property string $description
 * @property string $video_url
 * @property string $video
 * @property integer $view_count
 * @property integer $like_count
 * @property integer $comment_count
 * @property integer $favorite_count
 * @property integer $honor
 * @property string $source_name
 * @property string $source_url
 * @property integer $status
 * @property integer $created_user_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $published_at
 * @property integer $user_id
 * @property integer $position
 * @property integer $all_village
 * @property integer $type_video
 * @property integer $lead_donor_id
 * @property string $price
 * @property User $user
 */
class News extends \yii\db\ActiveRecord
{

    const MAX_SIZE_UPLOAD = 5 * 1024 * 1024;
    public $thumbnail;
    public $image_des;

    const STATUS_NEW = 1;
    const STATUS_ACTIVE = 10;
    const STATUS_INACTIVE = 0;
    const STATUS_DELETED = 2;

    const LIST_EXTENSION = '.jpg,.png';

    const TYPE_NEWS = 1;
    const TYPE_ABOUT = 2;
    const TYPE_CN = 3;
    const TYPE_DV = 4;
    const TYPE_KH = 5;


    const IMAGE_TYPE_THUMBNAIL = 1; //anh dai dien
    const IMAGE_TYPE_DES = 2; //anh mo ta


    // add by TP in 13/12/2016 update type_video display in slide home
    const TYPE_VIDEO = 1;// CÓ VIDEO
    const TYPE_NOT_VIDEO = 2;// không cÓ VIDEO

    // phân biệt để làm ẩn hiện khung tải video hay url
    const TYPE_UPLOAD_VIDEO = 1;// TẢI LÊN VIDEO
    const TYPE_URL = 2;

    public static function getTypeTP()
    {
        return $ls = [
            self::TYPE_UPLOAD_VIDEO => 'Tải video',
            self::TYPE_URL => 'Tải URL',
        ];
    }

    // end add

    public static function getListImageType()
    {
        return [
            self::IMAGE_TYPE_DES => 'Ảnh mô tả',
            self::IMAGE_TYPE_THUMBNAIL => 'Ảnh đại diện',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%news}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public static function formatNumber($number)
    {
        return (new \yii\i18n\Formatter())->asInteger($number);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'view_count', 'like_count', 'comment_count', 'favorite_count', 'honor',
                'status', 'created_user_id', 'created_at', 'updated_at', 'user_id'
                , 'published_at', 'type_video', 'position', 'id_cat', 'price'], 'integer'],
            [['title', 'user_id', 'price'], 'required'],
            [['video'], 'file', 'extensions' => ['doc', 'docx', 'pdf'], 'maxSize' => 1024 * 1024 * 500, 'tooBig' => 'Video vượt quá dung lượng cho phép!'],
            [['thumbnail'], 'required', 'on' => 'create'],
            [['content', 'description'], 'string'],
            [['title', 'title_ascii', 'thumbnail'], 'string', 'max' => 512],
            [['tags', 'source_name', 'source_url'], 'string', 'max' => 200],
            [['short_description', 'video', 'url_video_new'], 'string', 'max' => 1000],
            [['video_url'], 'safe'],
            [['images', 'thumbnail', 'image_des'], 'image', 'extensions' => 'png,jpg,jpeg,gif',
                'maxSize' => News::MAX_SIZE_UPLOAD, 'tooBig' => 'Ảnh upload vượt quá dung lượng cho phép!'
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Tiêu đề'),
            'title_ascii' => Yii::t('app', 'Title Ascii'),
            'content' => Yii::t('app', 'Nội dung'),
            'thumbnail' => Yii::t('app', 'Ảnh đại diện'),
            'image_des' => Yii::t('app', 'Ảnh mô tả'),
            'type' => Yii::t('app', 'Loại bài viết'),
            'tags' => Yii::t('app', 'Tags'),
            'short_description' => Yii::t('app', 'Mô tả ngắn'),
            'description' => Yii::t('app', 'Mô tả'),
            'video_url' => Yii::t('app', 'Đường dẫn video'),
            'video' => Yii::t('app', 'Video'),
            'view_count' => Yii::t('app', 'View Count'),
            'like_count' => Yii::t('app', 'Like Count'),
            'comment_count' => Yii::t('app', 'Comment Count'),
            'favorite_count' => Yii::t('app', 'Favorite Count'),
            'honor' => Yii::t('app', 'Thời gian sử dụng DV'),
            'source_name' => Yii::t('app', 'Source Name'),
            'source_url' => Yii::t('app', 'Url'),
            'status' => Yii::t('app', 'Trạng thái'),
            'created_user_id' => Yii::t('app', 'Created User ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'user_id' => Yii::t('app', 'User ID'),
            'price' => Yii::t('app', 'Giá'),
            'position' => Yii::t('app', 'Vị trí'),
            'id_cat' => Yii::t('app', 'Thuộc danh mục')
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'created_user_id']);
    }

    public function getThumbnailLink()
    {
        $pathLink = Yii::getAlias('@web') . '/' . Yii::getAlias('@image_news') . '/';
        $filename = null;

        if ($this->thumbnail) {
            $filename = $this->thumbnail;

        }
        if ($filename == null) {
            $pathLink = Yii::getAlias("@web/img/");
            $filename = 'bg_df.png';
        }

        return Url::to($pathLink . $filename, true);

    }

    /**
     * @return array
     */
    public static function listStatus()
    {
        $lst = [
            self::STATUS_NEW => 'Soạn thảo',
            self::STATUS_ACTIVE => 'Hoạt động',
            self::STATUS_INACTIVE => 'Tạm dừng',
        ];
        return $lst;
    }

    /**
     * @return array
     */

    /**
     * @return int
     */
    public function getStatusName()
    {
        $lst = self::listStatus();
        if (array_key_exists($this->status, $lst)) {
            return $lst[$this->status];
        }
        return $this->status;
    }

    public static function listStatusType()
    {
        $lst = [
            self::TYPE_NEWS => 'Tin làm đẹp',
            self::TYPE_ABOUT => 'Giới thiệu',
            self::TYPE_CN => 'Công nghệ',
            self::TYPE_DV => 'Dịch vụ',
            self::TYPE_KH => 'Phản hồi của khách hàng',
        ];
        return $lst;
    }

    public static function getTypeName($type)
    {
        $lst = self::listStatusType();
        if (array_key_exists($type, $lst)) {
            return $lst[$type];
        }
        return $type;
    }


    public static function convertJsonToArray($input)
    {
        $listImage = json_decode($input);

        $result = [];
        if (is_array($listImage)) {
            foreach ($listImage as $item) {
                $row['name'] = $item->name;
                $row['type'] = $item->type;
                $row['size'] = $item->size;
                $result[] = $row;
            }
        }
        return $result;
    }

    public function getFirstImageLink()
    {
        $link = '';
        if (!$this->images) {
            return null;
        }
        $listImages = News::convertJsonToArrayTP($this->images);
        foreach ($listImages as $key => $row) {
            $link = Url::to(Yii::getAlias('@web/upload/image_news/') . $row['name'], true);
        }
        return $link;
    }

    public static function getImageFe($name)
    {
//        echo  "<pre>";print_r($row);die();
        $link = Url::to(Yii::getAlias('@web/upload/image_news/') . $name, true);
        return $link;
    }

    public static function getFirstImageLinkTP($image)
    {
        $link = '';
        if (!$image) {
            return null;
        }
        $listImages = News::convertJsonToArrayTP($image);
        foreach ($listImages as $key => $row) {
            $link = Url::to(Yii::getAlias('@web/upload/image_news/') . $row['name'], true);
        }
        return $link;
    }

    public static function convertJsonToArrayTp($input)
    {
        $listImage = json_decode($input);

        $result = [];
        if (is_array($listImage)) {
            foreach ($listImage as $item) {
                if ($item->type == 1) {
                    $row['name'] = $item->name;
                    $row['type'] = $item->type;
                    $row['size'] = $item->size;
                    $result[] = $row;
                }
            }
        }
        return $result;
    }

    public function getImagesNews()
    {
        try {
            $res = [];
            $images = $this->convertJsonToArray($this->images);
            if ($images) {
                for ($i = 0; $i < count($images); $i++) {
                    $item = $images[$i];
                    $image = new Image();
                    $image->type = $item['type'];
                    $image->name = $item['name'];
                    $image->size = $item['size'];
                    array_push($res, $image);
                }
                return $res;
            }
        } catch (InvalidParamException $ex) {
            $images = null;
        }

        return $images;
    }


}
