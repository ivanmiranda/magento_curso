<?php
/**
* Google2Step
*
* @author Iván Miranda
* @package Google2Step
*/

/**
* Esta clase permite generar las llaves que Google
* puede aceptar como un passphrase válido para la
* aplicación de autenticación en dos pasos, así como
* calcular los códigos sincronizados
*/

include('FixedBitNotation.php');

class Sincco_Google2Step {
    static $LONGITUD_CODIGO = 6;
    static $PIN_MODULO;
    static $LONGITUD_LLAVE = 10;
    
    public function __construct() {
        self::$PIN_MODULO = pow(10, self::$LONGITUD_CODIGO);
    }
    
    public function validaCodigo($secret,$code) {
        $time = floor(time() / 30);
        for ( $i = -1; $i <= 1; $i++) {
            if ($this->generaCodigo($secret,$time + $i) == $code) {
                return true;
            }
        }
        
        return false;
        
    }
    
    public function generaCodigo($secret,$time = null) {
        if (!$time) {
            $time = floor(time() / 30);
        }
        $base32 = new FixedBitNotation(5, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567', TRUE, TRUE);
        $secret = $base32->decode($secret);
        
        $time = pack("N", $time);
        $time = str_pad($time,8, chr(0), STR_PAD_LEFT);
        
        $hash = hash_hmac('sha1',$time,$secret,true);
        $offset = ord(substr($hash,-1));
        $offset = $offset & 0xF;
        
        $truncatedHash = self::hashEntero($hash, $offset) & 0x7FFFFFFF;
        $pinValue = str_pad($truncatedHash % self::$PIN_MODULO,6,"0",STR_PAD_LEFT);;
        return $pinValue;
    }
    
    protected  function hashEntero($bytes, $start) {
        $input = substr($bytes, $start, strlen($bytes) - $start);
        $val2 = unpack("N",substr($input,0,4));
        return $val2[1];
    }
    
    public function urlQR($user, $hostname, $secret) {
        $url =  urlencode(sprintf("otpauth://totp/%s@%s?secret=%s", $user, $hostname, $secret));
        $encoderURL = "https://chart.googleapis.com/chart?chs=200x200&chld=M|0&cht=qr&chl=".$url;        
        return $encoderURL;        
    }
    
    public function generaLlave() {
        $secret = "";
        for($i = 1;  $i<= self::$LONGITUD_LLAVE;$i++) {
            $c = rand(0,255);
            $secret .= pack("c",$c);
        }
        $base32 = new FixedBitNotation(5, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567', TRUE, TRUE);
        return  $base32->encode($secret);
    }
    
}

