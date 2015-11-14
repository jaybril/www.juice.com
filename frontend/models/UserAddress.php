<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/9/25
 * Time: 10:22
 */

namespace frontend\models;
use \yii\db\ActiveRecord;
use common\widgets;

class UserAddress extends  ActiveRecord
{

    /*
 * 通过用户id循环出所有地址
 */
    public function findByUserIdAll($userId){
        $UserAllAddress = UserAddress::findBySql("select ua.id,ua.detailAddress,ua.userName,ua.userMobile,ua.isDefault,ur.name 'province',ur1.name 'city',ur2.name 'area' from mp_user_address ua LEFT JOIN mp_area ur ON ua.provinceId = ur.id LEFT JOIN mp_area ur1 ON ua.cityId = ur1.id LEFT JOIN mp_area ur2 ON ua.areaId = ur2.id where ua.userId =".$userId." order By ua.addTime DESC")->asArray()->all();
        if (!$UserAllAddress) {
            return false;
        }
        return $UserAllAddress;
    }

    /*
* 通过地址id查询详情
*/
    public function findByAddressIdAll($id){
        $UserAllAddress = UserAddress::findBySql("select ua.id,ua.detailAddress,ua.userName,ua.userMobile,ua.isDefault,ur.name 'province',ur1.name 'city',ur2.name 'area' from mp_user_address ua LEFT JOIN mp_area ur ON ua.provinceId = ur.id LEFT JOIN mp_area ur1 ON ua.cityId = ur1.id LEFT JOIN mp_area ur2 ON ua.areaId = ur2.id where ua.id =".$id)->asArray()->one();
        if (!$UserAllAddress) {
            return false;
        }
        return $UserAllAddress;
    }

//    public function findByUserIdAll($userId){
//        $UserAllAddress = UserAddress::find()->where(array('userId' => $userId))->limit(11)->orderBy(['addTime'=>SORT_DESC])->all();
//        if (!$UserAllAddress) {
//            return false;
//        }
//        return $UserAllAddress;
//    }

    /*
* 通过用户id循环出所有地址
*/
    public function findByUserIdAllAgain($userId,$id){
        $UserAllAddressAgain = UserAddress::findBySql("select ua.id,ua.detailAddress,ua.userName,ua.userMobile,ua.isDefault,ur.name 'province',ur1.name 'city',ur2.name 'area' from mp_user_address ua LEFT JOIN mp_area ur ON ua.provinceId = ur.id LEFT JOIN mp_area ur1 ON ua.cityId = ur1.id LEFT JOIN mp_area ur2 ON ua.areaId = ur2.id where ua.id not in(".$id.") and ua.userId =".$userId." order By ua.addTime DESC")->asArray()->all();
        if (!$UserAllAddressAgain) {
            return false;
        }
        return $UserAllAddressAgain;
    }

    /*
 * 通过id查找出一个默认地址或最新地址
 */
    public function findByIdOne($userId,$status){
        if($status == 0){
            $UserAllAddress = UserAddress::findBySql("select ua.id,ua.detailAddress,ua.userName,ua.userMobile,ua.isDefault,ur.name 'province',ur1.name 'city',ur2.name 'area' from mp_user_address ua LEFT JOIN mp_area ur ON ua.provinceId = ur.id LEFT JOIN mp_area ur1 ON ua.cityId = ur1.id LEFT JOIN mp_area ur2 ON ua.areaId = ur2.id where ua.userId =".$userId." order By ua.addTime DESC limit 1")->asArray()->one();

//            $UserAllAddress = UserAddress::find()->where(array('userId' => $userId))->limit(1)->orderBy(['addTime'=>SORT_DESC])->one();
        }else{
            $UserAllAddress = UserAddress::findBySql("select ua.id,ua.detailAddress,ua.userName,ua.userMobile,ua.isDefault,ur.name 'province',ur1.name 'city',ur2.name 'area' from mp_user_address ua LEFT JOIN mp_area ur ON ua.provinceId = ur.id LEFT JOIN mp_area ur1 ON ua.cityId = ur1.id LEFT JOIN mp_area ur2 ON ua.areaId = ur2.id where ua.userId =".$userId." and ua.isDefault = 1 order By ua.addTime DESC limit 1")->asArray()->one();
        }

        if (!$UserAllAddress) {
            return false;
        }
        return $UserAllAddress;
    }

    /*
* 添加地址
*/
    public function insertAddress($userId,$AddressForm){
        date_default_timezone_set('Asia/Shanghai');
        $addTime = date('Y-m-d H:i:s',time());
        $UserAddress = new UserAddress();
        $UserAddress->userId=$userId;
        $UserAddress->provinceId=$AddressForm->provinceId;
        $UserAddress->cityId=$AddressForm->cityId;
        $UserAddress->areaId=$AddressForm->areaId;
        $UserAddress->detailAddress=$AddressForm->detailAddress;
        $UserAddress->userName=$AddressForm->userName;
        $UserAddress->postNumber=$AddressForm->postNumber;
        $UserAddress->userMobile=$AddressForm->userMobile;
        $UserAddress->userPhone=$AddressForm->userPhone;
        $UserAddress->isDefault=$AddressForm->isDefault;
        $UserAddress->addTime=$addTime;
        $UserAddress->insert();
    }

    /*
* 通过用户id更新默认地址
*/
    public function findByUserIdUpdate($userId){
        $UserAddress = UserAddress::find()->where(array('userId' => $userId))->all();
        for($i=0;$i<count($UserAddress);$i++)
        {
            $UserAddress[$i]->isDefault=0;
            $UserAddress[$i]->update();
        }

    }

    /*
* 通过用户id和地址id把值赋给表单
*/
    public function findByUserIdEvaluate($userId,$id){
        $EditAddress = UserAddress::find()->where(array('userId' => $userId,'id'=>$id))->one();
        if (!$EditAddress) {
            return false;
//            return new static($UserAllAddress);
        }
        return $EditAddress;

    }

    /*
   * 通过用户id和地址id修改地址
   */
    public function findByIdEdit($id,$AddressForm){
        date_default_timezone_set('Asia/Shanghai');
        $addTime = date('Y-m-d H:i:s',time());
        $result = UserAddress::findOne($id);
        $result->userName=$AddressForm->userName;
        $result->provinceId=$AddressForm->provinceId;
        $result->cityId=$AddressForm->cityId;
        $result->areaId=$AddressForm->areaId;
        $result->detailAddress=$AddressForm->detailAddress;
        $result->userMobile=$AddressForm->userMobile;
        $result->userPhone=$AddressForm->userPhone;
        $result->postNumber=$AddressForm->postNumber;
        $result->isDefault=$AddressForm->isDefault;
        $result->addTime=$addTime;
        $result->update();
    }

    /*
* 通过地址id删除地址
*/
    public function findByIdDelete($id){
        $result = UserAddress::findOne($id);
        $result->delete();
    }

    // 一个用户对应多个地址
    public function getUserAddress()
    {
        //同样第一个参数指定关联的子表模型类名
        //
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }
}