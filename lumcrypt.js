const lumCrypt = {};
lumCrypt.decrypt = function(str, key){
		str = unbukvaizer(str);
		str = unCAB(str, key);
		str = b2s(str);
		str = cyrillic(str);
		return(str);

	}

    function cyrillic(str){
		let en = ['/1','/2','/3','/4','/5','/6','/7','/8','/9','/10','/11','/12','/13','/14','/15','/16','/17','/18','/19','/20','/21','/22','/23','/24','/25','/26','/27','/28','/29','/30','/31','/32','/33','/1s','/2s','/3s','/4s','/5s','/6s','/7s','/8s','/9s','/10s','/11s','/12s','/13s','/14s','/15s','/16s','/17s','/18s','/19s','/20s','/21s','/22s','/23s','/24s','/25s','/26s','/27s','/28s','/29s','/30s','/31s','/32s','/33s'];
		 let ru = ['а','б','в','г','д','е','ё','ж','з','и','й','к',"л","м","н","о","п","р","с","т","у","ф","х","ц","ч","ш","щ","ъ","ы","ь","э","ю","я",'А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К',"Л","М","Н","О","П","Р","С","Т","У","Ф","Х","Ц","Ч","Ш","Щ","Ъ","Ы","Ь","Э","Ю","Я"];
	arr = str.split('%');
	arr.forEach(function(item, i, arr) {
		if (en.indexOf(item) !== -1){
			item = ru[en.indexOf(item)];
		}
	arr[i] = item;
	});
	str = arr.join('');
	return(str);
}
    function uncyrillic (str){
		let en = ['/1','/2','/3','/4','/5','/6','/7','/8','/9','/10','/11','/12','/13','/14','/15','/16','/17','/18','/19','/20','/21','/22','/23','/24','/25','/26','/27','/28','/29','/30','/31','/32','/33','/1s','/2s','/3s','/4s','/5s','/6s','/7s','/8s','/9s','/10s','/11s','/12s','/13s','/14s','/15s','/16s','/17s','/18s','/19s','/20s','/21s','/22s','/23s','/24s','/25s','/26s','/27s','/28s','/29s','/30s','/31s','/32s','/33s'];
		 let ru = ['а','б','в','г','д','е','ё','ж','з','и','й','к',"л","м","н","о","п","р","с","т","у","ф","х","ц","ч","ш","щ","ъ","ы","ь","э","ю","я",'А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К',"Л","М","Н","О","П","Р","С","Т","У","Ф","Х","Ц","Ч","Ш","Щ","Ъ","Ы","Ь","Э","Ю","Я"];

	arr = str.split('');
	arr.forEach(function(item, i, arr) {
		if (ru.indexOf(item) !== -1){
			item = en[ru.indexOf(item)];
		}
	arr[i] = item;
	});
	str = arr.join('');
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
	key = Number(key)
	//console.log(key)
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
