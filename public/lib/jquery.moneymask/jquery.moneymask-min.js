(function(a){a.fn.priceFormat=function(b){var c={prefix:"US$ ",centsSeparator:".",thousandsSeparator:",",limit:false,centsLimit:2,clearPrefix:false,allowNegative:false};var b=a.extend(c,b);return this.each(function(){var k=a(this);var q=/[0-9]/;var l=b.prefix;var d=b.centsSeparator;var r=b.thousandsSeparator;var j=b.limit;var s=b.centsLimit;var i=b.clearPrefix;var o=b.allowNegative;function n(v){var u="";for(var t=0;t<(v.length);t++){tbl_char=v.charAt(t);if(u.length==0&&tbl_char==0){tbl_char=false}if(tbl_char&&tbl_char.match(q)){if(j){if(u.length<j){u=u+tbl_char}}else{u=u+tbl_char}}}return u}function h(t){while(t.length<(s+1)){t="0"+t}return t}function p(y){var w=h(n(y));var x="";var z=0;var t=w.substr(w.length-s,s);var v=w.substr(0,w.length-s);w=v+d+t;if(r){for(var u=v.length;u>0;u--){tbl_char=v.substr(u-1,1);z++;if(z%3==0){tbl_char=r+tbl_char}x=tbl_char+x}if(x.substr(0,1)==r){x=x.substring(1,x.length)}w=x+d+t}if(o&&y.indexOf("-")!=-1&&(v!=0||t!=0)){w="-"+w}if(l){w=l+w}return w}function g(x){var u=(x.keyCode?x.keyCode:x.which);var w=String.fromCharCode(u);var t=false;var y=k.val();var v=p(y+w);if((u>=48&&u<=57)||(u>=96&&u<=105)){t=true}if(u==8){t=true}if(u==9){t=true}if(u==13){t=true}if(u==46){t=true}if(u==37){t=true}if(u==39){t=true}if(o&&(u==189||u==109)){t=true}if(!t){x.preventDefault();x.stopPropagation();if(y!=v){k.val(v)}}}function e(){var u=k.val();var t=p(u);if(u!=t){k.val(t)}}function f(){var t=k.val();k.val(l+t)}function m(){if(a.trim(l)!=""&&i){var t=k.val().split(l);k.val(t[1])}}a(this).bind("keydown",g);a(this).bind("keyup",e);if(i){a(this).bind("focusout",function(){m()});a(this).bind("focusin",function(){f()})}if(a(this).val().length>0){e();m()}})}})(jQuery);