<?

class Validation{

	public static function checkAllFields($arr){
		if (count($arr) === 0) {
			return false;
		}
		foreach ($arr as $rule => $value) {
			if (!self::checkEmpty($value) || !self::checkType($value) /*|| !self::checkLength($value)*/) {
				return false;
			}
			switch ($rule) {
				case 'login':
					if (!self::checkLogin($value)) {
						return false;
					}
					break;
				case 'passwd':
					if (!self::checkPasswd($value)) {
						return false;
					}
					break;
				case 'email':
					if (!self::checkEmail($value)) {
						return false;
					}
					break;	
				case 'phone':
					if (!self::checkTel($value)) {
						return false;
					}
					break;	
				case 'name_user'||'second_name_user'||'middle_name':
					if (!self::checkText($value)) {
						return false;
					}
					break;	
			}
		}
		return true;
	}

	public static function checkType($data, $type="string"){
		if (gettype($data) == $type) {
			return true;
		}
		return false;
	}

	public static function checkEmpty($data){
		if ($data==="") {
			return false;
		}
		return true;
	}	

	public static function checkLength($data, $min = 6, $max = 255){
		if (iconv_strlen($data) < $min || iconv_strlen($data) > $max) {
			return false;
		}
		return true;
	}

	public static function checkLogin($login){
		if (preg_match('/^\b\w{6,128}\b$/i', $login)) {
			return true;
		}	
		
		return false;
	}
	public static function checkPasswd($passwd){
		if (preg_match('/[a-z]+/u', $passwd) && preg_match('/[A-Z]+/u', $passwd) && preg_match('/[0-9]+/u', $passwd) && preg_match('/[\!\?\.\,\@\#\$\%\_\-]+/u', $passwd)) {
			return true;
		}
		return false;
	}
	public static function checkEmail($email){
		if (preg_match('/^\b[a-zA-Z0-9_ \-\.]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+\b$/i', $email)) {
			return true;
		}
		return false;
	}
	public static function checkTel($phone){
		if (preg_match('/^\b8 \(0[0-9]{2}\) [0-9]{3}-[0-9]{2}-[0-9]{2}\b$/i', $phone)) {
			return true;
		}
		return false;
	}
	public static function checkText($all_name){
		if (preg_match('/^\b[a-zA-Zа-яА-ЯёЁ]{2,128}\b$/u', $all_name)) {
			return true;
		}
		return false;
	}
	public static function checkFile(){

	}
}
