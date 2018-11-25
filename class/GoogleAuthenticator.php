<?php
include_once("userDB.php");



class GoogleAuthenticator
{
    protected $_codeLength = 6;

    /**
     * Tao chuoi ngau nhien de lam khoa K ( 16bit )
     */
    public function createSecret($secretLength = 16)
    {
        $validChars = $this->_getBase32LookupTable();
        unset($validChars[32]);

        $secret = '';
        for ($i = 0; $i < $secretLength; $i++) {
            $secret .= $validChars[array_rand($validChars)];
        }
        return $secret;
    }
    protected function _getBase32LookupTable()
    {
        return array(
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', //  7
            'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', // 15
            'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', // 23
            'Y', 'Z', '2', '3', '4', '5', '6', '7', // 31
            '='  // padding char
        );
    }


    /**
     * Tinh toan OTP duoc sinh ra tu server
     */
    public function getCode($secret, $timeSlice = null)
    {
        $db= new userDB();
        if ($timeSlice === null) {
            $timeSlice = floor(time() / 30); // unix time
        }

        $secretkey = $db->_base32Decode($secret); // decode base 32
        
        // thoi gian thanh binary
        $time = chr(0).chr(0).chr(0).chr(0).pack('N*', $timeSlice); 

        $hm = hash_hmac('SHA1', $time, $secretkey, true); // sha1 , string $algo , string $data , string $key, binary
        // Lay byte cuoi cung 0-15 -> -1 = 16 , a =97 => ord(a) = 97 , 0x0F = 0000 1111 => and de lay 4 byte cuoi 
        $offset = ord(substr($hm, -1)) & 0x0F; // vi tri offset thu may
        // cat lay 4 byte tu offset
        $hashpart = substr($hm, $offset, 4);

        // chuyen sang gia gi binary
        $value = unpack('N', $hashpart); // { [1]=> int(1714959929) }
        $value = $value[1];
        // 32 bit ( trunkcate)
        $value = $value & 0x7FFFFFFF; // 0x7ff : dau so 0 o dau la duong , 1 la am 

        $modulo = pow(10, $this->_codeLength); //10^6
        return str_pad($value % $modulo, $this->_codeLength, '0', STR_PAD_LEFT);
    }

    /**
     * Tao QR code tu google chart
     */
    public function getQRCodeGoogleUrl($name, $secret, $title = null) {
        $urlencoded = urlencode('otpauth://totp/'.$name.'?secret='.$secret.'');
	if(isset($title)) {
                $urlencoded .= urlencode('&issuer='.urlencode($title));
        }
        return 'https://chart.googleapis.com/chart?chs=200x200&chld=M|0&cht=qr&chl='.$urlencoded.'';
    }

    /**
     * Kiem tra code
     */
    public function verifyCode($secret, $code, $mytime = 1, $currentTimeSlice = null)
    {
        if ($currentTimeSlice === null) {
            $currentTimeSlice = floor(time() / 30);
        }

        for ($i = -$mytime; $i <= $mytime; $i++) { 

            $calculatedCode = $this->getCode($secret, $currentTimeSlice + $i); // -+30s
            if ($calculatedCode == $code ) {
                return true;
            }
        }

        return false;
    }


  
  

}
