<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Url;

/**
 * This is the model class for table "info_public".
 *
 * @property integer $id
 * @property string $image_header
 * @property string $image_footer
 * @property string $image_menu
 * @property string $image_android
 * @property string $image_ios
 * @property string $email
 * @property string $phone
 * @property string $link_face
 * @property string $youtube
 * @property string $twitter
 * @property string $address
 * @property string $url
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class InfoPublic extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 10; // hien
    const STATUS_BLOCK = 1; //an
    const STATUS_DELETED= 0; //an

    const ID_DEFAULT = 1;

    public  function  getListStatus(){
        $list1 = [
            self::STATUS_ACTIVE => 'Hiện',
            self::STATUS_BLOCK => 'Ẩn',
        ];

        return $list1;
    }

    public function getStatusName()
    {
        $lst = self::getListStatus();
        if (array_key_exists($this->status, $lst)) {
            return $lst[$this->status];
        }
        return $this->status;
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'info_public';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['image_menu','image_header', 'image_footer', 'email', 'phone', 'link_face', 'address','youtube','twitter','url'], 'string', 'max' => 500],
            ['image_header','required','message'=>Yii::t('app','{attribute} không được để trống'),'on'=>'create'],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'email','message'=>Yii::t('app','{attribute} không hợp lệ!')],
            [['image_header','image_android','image_ios'],
                'file',
                'tooBig'         => Yii::t('app','{attribute} vượt quá dung lượng cho phép. Vui lòng thử lại'),
                'wrongExtension' => Yii::t('app','{attribute} không đúng định dạng'),
                'uploadRequired' => Yii::t('app','{attribute} không được để trống'),
                'extensions'     => 'png, jpg, jpeg, gif',
                'maxSize'        => 1024 * 1024 * 5
            ],
            [['image_android','image_ios','link_android','link_ios'],'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app','ID'),
            'image_header' => Yii::t('app','Hình ảnh logo'),
            'image_footer' => Yii::t('app','Tiêu đề hiển thị trên trang chủ'),
            'image_menu' => Yii::t('app','Mô tả ngắn'),
            'email' => Yii::t('app','Email'),
            'phone' => Yii::t('app','Số điện thoại'),
            'link_face' => Yii::t('app','Link facebook'),
            'youtube' => Yii::t('app','Link youtube'),
            'twitter' => Yii::t('app','Link twitter'),
            'url' => Yii::t('app','Tel2'),
            'address' =>Yii::t('app', 'Địa chỉ'),
            'status' => Yii::t('app','trạng thái'),
            'created_at' => Yii::t('app','Ngày tạo'),
            'updated_at' => Yii::t('app','Ngày thay đổi thông tin'),
            'link_android' => Yii::t('app','Link tải trên CH play'),
            'image_android' => Yii::t('app','Hình ảnh QR android'),
            'image_ios' => Yii::t('app','Hình ảnh QR IOS'),
            'link_ios' => Yii::t('app','Link tải IOS'),
        ];
    }

    public static function getImage($image)
    {
        if ($image) {
            return Url::to(Yii::getAlias('@web') . '/' . Yii::getAlias('@image_banner') . '/' . $image, true);
        }
    }

    public function getImageLink()
    {
        return $this->image_header?Url::to(Yii::getAlias('@web') . '/' . Yii::getAlias('@image_banner') . '/' . $this->image_header, true):'';
    }
}