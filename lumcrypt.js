const lumCrypt = {};
lumCrypt.decrypt = function(str, key){
		str = unbukvaizer(str);
		str = unCAB(str, key);
	str = b2s(str);
	console.log(str);
	str = decodeURI(str);
		return(str);

	}

	function unCAB (str, key){
	key = s2b(key);
	key = key.split(' ');
	let keyCount = key.length;
	key = key.reduce(function(sum, elem) {
	return sum + Number(elem);
	}, 0);
	//keyCount = keyCount + 1;
	key = key / keyCount;
	key = String(key).replace('.', '');
	key = '-' + key
		key = key.slice(0, 7);
    key = Number(key)
	console.log('ключ в жс: ' + key)
	let arr = str.split('-');
    


arr.forEach(function(item, i, arr) {
	item = -1 * Number(item);
	item = item * key;
	arr[i] = Math.round(item);
});
//console.log(arr)
	arr.splice(arr.indexOf(0), 1);
	return(arr.join(' '));
	}
	function bukvaizer (str){
    let en = ['a','f','h','j','w','t','l','k','v','n','z','.'];
    let ru = ['-','1','2','3','4','5','6','7','8','9','0','.'];
    const transliterateArray = arr => arr.map(letter => ru.indexOf(letter) >= 0 ? en[ru.indexOf(letter)] : letter);
    const transliterateString = str => transliterateArray(str.split('')).join('');
    return(transliterateString(str));

	}
	function unbukvaizer (str){
    let ru = ['a','f','h','j','w','t','l','k','v','n','z','.'];
    let en = ['-','1','2','3','4','5','6','7','8','9','0','.'];
    const transliterateArray = arr => arr.map(letter => ru.indexOf(letter) >= 0 ? en[ru.indexOf(letter)] : letter);
    const transliterateString = str => transliterateArray(str.split('')).join('');
    return(transliterateString(str));

	}
function s2b(str) {
   let res = '';
   res = str.split('').map(char => {
      return char.charCodeAt(0).toString(2);
   }).join(' ');
   return res;
};


    function b2s(binary) {
    binary = binary.split(' ');
    return binary.map(elem => String.fromCharCode(parseInt(elem, 2))).join("");
    }
function strArrReplacer(str, arr1, arr2){
arr1.forEach(function(item, i, arr) {
	str = str.replaceAll(item, arr2[i]);
});
	return str;
}
