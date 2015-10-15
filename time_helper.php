/**
 * 作用格式化时间戳返回友好格式的时间
 * @param string $time
 * @param number $type
 * @return NULL|string(刚刚、5分钟前、今天12:32、3月2日、2015年3月2日)
 */
public function formatTime($time = null,$type = 1){
	if(empty($time)){
	    return null;exit;
// 		    $time = time();
	}
	$return = date('Y-m-d',$time);
	$c_year = date('Y',time());
	
	if($type == 0){
	    return $return;
	}elseif($type == 1){
	    $year = date('Y',$time);
		if($year == $c_year){
			$return = date('m月d日',$time); //本年（ *月*日）
			if(date('m',$time) == date('m',time())){
			    $return = date('m月d日',$time); //月 （*日）
			    if(date('d',$time) == date('d',time())){
			        $return = date('今天 H:i',$time); //天 （今天 12:03）
			        if(date('H',$time) == date('H',time())){				            
			            $i = date('i',$time);
			            $ii = date('i',time());
			            $return = $ii-$i.'分钟前'; //小时 （今天 12:03）
			            if(date('i',time()) - date('i',$time) < 3){
			            	$return = '刚刚';
			            }
			        }
			    }
			}
		}else{
			$return = date('Y-m-d',$time);
		}
	}else{
// 		    $return = 0;
	}
	return $return;
	
	
}
