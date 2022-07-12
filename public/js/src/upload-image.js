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
/******/ 	return __webpack_require__(__webpack_require__.s = 6);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/upload-image.js":
/*!**************************************!*\
  !*** ./resources/js/upload-image.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  var uploadImageDiv = $('.avatar-upload'),
      prevFile = $('#prevImage'),
      fileInput = $('#imageUpload'); // setup

  uploadImageDiv.each(function (index, block) {
    var deleteButton = $(block).find('button[data-name="deleteButton"]'),
        imagePreview = $(block).find('div[data-name="imagePreview"]'),
        imageInput = $(block).find('input[data-name="imageUpload"]'),
        prevImage = $(block).find('input[data-name="prevImage"]');
    $(imageInput).change(function () {
      readURL(this, imagePreview, deleteButton, prevImage);
    });
    $(deleteButton).click(function (e) {
      e.preventDefault();
      setDeleteButton(this, imagePreview, imageInput, prevImage);
    });
  });
  $(fileInput).next('.custom-file-label').html($(prevFile).val());
  $(fileInput).change(function () {
    var fileName = $(this).val();
    $(this).next('.custom-file-label').html(fileName);
    readFileUrl(this);
  }); // For image

  function readURL(input, imagePreview, deleteButton, prevImage) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $(imagePreview).css('background-image', 'url(' + e.target.result + ')');
        $(deleteButton).removeAttr('disabled');
        $(deleteButton).removeClass('d-none');

        if ($(prevImage).val() !== null && $(prevImage).val() !== '') {
          $(prevImage).val('');
        }
      };

      reader.readAsDataURL(input.files[0]);
    }
  } // for files


  function readFileUrl(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function () {
        if ($(prevFile).val() !== null && $(prevFile).val() !== '') {
          $(prevFile).val('');
        }
      };

      reader.readAsDataURL(input.files[0]);
    }
  } // set delete button


  function setDeleteButton(button, imagePreview, imageInput, prevImage) {
    var image = $(button).data('default');
    $(imagePreview).css('background-image', "url(".concat(image, ")"));
    $(button).addClass('d-none');
    $(button).attr('disabled', 'disabled');
    $(imageInput).val('');

    if ($(prevImage).val() !== null && $(prevImage).val() !== '') {
      $(prevImage).val('');
    }
  }
});

/***/ }),

/***/ 6:
/*!********************************************!*\
  !*** multi ./resources/js/upload-image.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\OpenServer\domains\10032\resources\js\upload-image.js */"./resources/js/upload-image.js");


/***/ })

/******/ });