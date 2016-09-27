<?php

class User extends CActiveRecord
{
    /**
     * @param string $className
     * @return static
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string
     */
    public function tableName()
    {
        return 'wc_user';
    }
}
