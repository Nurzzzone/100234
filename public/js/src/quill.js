!function(e){var t={};function n(r){if(t[r])return t[r].exports;var o=t[r]={i:r,l:!1,exports:{}};return e[r].call(o.exports,o,o.exports,n),o.l=!0,o.exports}n.m=e,n.c=t,n.d=function(e,t,r){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(n.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)n.d(r,o,function(t){return e[t]}.bind(null,o));return r},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="/",n(n.s=54)}({54:function(e,t,n){e.exports=n(55)},55:function(e,t){$(document).ready((function(){"use strict";var e=$('div[data-name="editor"]'),t=Quill.import("formats/font");t.whitelist=["inconsolata","roboto","mirza","arial"],Quill.register(t,!0);var n=[[{header:[4,5,6,!1]}],["bold","italic","underline"],[{indent:"-1"},{indent:"+1"}],[{list:"bullet"},{list:"ordered"}],[{align:[]}]];$(e).each((function(e,t){var r=$(t).data("placeholder"),o=(new Quill(t,{modules:{toolbar:n},placeholder:r,theme:"snow"}),$(t).prev().prev());new MutationObserver((function(e){e.forEach((function(e){var n="";$(t).find('div[class="ql-editor"]').length&&(n=$(t).find('div[class="ql-editor"]')[0].innerHTML),$(o).val(n)}))})).observe(t,{characterData:!0,subtree:!0,childList:!0})}));var r=$('td[data-name="editorValue"]');r.length?r.each((function(e,t){var n=$(t).data("value");$(t).html(n)})):function(e){e.each((function(e,t){var n=$(t).data("value"),r=$(t).next().next($('div[data-name="editor"]'));$(r).find(".ql-editor").html(n)}))}(r=$('input[data-name="editorTarget"]'))}))}});