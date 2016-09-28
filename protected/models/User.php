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

    public function getCodeList() {
        $sql = "select * from wc_user where status=0";
        $command = Yii::app()->db->createCommand($sql);
        $result = $command->queryAll();
        return $result;
    }

    private function generatePresentCode($id) {
        $id = intval($id);
        if (($id % 2) === 0) {
            if (($id > 0) && (($id & ($id - 1)) == 0)) {
                return "SPECIAL_CODE_" . sprintf("%04d", $id);
            } else {
                return "WJ_PRESENT_" . sprintf("%04d", $id);
            }
        } else {
            return "HZY_GIFT_" . sprintf("%04d", $id);
        }
    }
}
