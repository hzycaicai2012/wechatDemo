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

    public function getPresentCode($userName, $message) {
        $user = User::model()->find("open_id=:name", array(':name' => $userName));
        if (!isset($user) && isset($userName)) {
            $user = new User();
            $user->open_id = $userName;
            $user->message = $message;
            $user->created = date('Y-m-d H:i:s');
            $user->updated = date('Y-m-d H:i:s');
            $user->save();
            $code = $this->generatePresentCode($user->id);
            User::model()->updateByPk($user->id, array('present_code' => $code));
            return $code;
        } else if (isset($user)) {
            return $user->present_code;
        } else {
            return "粗错啦~";
        }
    }

    private function generatePresentCode($id) {
        return "WEDDING_GIFT_" . sprintf("%04d", $id);
    }
}
