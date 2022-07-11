/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/quill.js":
/*!*******************************!*\
  !*** ./resources/js/quill.js ***!
  \*******************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  'use strict';

  var editors = $('div[data-name="editor"]');
  var Font = Quill["import"]('formats/font');
  Font.whitelist = ['inconsolata', 'roboto', 'mirza', 'arial'];
  Quill.register(Font, true);
  var toolbarOptions = [[{
    'header': [4, 5, 6, false]
  }], ['bold', 'italic', 'underline'], [{
    'indent': '-1'
  }, {
    'indent': '+1'
  }], [{
    'list': 'bullet'
  }, {
    'list': 'ordered'
  }], [{
    'align': []
  }]];
  $(editors).each(function (index, editor) {
    var placeholder = $(editor).data('placeholder');
    var quill = new Quill(editor, {
      modules: {
        toolbar: toolbarOptions
      },
      placeholder: placeholder,
      theme: 'snow' // or 'bubble'

    });
    var editorTarget = $(editor).prev().prev();
    var editorObserver = new MutationObserver(function (mutations) {
      mutations.forEach(function (mutation) {
        var value = '';

        if ($(editor).find('div[class="ql-editor"]').length) {
          value = $(editor).find('div[class="ql-editor"]')[0].innerHTML;
        }

        $(editorTarget).val(value);
      });
    });
    editorObserver.observe(editor, {
      characterData: true,
      subtree: true,
      childList: true
    });
  });
  var editorsValue = $('td[data-name="editorValue"]');

  if (editorsValue.length) {
    setTargetValue();
  } else {
    editorsValue = $('input[data-name="editorTarget"]');
    setTargetContent(editorsValue);
  }

  function setTargetValue() {
    editorsValue.each(function (index, editorValue) {
      var html = $(editorValue).data('value');
      $(editorValue).html(html);
    });
  }

  function setTargetContent(editorsValue) {
    editorsValue.each(function (index, editorValue) {
      var value = $(editorValue).data('value');
      var editor = $(editorValue).next().next($('div[data-name="editor"]'));
      var target = $(editor).find('.ql-editor');
      target.html(value);
    });
  }
});

/***/ }),

/***/ 2:
/*!*************************************!*\
  !*** multi ./resources/js/quill.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Nurdaulet\web\laravel-admin-panel\resources\js\quill.js */"./resources/js/quill.js");


/***/ })

/******/ });