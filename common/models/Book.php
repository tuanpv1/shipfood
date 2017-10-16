<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "book".
 *
 * @property integer $id
 * @property string $full_name
 * @property string $position
 * @property string $address
 * @property integer $old
 * @property string $phone
 * @property string $email
 * @property string $file
 * @property integer $id_dv
 * @property integer $status
 * @property integer $time_start
 * @property integer $created_at
 * @property integer $updated_at
 */
class Book extends \yii\db\ActiveRecord
{
    const STATUS_CANCEL = 7;
    const STATUS_BOOKED = 8;
    const STATUS_COME = 9;
    const STUTUS_CONFIRM = 10;

    const PART_S = 1;
    const PART_C = 2;
    const FULL = 3;

    public static function listShift()
    {
        $lst = [
            self::PART_S => 'Ca sáng',
            self::PART_C => 'Ca chiều',
            self::FULL => 'Full Time',
        ];
        return $lst;
    }

    public function getShiftName()
    {
        $lst = self::listShift();
        if (array_key_exists($this->status, $lst)) {
            return $lst[$this->status];
        }
        return $this->status;
    }

    public static function listStatus()
    {
        $lst = [
            self::STATUS_BOOKED => 'Vừa đặt',
            self::STATUS_CANCEL => 'Đã hủy',
            self::STATUS_COME => 'Đã hoàn thành',
            self::STUTUS_CONFIRM => 'Đã xác nhận',
        ];
        return $lst;
    }

    public function getStatusName()
    {
        $lst = self::listStatus();
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
        return 'book';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['old', 'id_dv', 'time_start', 'created_at', 'updated_at','status'], 'integer'],
            [['full_name', 'phone', 'email'], 'string', 'max' => 255],
            [
                [
                    'full_name',
                    'phone',
                    'id_dv',
                    'email',
                    'position',
                    'file',
                ],
                'required',
                'message'=>Yii::t('app','{attribute} không được để trống'),
            ],
            ['address','string','max'=>700],
            ['position','string','max'=>255],
            ['file','string','max'=>500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => 'Họ và tên',
            'old' => 'Số tuổi',
            'address' => 'Địa chỉ',
            'position' => 'Vị trí ứng tuyển',
            'phone' => 'Số điện thoại',
            'email' => 'Email',
            'status' => 'Trạng thái',
            'id_dv' => 'Ca làm việc',
            'created_at' => 'Thời gian đặt lịch',
            'updated_at' => 'Thời gian thay đổi thông tin',
            'file' => 'Hồ sơ',
        ];
    }
}
