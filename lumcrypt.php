<?php
class LumCrypt{
public function encrypt($str, $key){
$str = $this->uncyrillic($str);
$str = $this->s2b($str);
$str = $this->cAB($str, $key);
$str = $this->bukvaizer($str);
return $str;
}

public function decrypt($str, $key){
$str = $this->unbukvaizer($str);
$str = $this->unCAB($str, $key);
$str = $this->b2s($str);
$str = $this->cyrillic($str);
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
$key = explode(' ', $this->s2b($key)); $key = array_sum($key) / count($key); $key = $key * 10; $key = (int)"-$key";
//echo "$key <br>";
$arr = explode(" ", $str);
foreach ($arr as &$elem){
$elem = (int)$elem;
$elem = $elem / $key;
}




return implode('',$arr);


}




private function unCAB($str, $key){
$key = explode(' ', $this->s2b($key)); $key = array_sum($key) / count($key); $key = $key * 10; $key = (int)"-$key";
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




private function uncyrillic($str){
    $arr1 = ['а','б','в','г','д','е','ё','ж','з','и','й','к',"л","м","н","о","п","р","с","т","у","ф","х","ц","ч","ш","щ","ъ","ы","ь","э","ю","я",'А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К',"Л","М","Н","О","П","Р","С","Т","У","Ф","Х","Ц","Ч","Ш","Щ","Ъ","Ы","Ь","Э","Ю","Я", "%"];
    $arr2 = ['&/1&','&/2&','&/3&','&/4&','&/5&','&/6&','&/7&','&/8&','&/9&','&/10&','&/11&','&/12&','&/13&','&/14&','&/15&','&/16&','&/17&','&/18&','&/19&','&/20&','&/21&','&/22&','&/23&','&/24&','&/25&','&/26&','&/27&','&/28&','&/29&','&/30&','&/31&','&/32&','&/33&','&/1s&','&/2s&','&/3s&','&/4s&','&/5s&','&/6s&','&/7s&','&/8s&','&/9s&','&/10s&','&/11s&','&/12s&','&/13s&','&/14s&','&/15s&','&/16s&','&/17s&','&/18s&','&/19s&','&/20s&','&/21s&','&/22s&','&/23s&','&/24s&','&/25s&','&/26s&','&/27s&','&/28s&','&/29s&','&/30s&','&/31s&','&/32s&','&/33s&', "&/34&"];
return str_replace($arr1, $arr2, $str);
}

private function cyrillic($str){

    $arr1 = ['а','б','в','г','д','е','ё','ж','з','и','й','к',"л","м","н","о","п","р","с","т","у","ф","х","ц","ч","ш","щ","ъ","ы","ь","э","ю","я",'А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К',"Л","М","Н","О","П","Р","С","Т","У","Ф","Х","Ц","Ч","Ш","Щ","Ъ","Ы","Ь","Э","Ю","Я", "%"];
    $arr2 = ['&/1&','&/2&','&/3&','&/4&','&/5&','&/6&','&/7&','&/8&','&/9&','&/10&','&/11&','&/12&','&/13&','&/14&','&/15&','&/16&','&/17&','&/18&','&/19&','&/20&','&/21&','&/22&','&/23&','&/24&','&/25&','&/26&','&/27&','&/28&','&/29&','&/30&','&/31&','&/32&','&/33&','&/1s&','&/2s&','&/3s&','&/4s&','&/5s&','&/6s&','&/7s&','&/8s&','&/9s&','&/10s&','&/11s&','&/12s&','&/13s&','&/14s&','&/15s&','&/16s&','&/17s&','&/18s&','&/19s&','&/20s&','&/21s&','&/22s&','&/23s&','&/24s&','&/25s&','&/26s&','&/27s&','&/28s&','&/29s&','&/30s&','&/31s&','&/32s&','&/33s&', "&/34&"];
return str_replace($arr2, $arr1, $str);

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
