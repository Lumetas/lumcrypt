<?php
class LumCrypt{
public function encrypt($str, $key){
$str = base64_encode($str);
$str = $this->s2b($str);
$str = $this->cAB($str, $key);
$str = $this->bukvaizer($str);
return $str;
}

public function decrypt($str, $key){
$str = $this->unbukvaizer($str);
$str = $this->unCAB($str, $key);
$str = $this->b2s($str);
$str = base64_decode($str);
return $str;


}
private function s2b($string){
    $characters = str_split($string);
 
    $binary = [];
    foreach ($characters as $character) {
        $data = unpack('H*', $character);
        $binary[] = base_convert($data[1], 16, 2);
    }
 
    return implode(' ', $binary);    
}
private function b2s($binary){
    $binaries = explode(' ', $binary);
 
    $string = null;
    foreach ($binaries as $binary) {
        $string .= pack('H*', dechex(bindec($binary)));
    }
 
    return $string;    
}
private function cAB($str, $key){
$key = explode(' ', $this->s2b($key));
$i = 0;
foreach ($key as &$v){
    $v = (int)$v * ($i * 2);
    $i += 1;

}
$key = array_sum($key) / count($key); $key = $key * 1; $key = (int)"-$key";
echo "Ключ в пхп: $key <br>";
$arr = explode(" ", $str);
foreach ($arr as &$elem){
$elem = (int)$elem;
$elem = $elem / $key;
}




return implode('',$arr);


}




private function unCAB($str, $key){
$key = explode(' ', $this->s2b($key));

$i = 0;
foreach ($key as &$v){
    $v = (int)$v * ($i * 2);
    $i += 1;

}

$key = array_sum($key) / count($key); $key = $key * 1; $key = (int)"-$key";
//echo "$key <br>";
$arr = explode("-", $str);




foreach ($arr as &$elem){
$elem = -1 * (float)$elem;
$elem = $elem * $key;
$elem = round($elem);

}

unset($arr[array_search(0, $arr)]);


return implode(' ',$arr);


}





private function bukvaizer($str){
 $arr1 = ['-','1','2','3','4','5','6','7','8','9','0','.'];
 $arr2 = ['a','f','h','j','w','t','l','k','v','n','z','.'];
$arr = str_split($str);
foreach ($arr as &$elem){
$elem = $arr2[array_search($elem, $arr1)];
}
return implode('',$arr);
}

private function unbukvaizer($str){

 $arr2 = ['-','1','2','3','4','5','6','7','8','9','0','.'];
 $arr1 = ['a','f','h','j','w','t','l','k','v','n','z','.'];
$arr = str_split($str);
foreach ($arr as &$elem){
$elem = $arr2[array_search($elem, $arr1)];
}
return implode('',$arr);

}

}
