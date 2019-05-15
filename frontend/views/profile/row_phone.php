<?php
/** @var \common\models\user\UserPhone $phone */
?>

<tr id="phone_<?=$phone->id?>">
    <td class="add-title"><?= Yii::t('profile','Phone')?>: </td>
    <td class="text profile-info"><?= $phone->phone ?>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        <span href="#" class="deletePhone" data-phone-id="<?=$phone->id ?>">
            <i class="fa fa-trash-o" aria-hidden="true"></i>
        </span>
    </td>
    <td>
        <input class="tgl tgl-ios" id="cb<?=$phone->id?>" type="checkbox" name="phoneStatus[<?=$phone->id ?>]"
            <?=$phone->status =='active'? 'checked': ''?>
        />
        <label class="tgl-btn" for="cb<?=$phone->id?>"  ></label>

    </td>


</tr>
