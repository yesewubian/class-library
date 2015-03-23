<?php
/**
 * 根据身份证号，自动返回生日
 * 
 * @param unknown $IDCard
 * @return Ambigous <string, NULL>
 */
function getBrithday ($IDCard)
{
    if (strlen($IDCard) == 18) {
        $birthday = substr($IDCard, 6, 4) . '-' .
                 substr($IDCard, 10, 2) . '-' .
                 substr($IDCard, 12, 2);
    } elseif (strlen($IDCard) == 15) {
        $birthday = "19" . substr($IDCard, 6, 2) . '-' .
                 substr($IDCard, 8, 2) . '-' .
                 substr($IDCard, 10, 2);
    } else {
        $birthday = null;
    }
    
    return $birthday;
}

/**
 * 根据身份证号，自动返回性别
 * 
 * @param   string    $cid   身份证号
 * @param   number    $comm  返回的性别类型 
 * @return  string    男/女 1/0
 */
function getSex ($cid, $comm = 0)
{ 
    $cid = getIDCard($cid);
    $sexint = (int) substr($cid, 16, 1);
    if ($comm > 0) {
        return $sexint % 2 === 0 ? '女' : '男';
    } else {
        return $sexint % 2 === 0 ? '0' : '1';
    }
}

/**
 *
 *
 * 功能：把15位身份证转换成18位
 *
 * @param string $idCard            
 *
 * @return newid or id
 *        
 *        
 */
function getIDCard ($idCard)
{
    
    // 若是15位，则转换成18位；否则直接返回ID
    if (15 == strlen($idCard)) {
        
        $W = array(
                7,
                9,
                10,
                5,
                8,
                4,
                2,
                1,
                6,
                3,
                7,
                9,
                10,
                5,
                8,
                4,
                2,
                1
        );
        
        $A = array(
                "1",
                "0",
                "X",
                "9",
                "8",
                "7",
                "6",
                "5",
                "4",
                "3",
                "2"
        );
        
        $s = 0;
        
        $idCard18 = substr($idCard, 0, 6) . "19" . substr($idCard, 6);
        
        $idCard18_len = strlen($idCard18);
        
        for ($i = 0; $i < $idCard18_len; $i ++) {
            
            $s = $s + substr($idCard18, $i, 1) * $W[$i];
        }
        
        $idCard18 .= $A[$s % 11];
        
        return $idCard18;
    } else {
        
        return $idCard;
    }
}
