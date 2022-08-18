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
