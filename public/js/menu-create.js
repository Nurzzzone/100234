!function(e){var t={};function n(o){if(t[o])return t[o].exports;var d=t[o]={i:o,l:!1,exports:{}};return e[o].call(d.exports,d,d.exports,n),d.l=!0,d.exports}n.m=e,n.c=t,n.d=function(e,t,o){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:o})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var o=Object.create(null);if(n.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var d in e)n.d(o,d,function(t){return e[t]}.bind(null,d));return o},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="/",n(n.s=0)}([function(e,t,n){n(1),e.exports=n(4)},function(e,t){var n=this;this.buildSelectParent=function(e){for(var t='<option value="none">Do not have parent</option>',n=0;n<e.length;n++)t+='<option value="'+e[n].id+'">'+e[n].name+"</option>";return t},this.updateSelectParent=function(){axios.get("/menu/element/get-parents?menu="+document.getElementById("menu").value).then((function(e){document.getElementById("parent").innerHTML=n.buildSelectParent(e.data)})).catch((function(e){console.log(e)}))},this.toggleDivs=function(){var e=document.getElementById("type").value;"title"===e?(document.getElementById("div-href").classList.add("d-none"),document.getElementById("div-dropdown-parent").classList.add("d-none"),document.getElementById("div-icon").classList.add("d-none")):"link"===e?(document.getElementById("div-href").classList.remove("d-none"),document.getElementById("div-dropdown-parent").classList.remove("d-none"),document.getElementById("div-icon").classList.remove("d-none")):(document.getElementById("div-href").classList.add("d-none"),document.getElementById("div-dropdown-parent").classList.remove("d-none"),document.getElementById("div-icon").classList.remove("d-none"))},this.updateSelectParent(),this.toggleDivs(),document.getElementById("menu").onchange=function(){n.updateSelectParent()},document.getElementById("type").onchange=function(){n.toggleDivs()}},,,function(e,t){}]);