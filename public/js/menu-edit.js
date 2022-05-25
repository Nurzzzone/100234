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

/***/ "./resources/js/menu-edit.js":
/*!***********************************!*\
  !*** ./resources/js/menu-edit.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  var buttons = $('button[data-name="editModalButton"]');
  var form = $('#editForm');
  var url = $(form).data('url');
  var target;
  $('#menu-input-parent').change(function () {
    if ($(this).val() !== '_') {
      $('#menu-input-slug').find('option[value="dropdown"]').attr('disabled', true);
      $('#menu-input-slug').val('link');
    } else {
      $('#menu-input-slug').find('option[value="dropdown"]').attr('disabled', false);
    }
  });
  buttons.each(function (i, button) {
    $(button).on('click', function (e) {
      e.stopPropagation();
      target = $(button).data('target');
      $.ajax({
        url: '/menu/' + target,
        success: function success(data) {
          $('#menu-input-name').val(data.name);
          $('#menu-input-link').val(data.href);
          $('#menu-input-icon').val(data.icon);
          $('#menu-input-sequence').val(data.sequence);

          if (data.slug === 'dropdown') {
            $('#menu-input-parent').find("option[value=\"".concat(data.parent_id, "\"]")).hide();
          }

          if (data.parent_id) {
            $('#menu-input-parent').val(data.parent_id);
          }

          $('#menu-input-slug').val(data.slug);
        },
        error: function error() {
          alert('Произошла ошибка. Попробуйте еще раз!');
        }
      });
      form.attr('action', url + target);
      $('#update-modal').modal('show');
    });
  }); // form.submit(function(e) {
  //     e.preventDefault();
  //
  //     $.ajax({
  //         url: '/menu/element/updateElement/' + target,
  //         method: 'PUT',
  //         headers: {
  //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //         },
  //         data: $(this).serialize(),
  //         success: function() {
  //             $('#update-modal').hide();
  //         }
  //     })
  // })
});

/***/ }),

/***/ 2:
/*!*****************************************!*\
  !*** multi ./resources/js/menu-edit.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\OpenServer\domains\admin.akulan.kz\resources\js\menu-edit.js */"./resources/js/menu-edit.js");


/***/ })

/******/ });