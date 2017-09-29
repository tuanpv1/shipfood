<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[UserFollowing]].
 *
 * @see UserFollowing
 */
class UserFollowingQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return UserFollowing[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return UserFollowing|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
