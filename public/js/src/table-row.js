!function(e){var n={};function t(r){if(n[r])return n[r].exports;var o=n[r]={i:r,l:!1,exports:{}};return e[r].call(o.exports,o,o.exports,t),o.l=!0,o.exports}t.m=e,t.c=n,t.d=function(e,n,r){t.o(e,n)||Object.defineProperty(e,n,{enumerable:!0,get:r})},t.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},t.t=function(e,n){if(1&n&&(e=t(e)),8&n)return e;if(4&n&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(t.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&n&&"string"!=typeof e)for(var o in e)t.d(r,o,function(n){return e[n]}.bind(null,o));return r},t.n=function(e){var n=e&&e.__esModule?function(){return e.default}:function(){return e};return t.d(n,"a",n),n},t.o=function(e,n){return Object.prototype.hasOwnProperty.call(e,n)},t.p="/",t(t.s=56)}({56:function(e,n,t){e.exports=t(57)},57:function(e,n){$(document).ready((function(){var e=$('tr[data-name="tableRow"]');$(e).length&&$(e).each((function(e,n){$(n).click((function(){window.location=$(n).data("href")}))}));var n=$(".table"),t=$(n).find("th").length,r=$("#tableEmpty");$(r).length&&$(r).attr("colspan",t),$("#dismiss-success-button").on("click",(function(e){e.preventDefault();var n=$("#success-flash-alert");n.hasClass("d-none")||(n.find(".flash-message").remove(),n.addClass("d-none"))})),$("#dismiss-error-button").on("click",(function(e){e.preventDefault();var n=$("#error-flash-alert");n.hasClass("d-none")||(n.find(".flash-message").remove(),n.addClass("d-none"))}))}))}});