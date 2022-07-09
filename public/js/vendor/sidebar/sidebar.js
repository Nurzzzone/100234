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
/******/ 	return __webpack_require__(__webpack_require__.s = 11);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/perfect-scrollbar/dist/perfect-scrollbar.esm.js":
/*!**********************************************************************!*\
  !*** ./node_modules/perfect-scrollbar/dist/perfect-scrollbar.esm.js ***!
  \**********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/*!
 * perfect-scrollbar v1.5.0
 * Copyright 2020 Hyunje Jun, MDBootstrap and Contributors
 * Licensed under MIT
 */

function get(element) {
  return getComputedStyle(element);
}

function set(element, obj) {
  for (var key in obj) {
    var val = obj[key];
    if (typeof val === 'number') {
      val = val + "px";
    }
    element.style[key] = val;
  }
  return element;
}

function div(className) {
  var div = document.createElement('div');
  div.className = className;
  return div;
}

var elMatches =
  typeof Element !== 'undefined' &&
  (Element.prototype.matches ||
    Element.prototype.webkitMatchesSelector ||
    Element.prototype.mozMatchesSelector ||
    Element.prototype.msMatchesSelector);

function matches(element, query) {
  if (!elMatches) {
    throw new Error('No element matching method supported');
  }

  return elMatches.call(element, query);
}

function remove(element) {
  if (element.remove) {
    element.remove();
  } else {
    if (element.parentNode) {
      element.parentNode.removeChild(element);
    }
  }
}

function queryChildren(element, selector) {
  return Array.prototype.filter.call(element.children, function (child) { return matches(child, selector); }
  );
}

var cls = {
  main: 'ps',
  rtl: 'ps__rtl',
  element: {
    thumb: function (x) { return ("ps__thumb-" + x); },
    rail: function (x) { return ("ps__rail-" + x); },
    consuming: 'ps__child--consume',
  },
  state: {
    focus: 'ps--focus',
    clicking: 'ps--clicking',
    active: function (x) { return ("ps--active-" + x); },
    scrolling: function (x) { return ("ps--scrolling-" + x); },
  },
};

/*
 * Helper methods
 */
var scrollingClassTimeout = { x: null, y: null };

function addScrollingClass(i, x) {
  var classList = i.element.classList;
  var className = cls.state.scrolling(x);

  if (classList.contains(className)) {
    clearTimeout(scrollingClassTimeout[x]);
  } else {
    classList.add(className);
  }
}

function removeScrollingClass(i, x) {
  scrollingClassTimeout[x] = setTimeout(
    function () { return i.isAlive && i.element.classList.remove(cls.state.scrolling(x)); },
    i.settings.scrollingThreshold
  );
}

function setScrollingClassInstantly(i, x) {
  addScrollingClass(i, x);
  removeScrollingClass(i, x);
}

var EventElement = function EventElement(element) {
  this.element = element;
  this.handlers = {};
};

var prototypeAccessors = { isEmpty: { configurable: true } };

EventElement.prototype.bind = function bind (eventName, handler) {
  if (typeof this.handlers[eventName] === 'undefined') {
    this.handlers[eventName] = [];
  }
  this.handlers[eventName].push(handler);
  this.element.addEventListener(eventName, handler, false);
};

EventElement.prototype.unbind = function unbind (eventName, target) {
    var this$1 = this;

  this.handlers[eventName] = this.handlers[eventName].filter(function (handler) {
    if (target && handler !== target) {
      return true;
    }
    this$1.element.removeEventListener(eventName, handler, false);
    return false;
  });
};

EventElement.prototype.unbindAll = function unbindAll () {
  for (var name in this.handlers) {
    this.unbind(name);
  }
};

prototypeAccessors.isEmpty.get = function () {
    var this$1 = this;

  return Object.keys(this.handlers).every(
    function (key) { return this$1.handlers[key].length === 0; }
  );
};

Object.defineProperties( EventElement.prototype, prototypeAccessors );

var EventManager = function EventManager() {
  this.eventElements = [];
};

EventManager.prototype.eventElement = function eventElement (element) {
  var ee = this.eventElements.filter(function (ee) { return ee.element === element; })[0];
  if (!ee) {
    ee = new EventElement(element);
    this.eventElements.push(ee);
  }
  return ee;
};

EventManager.prototype.bind = function bind (element, eventName, handler) {
  this.eventElement(element).bind(eventName, handler);
};

EventManager.prototype.unbind = function unbind (element, eventName, handler) {
  var ee = this.eventElement(element);
  ee.unbind(eventName, handler);

  if (ee.isEmpty) {
    // remove
    this.eventElements.splice(this.eventElements.indexOf(ee), 1);
  }
};

EventManager.prototype.unbindAll = function unbindAll () {
  this.eventElements.forEach(function (e) { return e.unbindAll(); });
  this.eventElements = [];
};

EventManager.prototype.once = function once (element, eventName, handler) {
  var ee = this.eventElement(element);
  var onceHandler = function (evt) {
    ee.unbind(eventName, onceHandler);
    handler(evt);
  };
  ee.bind(eventName, onceHandler);
};

function createEvent(name) {
  if (typeof window.CustomEvent === 'function') {
    return new CustomEvent(name);
  } else {
    var evt = document.createEvent('CustomEvent');
    evt.initCustomEvent(name, false, false, undefined);
    return evt;
  }
}

function processScrollDiff(
  i,
  axis,
  diff,
  useScrollingClass,
  forceFireReachEvent
) {
  if ( useScrollingClass === void 0 ) useScrollingClass = true;
  if ( forceFireReachEvent === void 0 ) forceFireReachEvent = false;

  var fields;
  if (axis === 'top') {
    fields = [
      'contentHeight',
      'containerHeight',
      'scrollTop',
      'y',
      'up',
      'down' ];
  } else if (axis === 'left') {
    fields = [
      'contentWidth',
      'containerWidth',
      'scrollLeft',
      'x',
      'left',
      'right' ];
  } else {
    throw new Error('A proper axis should be provided');
  }

  processScrollDiff$1(i, diff, fields, useScrollingClass, forceFireReachEvent);
}

function processScrollDiff$1(
  i,
  diff,
  ref,
  useScrollingClass,
  forceFireReachEvent
) {
  var contentHeight = ref[0];
  var containerHeight = ref[1];
  var scrollTop = ref[2];
  var y = ref[3];
  var up = ref[4];
  var down = ref[5];
  if ( useScrollingClass === void 0 ) useScrollingClass = true;
  if ( forceFireReachEvent === void 0 ) forceFireReachEvent = false;

  var element = i.element;

  // reset reach
  i.reach[y] = null;

  // 1 for subpixel rounding
  if (element[scrollTop] < 1) {
    i.reach[y] = 'start';
  }

  // 1 for subpixel rounding
  if (element[scrollTop] > i[contentHeight] - i[containerHeight] - 1) {
    i.reach[y] = 'end';
  }

  if (diff) {
    element.dispatchEvent(createEvent(("ps-scroll-" + y)));

    if (diff < 0) {
      element.dispatchEvent(createEvent(("ps-scroll-" + up)));
    } else if (diff > 0) {
      element.dispatchEvent(createEvent(("ps-scroll-" + down)));
    }

    if (useScrollingClass) {
      setScrollingClassInstantly(i, y);
    }
  }

  if (i.reach[y] && (diff || forceFireReachEvent)) {
    element.dispatchEvent(createEvent(("ps-" + y + "-reach-" + (i.reach[y]))));
  }
}

function toInt(x) {
  return parseInt(x, 10) || 0;
}

function isEditable(el) {
  return (
    matches(el, 'input,[contenteditable]') ||
    matches(el, 'select,[contenteditable]') ||
    matches(el, 'textarea,[contenteditable]') ||
    matches(el, 'button,[contenteditable]')
  );
}

function outerWidth(element) {
  var styles = get(element);
  return (
    toInt(styles.width) +
    toInt(styles.paddingLeft) +
    toInt(styles.paddingRight) +
    toInt(styles.borderLeftWidth) +
    toInt(styles.borderRightWidth)
  );
}

var env = {
  isWebKit:
    typeof document !== 'undefined' &&
    'WebkitAppearance' in document.documentElement.style,
  supportsTouch:
    typeof window !== 'undefined' &&
    ('ontouchstart' in window ||
      ('maxTouchPoints' in window.navigator &&
        window.navigator.maxTouchPoints > 0) ||
      (window.DocumentTouch && document instanceof window.DocumentTouch)),
  supportsIePointer:
    typeof navigator !== 'undefined' && navigator.msMaxTouchPoints,
  isChrome:
    typeof navigator !== 'undefined' &&
    /Chrome/i.test(navigator && navigator.userAgent),
};

function updateGeometry(i) {
  var element = i.element;
  var roundedScrollTop = Math.floor(element.scrollTop);
  var rect = element.getBoundingClientRect();

  i.containerWidth = Math.ceil(rect.width);
  i.containerHeight = Math.ceil(rect.height);
  i.contentWidth = element.scrollWidth;
  i.contentHeight = element.scrollHeight;

  if (!element.contains(i.scrollbarXRail)) {
    // clean up and append
    queryChildren(element, cls.element.rail('x')).forEach(function (el) { return remove(el); }
    );
    element.appendChild(i.scrollbarXRail);
  }
  if (!element.contains(i.scrollbarYRail)) {
    // clean up and append
    queryChildren(element, cls.element.rail('y')).forEach(function (el) { return remove(el); }
    );
    element.appendChild(i.scrollbarYRail);
  }

  if (
    !i.settings.suppressScrollX &&
    i.containerWidth + i.settings.scrollXMarginOffset < i.contentWidth
  ) {
    i.scrollbarXActive = true;
    i.railXWidth = i.containerWidth - i.railXMarginWidth;
    i.railXRatio = i.containerWidth / i.railXWidth;
    i.scrollbarXWidth = getThumbSize(
      i,
      toInt((i.railXWidth * i.containerWidth) / i.contentWidth)
    );
    i.scrollbarXLeft = toInt(
      ((i.negativeScrollAdjustment + element.scrollLeft) *
        (i.railXWidth - i.scrollbarXWidth)) /
        (i.contentWidth - i.containerWidth)
    );
  } else {
    i.scrollbarXActive = false;
  }

  if (
    !i.settings.suppressScrollY &&
    i.containerHeight + i.settings.scrollYMarginOffset < i.contentHeight
  ) {
    i.scrollbarYActive = true;
    i.railYHeight = i.containerHeight - i.railYMarginHeight;
    i.railYRatio = i.containerHeight / i.railYHeight;
    i.scrollbarYHeight = getThumbSize(
      i,
      toInt((i.railYHeight * i.containerHeight) / i.contentHeight)
    );
    i.scrollbarYTop = toInt(
      (roundedScrollTop * (i.railYHeight - i.scrollbarYHeight)) /
        (i.contentHeight - i.containerHeight)
    );
  } else {
    i.scrollbarYActive = false;
  }

  if (i.scrollbarXLeft >= i.railXWidth - i.scrollbarXWidth) {
    i.scrollbarXLeft = i.railXWidth - i.scrollbarXWidth;
  }
  if (i.scrollbarYTop >= i.railYHeight - i.scrollbarYHeight) {
    i.scrollbarYTop = i.railYHeight - i.scrollbarYHeight;
  }

  updateCss(element, i);

  if (i.scrollbarXActive) {
    element.classList.add(cls.state.active('x'));
  } else {
    element.classList.remove(cls.state.active('x'));
    i.scrollbarXWidth = 0;
    i.scrollbarXLeft = 0;
    element.scrollLeft = i.isRtl === true ? i.contentWidth : 0;
  }
  if (i.scrollbarYActive) {
    element.classList.add(cls.state.active('y'));
  } else {
    element.classList.remove(cls.state.active('y'));
    i.scrollbarYHeight = 0;
    i.scrollbarYTop = 0;
    element.scrollTop = 0;
  }
}

function getThumbSize(i, thumbSize) {
  if (i.settings.minScrollbarLength) {
    thumbSize = Math.max(thumbSize, i.settings.minScrollbarLength);
  }
  if (i.settings.maxScrollbarLength) {
    thumbSize = Math.min(thumbSize, i.settings.maxScrollbarLength);
  }
  return thumbSize;
}

function updateCss(element, i) {
  var xRailOffset = { width: i.railXWidth };
  var roundedScrollTop = Math.floor(element.scrollTop);

  if (i.isRtl) {
    xRailOffset.left =
      i.negativeScrollAdjustment +
      element.scrollLeft +
      i.containerWidth -
      i.contentWidth;
  } else {
    xRailOffset.left = element.scrollLeft;
  }
  if (i.isScrollbarXUsingBottom) {
    xRailOffset.bottom = i.scrollbarXBottom - roundedScrollTop;
  } else {
    xRailOffset.top = i.scrollbarXTop + roundedScrollTop;
  }
  set(i.scrollbarXRail, xRailOffset);

  var yRailOffset = { top: roundedScrollTop, height: i.railYHeight };
  if (i.isScrollbarYUsingRight) {
    if (i.isRtl) {
      yRailOffset.right =
        i.contentWidth -
        (i.negativeScrollAdjustment + element.scrollLeft) -
        i.scrollbarYRight -
        i.scrollbarYOuterWidth -
        9;
    } else {
      yRailOffset.right = i.scrollbarYRight - element.scrollLeft;
    }
  } else {
    if (i.isRtl) {
      yRailOffset.left =
        i.negativeScrollAdjustment +
        element.scrollLeft +
        i.containerWidth * 2 -
        i.contentWidth -
        i.scrollbarYLeft -
        i.scrollbarYOuterWidth;
    } else {
      yRailOffset.left = i.scrollbarYLeft + element.scrollLeft;
    }
  }
  set(i.scrollbarYRail, yRailOffset);

  set(i.scrollbarX, {
    left: i.scrollbarXLeft,
    width: i.scrollbarXWidth - i.railBorderXWidth,
  });
  set(i.scrollbarY, {
    top: i.scrollbarYTop,
    height: i.scrollbarYHeight - i.railBorderYWidth,
  });
}

function clickRail(i) {
  var element = i.element;

  i.event.bind(i.scrollbarY, 'mousedown', function (e) { return e.stopPropagation(); });
  i.event.bind(i.scrollbarYRail, 'mousedown', function (e) {
    var positionTop =
      e.pageY -
      window.pageYOffset -
      i.scrollbarYRail.getBoundingClientRect().top;
    var direction = positionTop > i.scrollbarYTop ? 1 : -1;

    i.element.scrollTop += direction * i.containerHeight;
    updateGeometry(i);

    e.stopPropagation();
  });

  i.event.bind(i.scrollbarX, 'mousedown', function (e) { return e.stopPropagation(); });
  i.event.bind(i.scrollbarXRail, 'mousedown', function (e) {
    var positionLeft =
      e.pageX -
      window.pageXOffset -
      i.scrollbarXRail.getBoundingClientRect().left;
    var direction = positionLeft > i.scrollbarXLeft ? 1 : -1;

    i.element.scrollLeft += direction * i.containerWidth;
    updateGeometry(i);

    e.stopPropagation();
  });
}

function dragThumb(i) {
  bindMouseScrollHandler(i, [
    'containerWidth',
    'contentWidth',
    'pageX',
    'railXWidth',
    'scrollbarX',
    'scrollbarXWidth',
    'scrollLeft',
    'x',
    'scrollbarXRail' ]);
  bindMouseScrollHandler(i, [
    'containerHeight',
    'contentHeight',
    'pageY',
    'railYHeight',
    'scrollbarY',
    'scrollbarYHeight',
    'scrollTop',
    'y',
    'scrollbarYRail' ]);
}

function bindMouseScrollHandler(
  i,
  ref
) {
  var containerHeight = ref[0];
  var contentHeight = ref[1];
  var pageY = ref[2];
  var railYHeight = ref[3];
  var scrollbarY = ref[4];
  var scrollbarYHeight = ref[5];
  var scrollTop = ref[6];
  var y = ref[7];
  var scrollbarYRail = ref[8];

  var element = i.element;

  var startingScrollTop = null;
  var startingMousePageY = null;
  var scrollBy = null;

  function mouseMoveHandler(e) {
    if (e.touches && e.touches[0]) {
      e[pageY] = e.touches[0].pageY;
    }
    element[scrollTop] =
      startingScrollTop + scrollBy * (e[pageY] - startingMousePageY);
    addScrollingClass(i, y);
    updateGeometry(i);

    e.stopPropagation();
    e.preventDefault();
  }

  function mouseUpHandler() {
    removeScrollingClass(i, y);
    i[scrollbarYRail].classList.remove(cls.state.clicking);
    i.event.unbind(i.ownerDocument, 'mousemove', mouseMoveHandler);
  }

  function bindMoves(e, touchMode) {
    startingScrollTop = element[scrollTop];
    if (touchMode && e.touches) {
      e[pageY] = e.touches[0].pageY;
    }
    startingMousePageY = e[pageY];
    scrollBy =
      (i[contentHeight] - i[containerHeight]) /
      (i[railYHeight] - i[scrollbarYHeight]);
    if (!touchMode) {
      i.event.bind(i.ownerDocument, 'mousemove', mouseMoveHandler);
      i.event.once(i.ownerDocument, 'mouseup', mouseUpHandler);
      e.preventDefault();
    } else {
      i.event.bind(i.ownerDocument, 'touchmove', mouseMoveHandler);
    }

    i[scrollbarYRail].classList.add(cls.state.clicking);

    e.stopPropagation();
  }

  i.event.bind(i[scrollbarY], 'mousedown', function (e) {
    bindMoves(e);
  });
  i.event.bind(i[scrollbarY], 'touchstart', function (e) {
    bindMoves(e, true);
  });
}

function keyboard(i) {
  var element = i.element;

  var elementHovered = function () { return matches(element, ':hover'); };
  var scrollbarFocused = function () { return matches(i.scrollbarX, ':focus') || matches(i.scrollbarY, ':focus'); };

  function shouldPreventDefault(deltaX, deltaY) {
    var scrollTop = Math.floor(element.scrollTop);
    if (deltaX === 0) {
      if (!i.scrollbarYActive) {
        return false;
      }
      if (
        (scrollTop === 0 && deltaY > 0) ||
        (scrollTop >= i.contentHeight - i.containerHeight && deltaY < 0)
      ) {
        return !i.settings.wheelPropagation;
      }
    }

    var scrollLeft = element.scrollLeft;
    if (deltaY === 0) {
      if (!i.scrollbarXActive) {
        return false;
      }
      if (
        (scrollLeft === 0 && deltaX < 0) ||
        (scrollLeft >= i.contentWidth - i.containerWidth && deltaX > 0)
      ) {
        return !i.settings.wheelPropagation;
      }
    }
    return true;
  }

  i.event.bind(i.ownerDocument, 'keydown', function (e) {
    if (
      (e.isDefaultPrevented && e.isDefaultPrevented()) ||
      e.defaultPrevented
    ) {
      return;
    }

    if (!elementHovered() && !scrollbarFocused()) {
      return;
    }

    var activeElement = document.activeElement
      ? document.activeElement
      : i.ownerDocument.activeElement;
    if (activeElement) {
      if (activeElement.tagName === 'IFRAME') {
        activeElement = activeElement.contentDocument.activeElement;
      } else {
        // go deeper if element is a webcomponent
        while (activeElement.shadowRoot) {
          activeElement = activeElement.shadowRoot.activeElement;
        }
      }
      if (isEditable(activeElement)) {
        return;
      }
    }

    var deltaX = 0;
    var deltaY = 0;

    switch (e.which) {
      case 37: // left
        if (e.metaKey) {
          deltaX = -i.contentWidth;
        } else if (e.altKey) {
          deltaX = -i.containerWidth;
        } else {
          deltaX = -30;
        }
        break;
      case 38: // up
        if (e.metaKey) {
          deltaY = i.contentHeight;
        } else if (e.altKey) {
          deltaY = i.containerHeight;
        } else {
          deltaY = 30;
        }
        break;
      case 39: // right
        if (e.metaKey) {
          deltaX = i.contentWidth;
        } else if (e.altKey) {
          deltaX = i.containerWidth;
        } else {
          deltaX = 30;
        }
        break;
      case 40: // down
        if (e.metaKey) {
          deltaY = -i.contentHeight;
        } else if (e.altKey) {
          deltaY = -i.containerHeight;
        } else {
          deltaY = -30;
        }
        break;
      case 32: // space bar
        if (e.shiftKey) {
          deltaY = i.containerHeight;
        } else {
          deltaY = -i.containerHeight;
        }
        break;
      case 33: // page up
        deltaY = i.containerHeight;
        break;
      case 34: // page down
        deltaY = -i.containerHeight;
        break;
      case 36: // home
        deltaY = i.contentHeight;
        break;
      case 35: // end
        deltaY = -i.contentHeight;
        break;
      default:
        return;
    }

    if (i.settings.suppressScrollX && deltaX !== 0) {
      return;
    }
    if (i.settings.suppressScrollY && deltaY !== 0) {
      return;
    }

    element.scrollTop -= deltaY;
    element.scrollLeft += deltaX;
    updateGeometry(i);

    if (shouldPreventDefault(deltaX, deltaY)) {
      e.preventDefault();
    }
  });
}

function wheel(i) {
  var element = i.element;

  function shouldPreventDefault(deltaX, deltaY) {
    var roundedScrollTop = Math.floor(element.scrollTop);
    var isTop = element.scrollTop === 0;
    var isBottom =
      roundedScrollTop + element.offsetHeight === element.scrollHeight;
    var isLeft = element.scrollLeft === 0;
    var isRight =
      element.scrollLeft + element.offsetWidth === element.scrollWidth;

    var hitsBound;

    // pick axis with primary direction
    if (Math.abs(deltaY) > Math.abs(deltaX)) {
      hitsBound = isTop || isBottom;
    } else {
      hitsBound = isLeft || isRight;
    }

    return hitsBound ? !i.settings.wheelPropagation : true;
  }

  function getDeltaFromEvent(e) {
    var deltaX = e.deltaX;
    var deltaY = -1 * e.deltaY;

    if (typeof deltaX === 'undefined' || typeof deltaY === 'undefined') {
      // OS X Safari
      deltaX = (-1 * e.wheelDeltaX) / 6;
      deltaY = e.wheelDeltaY / 6;
    }

    if (e.deltaMode && e.deltaMode === 1) {
      // Firefox in deltaMode 1: Line scrolling
      deltaX *= 10;
      deltaY *= 10;
    }

    if (deltaX !== deltaX && deltaY !== deltaY /* NaN checks */) {
      // IE in some mouse drivers
      deltaX = 0;
      deltaY = e.wheelDelta;
    }

    if (e.shiftKey) {
      // reverse axis with shift key
      return [-deltaY, -deltaX];
    }
    return [deltaX, deltaY];
  }

  function shouldBeConsumedByChild(target, deltaX, deltaY) {
    // FIXME: this is a workaround for <select> issue in FF and IE #571
    if (!env.isWebKit && element.querySelector('select:focus')) {
      return true;
    }

    if (!element.contains(target)) {
      return false;
    }

    var cursor = target;

    while (cursor && cursor !== element) {
      if (cursor.classList.contains(cls.element.consuming)) {
        return true;
      }

      var style = get(cursor);

      // if deltaY && vertical scrollable
      if (deltaY && style.overflowY.match(/(scroll|auto)/)) {
        var maxScrollTop = cursor.scrollHeight - cursor.clientHeight;
        if (maxScrollTop > 0) {
          if (
            (cursor.scrollTop > 0 && deltaY < 0) ||
            (cursor.scrollTop < maxScrollTop && deltaY > 0)
          ) {
            return true;
          }
        }
      }
      // if deltaX && horizontal scrollable
      if (deltaX && style.overflowX.match(/(scroll|auto)/)) {
        var maxScrollLeft = cursor.scrollWidth - cursor.clientWidth;
        if (maxScrollLeft > 0) {
          if (
            (cursor.scrollLeft > 0 && deltaX < 0) ||
            (cursor.scrollLeft < maxScrollLeft && deltaX > 0)
          ) {
            return true;
          }
        }
      }

      cursor = cursor.parentNode;
    }

    return false;
  }

  function mousewheelHandler(e) {
    var ref = getDeltaFromEvent(e);
    var deltaX = ref[0];
    var deltaY = ref[1];

    if (shouldBeConsumedByChild(e.target, deltaX, deltaY)) {
      return;
    }

    var shouldPrevent = false;
    if (!i.settings.useBothWheelAxes) {
      // deltaX will only be used for horizontal scrolling and deltaY will
      // only be used for vertical scrolling - this is the default
      element.scrollTop -= deltaY * i.settings.wheelSpeed;
      element.scrollLeft += deltaX * i.settings.wheelSpeed;
    } else if (i.scrollbarYActive && !i.scrollbarXActive) {
      // only vertical scrollbar is active and useBothWheelAxes option is
      // active, so let's scroll vertical bar using both mouse wheel axes
      if (deltaY) {
        element.scrollTop -= deltaY * i.settings.wheelSpeed;
      } else {
        element.scrollTop += deltaX * i.settings.wheelSpeed;
      }
      shouldPrevent = true;
    } else if (i.scrollbarXActive && !i.scrollbarYActive) {
      // useBothWheelAxes and only horizontal bar is active, so use both
      // wheel axes for horizontal bar
      if (deltaX) {
        element.scrollLeft += deltaX * i.settings.wheelSpeed;
      } else {
        element.scrollLeft -= deltaY * i.settings.wheelSpeed;
      }
      shouldPrevent = true;
    }

    updateGeometry(i);

    shouldPrevent = shouldPrevent || shouldPreventDefault(deltaX, deltaY);
    if (shouldPrevent && !e.ctrlKey) {
      e.stopPropagation();
      e.preventDefault();
    }
  }

  if (typeof window.onwheel !== 'undefined') {
    i.event.bind(element, 'wheel', mousewheelHandler);
  } else if (typeof window.onmousewheel !== 'undefined') {
    i.event.bind(element, 'mousewheel', mousewheelHandler);
  }
}

function touch(i) {
  if (!env.supportsTouch && !env.supportsIePointer) {
    return;
  }

  var element = i.element;

  function shouldPrevent(deltaX, deltaY) {
    var scrollTop = Math.floor(element.scrollTop);
    var scrollLeft = element.scrollLeft;
    var magnitudeX = Math.abs(deltaX);
    var magnitudeY = Math.abs(deltaY);

    if (magnitudeY > magnitudeX) {
      // user is perhaps trying to swipe up/down the page

      if (
        (deltaY < 0 && scrollTop === i.contentHeight - i.containerHeight) ||
        (deltaY > 0 && scrollTop === 0)
      ) {
        // set prevent for mobile Chrome refresh
        return window.scrollY === 0 && deltaY > 0 && env.isChrome;
      }
    } else if (magnitudeX > magnitudeY) {
      // user is perhaps trying to swipe left/right across the page

      if (
        (deltaX < 0 && scrollLeft === i.contentWidth - i.containerWidth) ||
        (deltaX > 0 && scrollLeft === 0)
      ) {
        return true;
      }
    }

    return true;
  }

  function applyTouchMove(differenceX, differenceY) {
    element.scrollTop -= differenceY;
    element.scrollLeft -= differenceX;

    updateGeometry(i);
  }

  var startOffset = {};
  var startTime = 0;
  var speed = {};
  var easingLoop = null;

  function getTouch(e) {
    if (e.targetTouches) {
      return e.targetTouches[0];
    } else {
      // Maybe IE pointer
      return e;
    }
  }

  function shouldHandle(e) {
    if (e.pointerType && e.pointerType === 'pen' && e.buttons === 0) {
      return false;
    }
    if (e.targetTouches && e.targetTouches.length === 1) {
      return true;
    }
    if (
      e.pointerType &&
      e.pointerType !== 'mouse' &&
      e.pointerType !== e.MSPOINTER_TYPE_MOUSE
    ) {
      return true;
    }
    return false;
  }

  function touchStart(e) {
    if (!shouldHandle(e)) {
      return;
    }

    var touch = getTouch(e);

    startOffset.pageX = touch.pageX;
    startOffset.pageY = touch.pageY;

    startTime = new Date().getTime();

    if (easingLoop !== null) {
      clearInterval(easingLoop);
    }
  }

  function shouldBeConsumedByChild(target, deltaX, deltaY) {
    if (!element.contains(target)) {
      return false;
    }

    var cursor = target;

    while (cursor && cursor !== element) {
      if (cursor.classList.contains(cls.element.consuming)) {
        return true;
      }

      var style = get(cursor);

      // if deltaY && vertical scrollable
      if (deltaY && style.overflowY.match(/(scroll|auto)/)) {
        var maxScrollTop = cursor.scrollHeight - cursor.clientHeight;
        if (maxScrollTop > 0) {
          if (
            (cursor.scrollTop > 0 && deltaY < 0) ||
            (cursor.scrollTop < maxScrollTop && deltaY > 0)
          ) {
            return true;
          }
        }
      }
      // if deltaX && horizontal scrollable
      if (deltaX && style.overflowX.match(/(scroll|auto)/)) {
        var maxScrollLeft = cursor.scrollWidth - cursor.clientWidth;
        if (maxScrollLeft > 0) {
          if (
            (cursor.scrollLeft > 0 && deltaX < 0) ||
            (cursor.scrollLeft < maxScrollLeft && deltaX > 0)
          ) {
            return true;
          }
        }
      }

      cursor = cursor.parentNode;
    }

    return false;
  }

  function touchMove(e) {
    if (shouldHandle(e)) {
      var touch = getTouch(e);

      var currentOffset = { pageX: touch.pageX, pageY: touch.pageY };

      var differenceX = currentOffset.pageX - startOffset.pageX;
      var differenceY = currentOffset.pageY - startOffset.pageY;

      if (shouldBeConsumedByChild(e.target, differenceX, differenceY)) {
        return;
      }

      applyTouchMove(differenceX, differenceY);
      startOffset = currentOffset;

      var currentTime = new Date().getTime();

      var timeGap = currentTime - startTime;
      if (timeGap > 0) {
        speed.x = differenceX / timeGap;
        speed.y = differenceY / timeGap;
        startTime = currentTime;
      }

      if (shouldPrevent(differenceX, differenceY)) {
        e.preventDefault();
      }
    }
  }
  function touchEnd() {
    if (i.settings.swipeEasing) {
      clearInterval(easingLoop);
      easingLoop = setInterval(function() {
        if (i.isInitialized) {
          clearInterval(easingLoop);
          return;
        }

        if (!speed.x && !speed.y) {
          clearInterval(easingLoop);
          return;
        }

        if (Math.abs(speed.x) < 0.01 && Math.abs(speed.y) < 0.01) {
          clearInterval(easingLoop);
          return;
        }

        applyTouchMove(speed.x * 30, speed.y * 30);

        speed.x *= 0.8;
        speed.y *= 0.8;
      }, 10);
    }
  }

  if (env.supportsTouch) {
    i.event.bind(element, 'touchstart', touchStart);
    i.event.bind(element, 'touchmove', touchMove);
    i.event.bind(element, 'touchend', touchEnd);
  } else if (env.supportsIePointer) {
    if (window.PointerEvent) {
      i.event.bind(element, 'pointerdown', touchStart);
      i.event.bind(element, 'pointermove', touchMove);
      i.event.bind(element, 'pointerup', touchEnd);
    } else if (window.MSPointerEvent) {
      i.event.bind(element, 'MSPointerDown', touchStart);
      i.event.bind(element, 'MSPointerMove', touchMove);
      i.event.bind(element, 'MSPointerUp', touchEnd);
    }
  }
}

var defaultSettings = function () { return ({
  handlers: ['click-rail', 'drag-thumb', 'keyboard', 'wheel', 'touch'],
  maxScrollbarLength: null,
  minScrollbarLength: null,
  scrollingThreshold: 1000,
  scrollXMarginOffset: 0,
  scrollYMarginOffset: 0,
  suppressScrollX: false,
  suppressScrollY: false,
  swipeEasing: true,
  useBothWheelAxes: false,
  wheelPropagation: true,
  wheelSpeed: 1,
}); };

var handlers = {
  'click-rail': clickRail,
  'drag-thumb': dragThumb,
  keyboard: keyboard,
  wheel: wheel,
  touch: touch,
};

var PerfectScrollbar = function PerfectScrollbar(element, userSettings) {
  var this$1 = this;
  if ( userSettings === void 0 ) userSettings = {};

  if (typeof element === 'string') {
    element = document.querySelector(element);
  }

  if (!element || !element.nodeName) {
    throw new Error('no element is specified to initialize PerfectScrollbar');
  }

  this.element = element;

  element.classList.add(cls.main);

  this.settings = defaultSettings();
  for (var key in userSettings) {
    this.settings[key] = userSettings[key];
  }

  this.containerWidth = null;
  this.containerHeight = null;
  this.contentWidth = null;
  this.contentHeight = null;

  var focus = function () { return element.classList.add(cls.state.focus); };
  var blur = function () { return element.classList.remove(cls.state.focus); };

  this.isRtl = get(element).direction === 'rtl';
  if (this.isRtl === true) {
    element.classList.add(cls.rtl);
  }
  this.isNegativeScroll = (function () {
    var originalScrollLeft = element.scrollLeft;
    var result = null;
    element.scrollLeft = -1;
    result = element.scrollLeft < 0;
    element.scrollLeft = originalScrollLeft;
    return result;
  })();
  this.negativeScrollAdjustment = this.isNegativeScroll
    ? element.scrollWidth - element.clientWidth
    : 0;
  this.event = new EventManager();
  this.ownerDocument = element.ownerDocument || document;

  this.scrollbarXRail = div(cls.element.rail('x'));
  element.appendChild(this.scrollbarXRail);
  this.scrollbarX = div(cls.element.thumb('x'));
  this.scrollbarXRail.appendChild(this.scrollbarX);
  this.scrollbarX.setAttribute('tabindex', 0);
  this.event.bind(this.scrollbarX, 'focus', focus);
  this.event.bind(this.scrollbarX, 'blur', blur);
  this.scrollbarXActive = null;
  this.scrollbarXWidth = null;
  this.scrollbarXLeft = null;
  var railXStyle = get(this.scrollbarXRail);
  this.scrollbarXBottom = parseInt(railXStyle.bottom, 10);
  if (isNaN(this.scrollbarXBottom)) {
    this.isScrollbarXUsingBottom = false;
    this.scrollbarXTop = toInt(railXStyle.top);
  } else {
    this.isScrollbarXUsingBottom = true;
  }
  this.railBorderXWidth =
    toInt(railXStyle.borderLeftWidth) + toInt(railXStyle.borderRightWidth);
  // Set rail to display:block to calculate margins
  set(this.scrollbarXRail, { display: 'block' });
  this.railXMarginWidth =
    toInt(railXStyle.marginLeft) + toInt(railXStyle.marginRight);
  set(this.scrollbarXRail, { display: '' });
  this.railXWidth = null;
  this.railXRatio = null;

  this.scrollbarYRail = div(cls.element.rail('y'));
  element.appendChild(this.scrollbarYRail);
  this.scrollbarY = div(cls.element.thumb('y'));
  this.scrollbarYRail.appendChild(this.scrollbarY);
  this.scrollbarY.setAttribute('tabindex', 0);
  this.event.bind(this.scrollbarY, 'focus', focus);
  this.event.bind(this.scrollbarY, 'blur', blur);
  this.scrollbarYActive = null;
  this.scrollbarYHeight = null;
  this.scrollbarYTop = null;
  var railYStyle = get(this.scrollbarYRail);
  this.scrollbarYRight = parseInt(railYStyle.right, 10);
  if (isNaN(this.scrollbarYRight)) {
    this.isScrollbarYUsingRight = false;
    this.scrollbarYLeft = toInt(railYStyle.left);
  } else {
    this.isScrollbarYUsingRight = true;
  }
  this.scrollbarYOuterWidth = this.isRtl ? outerWidth(this.scrollbarY) : null;
  this.railBorderYWidth =
    toInt(railYStyle.borderTopWidth) + toInt(railYStyle.borderBottomWidth);
  set(this.scrollbarYRail, { display: 'block' });
  this.railYMarginHeight =
    toInt(railYStyle.marginTop) + toInt(railYStyle.marginBottom);
  set(this.scrollbarYRail, { display: '' });
  this.railYHeight = null;
  this.railYRatio = null;

  this.reach = {
    x:
      element.scrollLeft <= 0
        ? 'start'
        : element.scrollLeft >= this.contentWidth - this.containerWidth
        ? 'end'
        : null,
    y:
      element.scrollTop <= 0
        ? 'start'
        : element.scrollTop >= this.contentHeight - this.containerHeight
        ? 'end'
        : null,
  };

  this.isAlive = true;

  this.settings.handlers.forEach(function (handlerName) { return handlers[handlerName](this$1); });

  this.lastScrollTop = Math.floor(element.scrollTop); // for onScroll only
  this.lastScrollLeft = element.scrollLeft; // for onScroll only
  this.event.bind(this.element, 'scroll', function (e) { return this$1.onScroll(e); });
  updateGeometry(this);
};

PerfectScrollbar.prototype.update = function update () {
  if (!this.isAlive) {
    return;
  }

  // Recalcuate negative scrollLeft adjustment
  this.negativeScrollAdjustment = this.isNegativeScroll
    ? this.element.scrollWidth - this.element.clientWidth
    : 0;

  // Recalculate rail margins
  set(this.scrollbarXRail, { display: 'block' });
  set(this.scrollbarYRail, { display: 'block' });
  this.railXMarginWidth =
    toInt(get(this.scrollbarXRail).marginLeft) +
    toInt(get(this.scrollbarXRail).marginRight);
  this.railYMarginHeight =
    toInt(get(this.scrollbarYRail).marginTop) +
    toInt(get(this.scrollbarYRail).marginBottom);

  // Hide scrollbars not to affect scrollWidth and scrollHeight
  set(this.scrollbarXRail, { display: 'none' });
  set(this.scrollbarYRail, { display: 'none' });

  updateGeometry(this);

  processScrollDiff(this, 'top', 0, false, true);
  processScrollDiff(this, 'left', 0, false, true);

  set(this.scrollbarXRail, { display: '' });
  set(this.scrollbarYRail, { display: '' });
};

PerfectScrollbar.prototype.onScroll = function onScroll (e) {
  if (!this.isAlive) {
    return;
  }

  updateGeometry(this);
  processScrollDiff(this, 'top', this.element.scrollTop - this.lastScrollTop);
  processScrollDiff(
    this,
    'left',
    this.element.scrollLeft - this.lastScrollLeft
  );

  this.lastScrollTop = Math.floor(this.element.scrollTop);
  this.lastScrollLeft = this.element.scrollLeft;
};

PerfectScrollbar.prototype.destroy = function destroy () {
  if (!this.isAlive) {
    return;
  }

  this.event.unbindAll();
  remove(this.scrollbarX);
  remove(this.scrollbarY);
  remove(this.scrollbarXRail);
  remove(this.scrollbarYRail);
  this.removePsClasses();

  // unset elements
  this.element = null;
  this.scrollbarX = null;
  this.scrollbarY = null;
  this.scrollbarXRail = null;
  this.scrollbarYRail = null;

  this.isAlive = false;
};

PerfectScrollbar.prototype.removePsClasses = function removePsClasses () {
  this.element.className = this.element.className
    .split(' ')
    .filter(function (name) { return !name.match(/^ps([-_].+|)$/); })
    .join(' ');
};

/* harmony default export */ __webpack_exports__["default"] = (PerfectScrollbar);
//# sourceMappingURL=perfect-scrollbar.esm.js.map


/***/ }),

/***/ "./resources/vendor/sidebar/class-toggler.js":
/*!***************************************************!*\
  !*** ./resources/vendor/sidebar/class-toggler.js ***!
  \***************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _util__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./util */ "./resources/vendor/sidebar/util/index.js");
/* harmony import */ var _dom_data__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./dom/data */ "./resources/vendor/sidebar/dom/data.js");
/* harmony import */ var _dom_event_handler__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./dom/event-handler */ "./resources/vendor/sidebar/dom/event-handler.js");
/* harmony import */ var _dom_manipulator__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./dom/manipulator */ "./resources/vendor/sidebar/dom/manipulator.js");
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }

function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { _defineProperty(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

/**
 * --------------------------------------------------------------------------
 * CoreUI (v3.4.0): class-toggler.js
 * Licensed under MIT (https://coreui.io/license)
 * --------------------------------------------------------------------------
 */




/**
 * ------------------------------------------------------------------------
 * Constants
 * ------------------------------------------------------------------------
 */

var NAME = 'class-toggler';
var VERSION = '3.2.2';
var DATA_KEY = 'coreui.class-toggler';
var EVENT_KEY = ".".concat(DATA_KEY);
var DATA_API_KEY = '.data-api';
var DefaultType = {
  addClass: '(null|array|string)',
  breakpoints: '(null|array|string)',
  removeClass: '(null|array|string)',
  responsive: '(null|boolean)',
  target: '(null|string)',
  toggleClass: '(null|array|string)'
};
var Default = {
  addClass: null,
  breakpoints: ['', 'sm', 'md', 'lg', 'xl'],
  removeClass: null,
  responsive: false,
  target: 'body',
  toggleClass: null
};
var CLASS_NAME_CLASS_TOGGLER = 'c-class-toggler';
var EVENT_CLASS_ADDED = 'classadded';
var EVENT_CLASS_REMOVED = 'classremoved';
var EVENT_CLASS_TOGGLE = 'classtoggle';
var EVENT_CLICK_DATA_API = "click".concat(EVENT_KEY).concat(DATA_API_KEY);
var SELECTOR_CLASS_TOGGLER = '.c-class-toggler';
/**
 * ------------------------------------------------------------------------
 * Class Definition
 * ------------------------------------------------------------------------
 */

var ClassToggler = /*#__PURE__*/function () {
  function ClassToggler(element, config) {
    _classCallCheck(this, ClassToggler);

    this._element = element;
    this._config = this._getConfig(config);
    _dom_data__WEBPACK_IMPORTED_MODULE_1__["default"].setData(element, DATA_KEY, this);
  } // Getters


  _createClass(ClassToggler, [{
    key: "add",
    value: // Public
    function add() {
      var _this = this;

      var target = this._target();

      var classNames = this._config.addClass.replace(/\s/g, '').split(',');

      classNames.forEach(function (className) {
        target.classList.add(className);

        _this._customEvent(EVENT_CLASS_ADDED, target, true, className);
      });
    }
  }, {
    key: "remove",
    value: function remove() {
      var _this2 = this;

      var target = this._target();

      var classNames = this._config.removeClass.replace(/\s/g, '').split(',');

      classNames.forEach(function (className) {
        if (_this2._config.responsive) {
          _this2._updateResponsiveClassNames(className).forEach(function (className) {
            target.classList.remove(className);

            _this2._customEvent(EVENT_CLASS_REMOVED, target, false, className);
          });
        } else {
          target.classList.remove(className);

          _this2._customEvent(EVENT_CLASS_REMOVED, target, false, className);
        }
      });
    }
  }, {
    key: "toggle",
    value: function toggle() {
      var _this3 = this;

      var target = this._target();

      var classNames = this._config.toggleClass.replace(/\s/g, '').split(',');

      if (this._config.responsive) {
        classNames.forEach(function (className) {
          var responsiveClassNames = _this3._updateResponsiveClassNames(className);

          if (responsiveClassNames.filter(function (className) {
            return target.classList.contains(className);
          }).length) {
            _this3._updateResponsiveClassNames(className).forEach(function (className) {
              _this3._config.removeClass = className;

              _this3.remove();

              _this3._customEvent(EVENT_CLASS_TOGGLE, target, false, className);
            });
          } else {
            _this3._config.addClass = className;

            _this3.add();

            _this3._customEvent(EVENT_CLASS_TOGGLE, target, true, className);
          }
        });
      } else {
        classNames.forEach(function (className) {
          if (target.classList.contains(className)) {
            _this3._config.removeClass = className;

            _this3.remove();

            _this3._customEvent(EVENT_CLASS_TOGGLE, target, false, className);
          } else {
            _this3._config.addClass = className;

            _this3.add();

            _this3._customEvent(EVENT_CLASS_TOGGLE, target, true, className);
          }
        });
      }
    }
  }, {
    key: "class",
    value: function _class() {
      this._config.toggleClass = this._config["class"];

      if (this._element.getAttribute('responsive')) {
        this._config.responsive = this._element.getAttribute('responsive');
      }

      this.toggle();
    } // Private

  }, {
    key: "_target",
    value: function _target() {
      if (this._config.target === 'body') {
        return document.querySelector(this._config.target);
      }

      if (this._config.target === '_parent') {
        return this._element.parentNode;
      }

      return document.querySelector(this._config.target);
    }
  }, {
    key: "_customEvent",
    value: function _customEvent(eventName, target, add, className) {
      var event = new CustomEvent(eventName, {
        detail: {
          target: target,
          add: add,
          className: className
        }
      });
      target.dispatchEvent(event);
    }
  }, {
    key: "_breakpoint",
    value: function _breakpoint(className) {
      var breakpoints = this._config.breakpoints;
      return breakpoints.filter(function (breakpoint) {
        return breakpoint.length > 0;
      }).filter(function (breakpoint) {
        return className.includes(breakpoint);
      })[0];
    }
  }, {
    key: "_breakpoints",
    value: function _breakpoints(className) {
      var breakpoints = this._config.breakpoints;
      return breakpoints.slice(0, breakpoints.indexOf(breakpoints.filter(function (breakpoint) {
        return breakpoint.length > 0;
      }).filter(function (breakpoint) {
        return className.includes(breakpoint);
      })[0]) + 1);
    }
  }, {
    key: "_updateResponsiveClassNames",
    value: function _updateResponsiveClassNames(className) {
      var bp = this._breakpoint(className);

      return this._breakpoints(className).map(function (breakpoint) {
        return breakpoint.length > 0 ? className.replace(bp, breakpoint) : className.replace("-".concat(bp), breakpoint);
      });
    }
  }, {
    key: "_includesResponsiveClass",
    value: function _includesResponsiveClass(className) {
      var _this4 = this;

      return this._updateResponsiveClassNames(className).filter(function (className) {
        return _this4._config.target.contains(className);
      });
    } // Static

  }, {
    key: "_getConfig",
    value: function _getConfig(config) {
      config = _objectSpread(_objectSpread(_objectSpread({}, this.constructor.Default), _dom_manipulator__WEBPACK_IMPORTED_MODULE_3__["default"].getDataAttributes(this._element)), config);
      Object(_util__WEBPACK_IMPORTED_MODULE_0__["typeCheckConfig"])(NAME, config, this.constructor.DefaultType);
      return config;
    }
  }], [{
    key: "VERSION",
    get: function get() {
      return VERSION;
    }
  }, {
    key: "Default",
    get: function get() {
      return Default;
    }
  }, {
    key: "DefaultType",
    get: function get() {
      return DefaultType;
    }
  }, {
    key: "classTogglerInterface",
    value: function classTogglerInterface(element, config) {
      var data = _dom_data__WEBPACK_IMPORTED_MODULE_1__["default"].getData(element, DATA_KEY);

      var _config = _typeof(config) === 'object' && config;

      if (!data) {
        data = new ClassToggler(element, _config);
      }

      if (typeof config === 'string') {
        if (typeof data[config] === 'undefined') {
          throw new TypeError("No method named \"".concat(config, "\""));
        }

        data[config]();
      }
    }
  }, {
    key: "jQueryInterface",
    value: function jQueryInterface(config) {
      return this.each(function () {
        ClassToggler.classTogglerInterface(this, config);
      });
    }
  }]);

  return ClassToggler;
}();
/**
 * ------------------------------------------------------------------------
 * Data Api implementation
 * ------------------------------------------------------------------------
 */


_dom_event_handler__WEBPACK_IMPORTED_MODULE_2__["default"].on(document, EVENT_CLICK_DATA_API, SELECTOR_CLASS_TOGGLER, function (event) {
  event.preventDefault();
  event.stopPropagation();
  var toggler = event.target;

  if (!toggler.classList.contains(CLASS_NAME_CLASS_TOGGLER)) {
    toggler = toggler.closest(SELECTOR_CLASS_TOGGLER);
  }

  if (typeof toggler.dataset.addClass !== 'undefined') {
    ClassToggler.classTogglerInterface(toggler, 'add');
  }

  if (typeof toggler.dataset.removeClass !== 'undefined') {
    ClassToggler.classTogglerInterface(toggler, 'remove');
  }

  if (typeof toggler.dataset.toggleClass !== 'undefined') {
    ClassToggler.classTogglerInterface(toggler, 'toggle');
  }

  if (typeof toggler.dataset["class"] !== 'undefined') {
    ClassToggler.classTogglerInterface(toggler, 'class');
  }
});
var $ = Object(_util__WEBPACK_IMPORTED_MODULE_0__["getjQuery"])();
/**
 * ------------------------------------------------------------------------
 * jQuery
 * ------------------------------------------------------------------------
 * add .c-class-toggler to jQuery only if jQuery is present
 */

if ($) {
  var JQUERY_NO_CONFLICT = $.fn[NAME];
  $.fn[NAME] = ClassToggler.jQueryInterface;
  $.fn[NAME].Constructor = ClassToggler;

  $.fn[NAME].noConflict = function () {
    $.fn[NAME] = JQUERY_NO_CONFLICT;
    return ClassToggler.jQueryInterface;
  };
}

/* harmony default export */ __webpack_exports__["default"] = (ClassToggler);

/***/ }),

/***/ "./resources/vendor/sidebar/dom/data.js":
/*!**********************************************!*\
  !*** ./resources/vendor/sidebar/dom/data.js ***!
  \**********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/**
 * --------------------------------------------------------------------------
 * Bootstrap (v5.0.0-alpha1): dom/data.js
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * --------------------------------------------------------------------------
 */

/**
 * ------------------------------------------------------------------------
 * Constants
 * ------------------------------------------------------------------------
 */
var mapData = function () {
  var storeData = {};
  var id = 1;
  return {
    set: function set(element, key, data) {
      if (typeof element.key === 'undefined') {
        element.key = {
          key: key,
          id: id
        };
        id++;
      }

      storeData[element.key.id] = data;
    },
    get: function get(element, key) {
      if (!element || typeof element.key === 'undefined') {
        return null;
      }

      var keyProperties = element.key;

      if (keyProperties.key === key) {
        return storeData[keyProperties.id];
      }

      return null;
    },
    "delete": function _delete(element, key) {
      if (typeof element.key === 'undefined') {
        return;
      }

      var keyProperties = element.key;

      if (keyProperties.key === key) {
        delete storeData[keyProperties.id];
        delete element.key;
      }
    }
  };
}();

var Data = {
  setData: function setData(instance, key, data) {
    mapData.set(instance, key, data);
  },
  getData: function getData(instance, key) {
    return mapData.get(instance, key);
  },
  removeData: function removeData(instance, key) {
    mapData["delete"](instance, key);
  }
};
/* harmony default export */ __webpack_exports__["default"] = (Data);

/***/ }),

/***/ "./resources/vendor/sidebar/dom/event-handler.js":
/*!*******************************************************!*\
  !*** ./resources/vendor/sidebar/dom/event-handler.js ***!
  \*******************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _util__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../util */ "./resources/vendor/sidebar/util/index.js");
/* harmony import */ var _polyfill__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./polyfill */ "./resources/vendor/sidebar/dom/polyfill.js");
function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { var _i = arr == null ? null : typeof Symbol !== "undefined" && arr[Symbol.iterator] || arr["@@iterator"]; if (_i == null) return; var _arr = []; var _n = true; var _d = false; var _s, _e; try { for (_i = _i.call(arr); !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

/**
 * --------------------------------------------------------------------------
 * Bootstrap (v5.0.0-alpha1): dom/event-handler.js
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
 * --------------------------------------------------------------------------
 */


/**
 * ------------------------------------------------------------------------
 * Constants
 * ------------------------------------------------------------------------
 */

var $ = Object(_util__WEBPACK_IMPORTED_MODULE_0__["getjQuery"])();
var namespaceRegex = /[^.]*(?=\..*)\.|.*/;
var stripNameRegex = /\..*/;
var stripUidRegex = /::\d+$/;
var eventRegistry = {}; // Events storage

var uidEvent = 1;
var customEvents = {
  mouseenter: 'mouseover',
  mouseleave: 'mouseout'
};
var nativeEvents = ['click', 'dblclick', 'mouseup', 'mousedown', 'contextmenu', 'mousewheel', 'DOMMouseScroll', 'mouseover', 'mouseout', 'mousemove', 'selectstart', 'selectend', 'keydown', 'keypress', 'keyup', 'orientationchange', 'touchstart', 'touchmove', 'touchend', 'touchcancel', 'pointerdown', 'pointermove', 'pointerup', 'pointerleave', 'pointercancel', 'gesturestart', 'gesturechange', 'gestureend', 'focus', 'blur', 'change', 'reset', 'select', 'submit', 'focusin', 'focusout', 'load', 'unload', 'beforeunload', 'resize', 'move', 'DOMContentLoaded', 'readystatechange', 'error', 'abort', 'scroll'];
/**
 * ------------------------------------------------------------------------
 * Private methods
 * ------------------------------------------------------------------------
 */

function getUidEvent(element, uid) {
  return uid && "".concat(uid, "::").concat(uidEvent++) || element.uidEvent || uidEvent++;
}

function getEvent(element) {
  var uid = getUidEvent(element);
  element.uidEvent = uid;
  eventRegistry[uid] = eventRegistry[uid] || {};
  return eventRegistry[uid];
}

function bootstrapHandler(element, fn) {
  return function handler(event) {
    event.delegateTarget = element;

    if (handler.oneOff) {
      EventHandler.off(element, event.type, fn);
    }

    return fn.apply(element, [event]);
  };
}

function bootstrapDelegationHandler(element, selector, fn) {
  return function handler(event) {
    var domElements = element.querySelectorAll(selector);

    for (var target = event.target; target && target !== this; target = target.parentNode) {
      for (var i = domElements.length; i--;) {
        if (domElements[i] === target) {
          event.delegateTarget = target;

          if (handler.oneOff) {
            EventHandler.off(element, event.type, fn);
          }

          return fn.apply(target, [event]);
        }
      }
    } // To please ESLint


    return null;
  };
}

function findHandler(events, handler) {
  var delegationSelector = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : null;
  var uidEventList = Object.keys(events);

  for (var i = 0, len = uidEventList.length; i < len; i++) {
    var event = events[uidEventList[i]];

    if (event.originalHandler === handler && event.delegationSelector === delegationSelector) {
      return event;
    }
  }

  return null;
}

function normalizeParams(originalTypeEvent, handler, delegationFn) {
  var delegation = typeof handler === 'string';
  var originalHandler = delegation ? delegationFn : handler; // allow to get the native events from namespaced events ('click.bs.button' --> 'click')

  var typeEvent = originalTypeEvent.replace(stripNameRegex, '');
  var custom = customEvents[typeEvent];

  if (custom) {
    typeEvent = custom;
  }

  var isNative = nativeEvents.indexOf(typeEvent) > -1;

  if (!isNative) {
    typeEvent = originalTypeEvent;
  }

  return [delegation, originalHandler, typeEvent];
}

function addHandler(element, originalTypeEvent, handler, delegationFn, oneOff) {
  if (typeof originalTypeEvent !== 'string' || !element) {
    return;
  }

  if (!handler) {
    handler = delegationFn;
    delegationFn = null;
  }

  var _normalizeParams = normalizeParams(originalTypeEvent, handler, delegationFn),
      _normalizeParams2 = _slicedToArray(_normalizeParams, 3),
      delegation = _normalizeParams2[0],
      originalHandler = _normalizeParams2[1],
      typeEvent = _normalizeParams2[2];

  var events = getEvent(element);
  var handlers = events[typeEvent] || (events[typeEvent] = {});
  var previousFn = findHandler(handlers, originalHandler, delegation ? handler : null);

  if (previousFn) {
    previousFn.oneOff = previousFn.oneOff && oneOff;
    return;
  }

  var uid = getUidEvent(originalHandler, originalTypeEvent.replace(namespaceRegex, ''));
  var fn = delegation ? bootstrapDelegationHandler(element, handler, delegationFn) : bootstrapHandler(element, handler);
  fn.delegationSelector = delegation ? handler : null;
  fn.originalHandler = originalHandler;
  fn.oneOff = oneOff;
  fn.uidEvent = uid;
  handlers[uid] = fn;
  element.addEventListener(typeEvent, fn, delegation);
}

function removeHandler(element, events, typeEvent, handler, delegationSelector) {
  var fn = findHandler(events[typeEvent], handler, delegationSelector);

  if (!fn) {
    return;
  }

  element.removeEventListener(typeEvent, fn, Boolean(delegationSelector));
  delete events[typeEvent][fn.uidEvent];
}

function removeNamespacedHandlers(element, events, typeEvent, namespace) {
  var storeElementEvent = events[typeEvent] || {};
  Object.keys(storeElementEvent).forEach(function (handlerKey) {
    if (handlerKey.indexOf(namespace) > -1) {
      var event = storeElementEvent[handlerKey];
      removeHandler(element, events, typeEvent, event.originalHandler, event.delegationSelector);
    }
  });
}

var EventHandler = {
  on: function on(element, event, handler, delegationFn) {
    addHandler(element, event, handler, delegationFn, false);
  },
  one: function one(element, event, handler, delegationFn) {
    addHandler(element, event, handler, delegationFn, true);
  },
  off: function off(element, originalTypeEvent, handler, delegationFn) {
    if (typeof originalTypeEvent !== 'string' || !element) {
      return;
    }

    var _normalizeParams3 = normalizeParams(originalTypeEvent, handler, delegationFn),
        _normalizeParams4 = _slicedToArray(_normalizeParams3, 3),
        delegation = _normalizeParams4[0],
        originalHandler = _normalizeParams4[1],
        typeEvent = _normalizeParams4[2];

    var inNamespace = typeEvent !== originalTypeEvent;
    var events = getEvent(element);
    var isNamespace = originalTypeEvent.charAt(0) === '.';

    if (typeof originalHandler !== 'undefined') {
      // Simplest case: handler is passed, remove that listener ONLY.
      if (!events || !events[typeEvent]) {
        return;
      }

      removeHandler(element, events, typeEvent, originalHandler, delegation ? handler : null);
      return;
    }

    if (isNamespace) {
      Object.keys(events).forEach(function (elementEvent) {
        removeNamespacedHandlers(element, events, elementEvent, originalTypeEvent.slice(1));
      });
    }

    var storeElementEvent = events[typeEvent] || {};
    Object.keys(storeElementEvent).forEach(function (keyHandlers) {
      var handlerKey = keyHandlers.replace(stripUidRegex, '');

      if (!inNamespace || originalTypeEvent.indexOf(handlerKey) > -1) {
        var event = storeElementEvent[keyHandlers];
        removeHandler(element, events, typeEvent, event.originalHandler, event.delegationSelector);
      }
    });
  },
  trigger: function trigger(element, event, args) {
    if (typeof event !== 'string' || !element) {
      return null;
    }

    var typeEvent = event.replace(stripNameRegex, '');
    var inNamespace = event !== typeEvent;
    var isNative = nativeEvents.indexOf(typeEvent) > -1;
    var jQueryEvent;
    var bubbles = true;
    var nativeDispatch = true;
    var defaultPrevented = false;
    var evt = null;

    if (inNamespace && $) {
      jQueryEvent = $.Event(event, args);
      $(element).trigger(jQueryEvent);
      bubbles = !jQueryEvent.isPropagationStopped();
      nativeDispatch = !jQueryEvent.isImmediatePropagationStopped();
      defaultPrevented = jQueryEvent.isDefaultPrevented();
    }

    if (isNative) {
      evt = document.createEvent('HTMLEvents');
      evt.initEvent(typeEvent, bubbles, true);
    } else {
      evt = new CustomEvent(event, {
        bubbles: bubbles,
        cancelable: true
      });
    } // merge custom information in our event


    if (typeof args !== 'undefined') {
      Object.keys(args).forEach(function (key) {
        Object.defineProperty(evt, key, {
          get: function get() {
            return args[key];
          }
        });
      });
    }

    if (defaultPrevented) {
      evt.preventDefault();

      if (!_polyfill__WEBPACK_IMPORTED_MODULE_1__["defaultPreventedPreservedOnDispatch"]) {
        Object.defineProperty(evt, 'defaultPrevented', {
          get: function get() {
            return true;
          }
        });
      }
    }

    if (nativeDispatch) {
      element.dispatchEvent(evt);
    }

    if (evt.defaultPrevented && typeof jQueryEvent !== 'undefined') {
      jQueryEvent.preventDefault();
    }

    return evt;
  }
};
/* harmony default export */ __webpack_exports__["default"] = (EventHandler);

/***/ }),

/***/ "./resources/vendor/sidebar/dom/manipulator.js":
/*!*****************************************************!*\
  !*** ./resources/vendor/sidebar/dom/manipulator.js ***!
  \*****************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { _defineProperty(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

/**
 * --------------------------------------------------------------------------
 * Bootstrap (v5.0.0-alpha1): dom/manipulator.js
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * --------------------------------------------------------------------------
 */
function normalizeData(val) {
  if (val === 'true') {
    return true;
  }

  if (val === 'false') {
    return false;
  }

  if (val === Number(val).toString()) {
    return Number(val);
  }

  if (val === '' || val === 'null') {
    return null;
  }

  return val;
}

function normalizeDataKey(key) {
  return key.replace(/[A-Z]/g, function (chr) {
    return "-".concat(chr.toLowerCase());
  });
}

var Manipulator = {
  setDataAttribute: function setDataAttribute(element, key, value) {
    element.setAttribute("data-".concat(normalizeDataKey(key)), value);
  },
  removeDataAttribute: function removeDataAttribute(element, key) {
    element.removeAttribute("data-".concat(normalizeDataKey(key)));
  },
  getDataAttributes: function getDataAttributes(element) {
    if (!element) {
      return {};
    }

    var attributes = _objectSpread({}, element.dataset);

    Object.keys(attributes).forEach(function (key) {
      attributes[key] = normalizeData(attributes[key]);
    });
    return attributes;
  },
  getDataAttribute: function getDataAttribute(element, key) {
    return normalizeData(element.getAttribute("data-".concat(normalizeDataKey(key))));
  },
  offset: function offset(element) {
    var rect = element.getBoundingClientRect();
    return {
      top: rect.top + document.body.scrollTop,
      left: rect.left + document.body.scrollLeft
    };
  },
  position: function position(element) {
    return {
      top: element.offsetTop,
      left: element.offsetLeft
    };
  },
  toggleClass: function toggleClass(element, className) {
    if (!element) {
      return;
    }

    if (element.classList.contains(className)) {
      element.classList.remove(className);
    } else {
      element.classList.add(className);
    }
  }
};
/* harmony default export */ __webpack_exports__["default"] = (Manipulator);

/***/ }),

/***/ "./resources/vendor/sidebar/dom/polyfill.js":
/*!**************************************************!*\
  !*** ./resources/vendor/sidebar/dom/polyfill.js ***!
  \**************************************************/
/*! exports provided: find, findOne, defaultPreventedPreservedOnDispatch */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "find", function() { return find; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "findOne", function() { return findOne; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "defaultPreventedPreservedOnDispatch", function() { return defaultPreventedPreservedOnDispatch; });
/* harmony import */ var _util__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../util */ "./resources/vendor/sidebar/util/index.js");
/* istanbul ignore file */

/**
 * --------------------------------------------------------------------------
 * Bootstrap (v5.0.0-alpha1): dom/polyfill.js
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * --------------------------------------------------------------------------
 */

var find = Element.prototype.querySelectorAll;
var findOne = Element.prototype.querySelector; // MSEdge resets defaultPrevented flag upon dispatchEvent call if at least one listener is attached

var defaultPreventedPreservedOnDispatch = function () {
  var e = new CustomEvent('Bootstrap', {
    cancelable: true
  });
  var element = document.createElement('div');
  element.addEventListener('Bootstrap', function () {
    return null;
  });
  e.preventDefault();
  element.dispatchEvent(e);
  return e.defaultPrevented;
}();

var scopeSelectorRegex = /:scope\b/;

var supportScopeQuery = function () {
  var element = document.createElement('div');

  try {
    element.querySelectorAll(':scope *');
  } catch (_) {
    return false;
  }

  return true;
}();

if (!supportScopeQuery) {
  find = function find(selector) {
    if (!scopeSelectorRegex.test(selector)) {
      return this.querySelectorAll(selector);
    }

    var hasId = Boolean(this.id);

    if (!hasId) {
      this.id = Object(_util__WEBPACK_IMPORTED_MODULE_0__["getUID"])('scope');
    }

    var nodeList = null;

    try {
      selector = selector.replace(scopeSelectorRegex, "#".concat(this.id));
      nodeList = this.querySelectorAll(selector);
    } finally {
      if (!hasId) {
        this.removeAttribute('id');
      }
    }

    return nodeList;
  };

  findOne = function findOne(selector) {
    if (!scopeSelectorRegex.test(selector)) {
      return this.querySelector(selector);
    }

    var matches = find.call(this, selector);

    if (typeof matches[0] !== 'undefined') {
      return matches[0];
    }

    return null;
  };
}



/***/ }),

/***/ "./resources/vendor/sidebar/sidebar.js":
/*!*********************************************!*\
  !*** ./resources/vendor/sidebar/sidebar.js ***!
  \*********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _util__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./util */ "./resources/vendor/sidebar/util/index.js");
/* harmony import */ var _dom_data__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./dom/data */ "./resources/vendor/sidebar/dom/data.js");
/* harmony import */ var _dom_event_handler__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./dom/event-handler */ "./resources/vendor/sidebar/dom/event-handler.js");
/* harmony import */ var _dom_manipulator__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./dom/manipulator */ "./resources/vendor/sidebar/dom/manipulator.js");
/* harmony import */ var perfect_scrollbar__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! perfect-scrollbar */ "./node_modules/perfect-scrollbar/dist/perfect-scrollbar.esm.js");
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }

function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { _defineProperty(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

/**
 * --------------------------------------------------------------------------
 * CoreUI (v3.4.0): sidebar.js
 * Licensed under MIT (https://coreui.io/license)
 * --------------------------------------------------------------------------
 */





/**
 * ------------------------------------------------------------------------
 * Constants
 * ------------------------------------------------------------------------
 */

var NAME = 'sidebar';
var VERSION = '3.2.2';
var DATA_KEY = 'coreui.sidebar';
var EVENT_KEY = ".".concat(DATA_KEY);
var DATA_API_KEY = '.data-api';
var Default = {
  activeLinksExact: true,
  breakpoints: {
    xs: 'c-sidebar-show',
    sm: 'c-sidebar-sm-show',
    md: 'c-sidebar-md-show',
    lg: 'c-sidebar-lg-show',
    xl: 'c-sidebar-xl-show',
    xxl: 'c-sidebar-xxl-show'
  },
  dropdownAccordion: true
};
var DefaultType = {
  activeLinksExact: 'boolean',
  breakpoints: 'object',
  dropdownAccordion: '(string|boolean)'
};
var CLASS_NAME_ACTIVE = 'c-active';
var CLASS_NAME_BACKDROP = 'c-sidebar-backdrop';
var CLASS_NAME_FADE = 'c-fade';
var CLASS_NAME_NAV_DROPDOWN = 'c-sidebar-nav-dropdown';
var CLASS_NAME_NAV_DROPDOWN_TOGGLE = 'c-sidebar-nav-dropdown-toggle';
var CLASS_NAME_SHOW = 'c-show';
var CLASS_NAME_SIDEBAR_MINIMIZED = 'c-sidebar-minimized';
var CLASS_NAME_SIDEBAR_OVERLAID = 'c-sidebar-overlaid';
var CLASS_NAME_SIDEBAR_UNFOLDABLE = 'c-sidebar-unfoldable';
var EVENT_CLASS_TOGGLE = 'classtoggle';
var EVENT_CLICK_DATA_API = "click".concat(EVENT_KEY).concat(DATA_API_KEY);
var EVENT_CLOSE = "close".concat(EVENT_KEY);
var EVENT_CLOSED = "closed".concat(EVENT_KEY);
var EVENT_LOAD_DATA_API = "load".concat(EVENT_KEY).concat(DATA_API_KEY);
var EVENT_OPEN = "open".concat(EVENT_KEY);
var EVENT_OPENED = "opened".concat(EVENT_KEY);
var SELECTOR_NAV_DROPDOWN_TOGGLE = '.c-sidebar-nav-dropdown-toggle';
var SELECTOR_NAV_DROPDOWN = '.c-sidebar-nav-dropdown';
var SELECTOR_NAV_LINK = '.c-sidebar-nav-link';
var SELECTOR_NAVIGATION_CONTAINER = '.c-sidebar-nav';
var SELECTOR_SIDEBAR = '.c-sidebar';
/**
 * ------------------------------------------------------------------------
 * Class Definition
 * ------------------------------------------------------------------------
 */

var Sidebar = /*#__PURE__*/function () {
  function Sidebar(element, config) {
    _classCallCheck(this, Sidebar);

    if (typeof perfect_scrollbar__WEBPACK_IMPORTED_MODULE_4__["default"] === 'undefined') {
      throw new TypeError('CoreUI\'s sidebar require Perfect Scrollbar');
    }

    this._element = element;
    this._config = this._getConfig(config);
    this._open = this._isVisible();
    this._mobile = this._isMobile();
    this._overlaid = this._isOverlaid();
    this._minimize = this._isMinimized();
    this._unfoldable = this._isUnfoldable();

    this._setActiveLink();

    this._ps = null;
    this._backdrop = null;

    this._psInit();

    this._addEventListeners();

    _dom_data__WEBPACK_IMPORTED_MODULE_1__["default"].setData(element, DATA_KEY, this);
  } // Getters


  _createClass(Sidebar, [{
    key: "open",
    value: // Public
    function open(breakpoint) {
      var _this = this;

      _dom_event_handler__WEBPACK_IMPORTED_MODULE_2__["default"].trigger(this._element, EVENT_OPEN);

      if (this._isMobile()) {
        this._addClassName(this._firstBreakpointClassName());

        this._showBackdrop();

        _dom_event_handler__WEBPACK_IMPORTED_MODULE_2__["default"].one(this._element, _util__WEBPACK_IMPORTED_MODULE_0__["TRANSITION_END"], function () {
          _this._addClickOutListener();
        });
      } else if (breakpoint) {
        this._addClassName(this._getBreakpointClassName(breakpoint));

        if (this._isOverlaid()) {
          _dom_event_handler__WEBPACK_IMPORTED_MODULE_2__["default"].one(this._element, _util__WEBPACK_IMPORTED_MODULE_0__["TRANSITION_END"], function () {
            _this._addClickOutListener();
          });
        }
      } else {
        this._addClassName(this._firstBreakpointClassName());

        if (this._isOverlaid()) {
          _dom_event_handler__WEBPACK_IMPORTED_MODULE_2__["default"].one(this._element, _util__WEBPACK_IMPORTED_MODULE_0__["TRANSITION_END"], function () {
            _this._addClickOutListener();
          });
        }
      }

      var complete = function complete() {
        if (_this._isVisible() === true) {
          _this._open = true;
          _dom_event_handler__WEBPACK_IMPORTED_MODULE_2__["default"].trigger(_this._element, EVENT_OPENED);
        }
      };

      var transitionDuration = Object(_util__WEBPACK_IMPORTED_MODULE_0__["getTransitionDurationFromElement"])(this._element);
      _dom_event_handler__WEBPACK_IMPORTED_MODULE_2__["default"].one(this._element, _util__WEBPACK_IMPORTED_MODULE_0__["TRANSITION_END"], complete);
      Object(_util__WEBPACK_IMPORTED_MODULE_0__["emulateTransitionEnd"])(this._element, transitionDuration);
    }
  }, {
    key: "close",
    value: function close(breakpoint) {
      var _this2 = this;

      _dom_event_handler__WEBPACK_IMPORTED_MODULE_2__["default"].trigger(this._element, EVENT_CLOSE);

      if (this._isMobile()) {
        this._element.classList.remove(this._firstBreakpointClassName());

        this._removeBackdrop();

        this._removeClickOutListener();
      } else if (breakpoint) {
        this._element.classList.remove(this._getBreakpointClassName(breakpoint));

        if (this._isOverlaid()) {
          this._removeClickOutListener();
        }
      } else {
        this._element.classList.remove(this._firstBreakpointClassName());

        if (this._isOverlaid()) {
          this._removeClickOutListener();
        }
      }

      var complete = function complete() {
        if (_this2._isVisible() === false) {
          _this2._open = false;
          _dom_event_handler__WEBPACK_IMPORTED_MODULE_2__["default"].trigger(_this2._element, EVENT_CLOSED);
        }
      };

      var transitionDuration = Object(_util__WEBPACK_IMPORTED_MODULE_0__["getTransitionDurationFromElement"])(this._element);
      _dom_event_handler__WEBPACK_IMPORTED_MODULE_2__["default"].one(this._element, _util__WEBPACK_IMPORTED_MODULE_0__["TRANSITION_END"], complete);
      Object(_util__WEBPACK_IMPORTED_MODULE_0__["emulateTransitionEnd"])(this._element, transitionDuration);
    }
  }, {
    key: "toggle",
    value: function toggle(breakpoint) {
      if (this._open) {
        this.close(breakpoint);
      } else {
        this.open(breakpoint);
      }
    }
  }, {
    key: "minimize",
    value: function minimize() {
      if (!this._isMobile()) {
        this._addClassName(CLASS_NAME_SIDEBAR_MINIMIZED);

        this._minimize = true;

        this._psDestroy();
      }
    }
  }, {
    key: "unfoldable",
    value: function unfoldable() {
      if (!this._isMobile()) {
        this._addClassName(CLASS_NAME_SIDEBAR_UNFOLDABLE);

        this._unfoldable = true;
      }
    }
  }, {
    key: "reset",
    value: function reset() {
      if (this._element.classList.contains(CLASS_NAME_SIDEBAR_MINIMIZED)) {
        this._element.classList.remove(CLASS_NAME_SIDEBAR_MINIMIZED);

        this._minimize = false;
        _dom_event_handler__WEBPACK_IMPORTED_MODULE_2__["default"].one(this._element, _util__WEBPACK_IMPORTED_MODULE_0__["TRANSITION_END"], this._psInit());
      }

      if (this._element.classList.contains(CLASS_NAME_SIDEBAR_UNFOLDABLE)) {
        this._element.classList.remove(CLASS_NAME_SIDEBAR_UNFOLDABLE);

        this._unfoldable = false;
      }
    } // Private

  }, {
    key: "_getConfig",
    value: function _getConfig(config) {
      config = _objectSpread(_objectSpread(_objectSpread({}, this.constructor.Default), _dom_manipulator__WEBPACK_IMPORTED_MODULE_3__["default"].getDataAttributes(this._element)), config);
      Object(_util__WEBPACK_IMPORTED_MODULE_0__["typeCheckConfig"])(NAME, config, this.constructor.DefaultType);
      return config;
    }
  }, {
    key: "_isMobile",
    value: function _isMobile() {
      return Boolean(window.getComputedStyle(this._element, null).getPropertyValue('--is-mobile'));
    }
  }, {
    key: "_isIOS",
    value: function _isIOS() {
      var iOSDevices = ['iPad Simulator', 'iPhone Simulator', 'iPod Simulator', 'iPad', 'iPhone', 'iPod'];
      var platform = Boolean(navigator.platform);

      if (platform) {
        while (iOSDevices.length) {
          if (navigator.platform === iOSDevices.pop()) {
            return true;
          }
        }
      }

      return false;
    }
  }, {
    key: "_isMinimized",
    value: function _isMinimized() {
      return this._element.classList.contains(CLASS_NAME_SIDEBAR_MINIMIZED);
    }
  }, {
    key: "_isOverlaid",
    value: function _isOverlaid() {
      return this._element.classList.contains(CLASS_NAME_SIDEBAR_OVERLAID);
    }
  }, {
    key: "_isUnfoldable",
    value: function _isUnfoldable() {
      return this._element.classList.contains(CLASS_NAME_SIDEBAR_UNFOLDABLE);
    }
  }, {
    key: "_isVisible",
    value: function _isVisible() {
      var rect = this._element.getBoundingClientRect();

      return rect.top >= 0 && rect.left >= 0 && rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
      /* or $(window).height() */
      rect.right <= (window.innerWidth || document.documentElement.clientWidth)
      /* or $(window).width() */
      ;
    }
  }, {
    key: "_addClassName",
    value: function _addClassName(className) {
      this._element.classList.add(className);
    }
  }, {
    key: "_firstBreakpointClassName",
    value: function _firstBreakpointClassName() {
      return Object.keys(Default.breakpoints).map(function (key) {
        return Default.breakpoints[key];
      })[0];
    }
  }, {
    key: "_getBreakpointClassName",
    value: function _getBreakpointClassName(breakpoint) {
      return Default.breakpoints[breakpoint];
    }
  }, {
    key: "_removeBackdrop",
    value: function _removeBackdrop() {
      if (this._backdrop) {
        this._backdrop.parentNode.removeChild(this._backdrop);

        this._backdrop = null;
      }
    }
  }, {
    key: "_showBackdrop",
    value: function _showBackdrop() {
      if (!this._backdrop) {
        this._backdrop = document.createElement('div');
        this._backdrop.className = CLASS_NAME_BACKDROP;

        this._backdrop.classList.add(CLASS_NAME_FADE);

        document.body.appendChild(this._backdrop);
        Object(_util__WEBPACK_IMPORTED_MODULE_0__["reflow"])(this._backdrop);

        this._backdrop.classList.add(CLASS_NAME_SHOW);
      }
    }
  }, {
    key: "_clickOutListener",
    value: function _clickOutListener(event, sidebar) {
      if (event.target.closest(SELECTOR_SIDEBAR) === null) {
        // or use:
        event.preventDefault();
        event.stopPropagation();
        sidebar.close();
      }
    }
  }, {
    key: "_addClickOutListener",
    value: function _addClickOutListener() {
      var _this3 = this;

      _dom_event_handler__WEBPACK_IMPORTED_MODULE_2__["default"].on(document, EVENT_CLICK_DATA_API, function (event) {
        _this3._clickOutListener(event, _this3);
      });
    }
  }, {
    key: "_removeClickOutListener",
    value: function _removeClickOutListener() {
      _dom_event_handler__WEBPACK_IMPORTED_MODULE_2__["default"].off(document, EVENT_CLICK_DATA_API);
    } // Sidebar navigation

  }, {
    key: "_getAllSiblings",
    value: function _getAllSiblings(element, filter) {
      var siblings = [];
      element = element.parentNode.firstChild;

      do {
        if (element.nodeType === 3) {
          continue; // text node
        }

        if (element.nodeType === 8) {
          continue; // comment node
        }

        if (!filter || filter(element)) {
          siblings.push(element);
        } // eslint-disable-next-line no-cond-assign

      } while (element = element.nextSibling);

      return siblings;
    }
  }, {
    key: "_toggleDropdown",
    value: function _toggleDropdown(event, sidebar) {
      var toggler = event.target;

      if (!toggler.classList.contains(CLASS_NAME_NAV_DROPDOWN_TOGGLE)) {
        toggler = toggler.closest(SELECTOR_NAV_DROPDOWN_TOGGLE);
      }

      var dataAttributes = toggler.closest(SELECTOR_NAVIGATION_CONTAINER).dataset;

      if (typeof dataAttributes.dropdownAccordion !== 'undefined') {
        Default.dropdownAccordion = JSON.parse(dataAttributes.dropdownAccordion);
      } // TODO: find better solution


      if (Default.dropdownAccordion === true) {
        this._getAllSiblings(toggler.parentElement, function (element) {
          return Boolean(element.classList.contains(CLASS_NAME_NAV_DROPDOWN));
        }).forEach(function (element) {
          if (element !== toggler.parentNode) {
            if (element.classList.contains(CLASS_NAME_NAV_DROPDOWN)) {
              element.classList.remove(CLASS_NAME_SHOW);
            }
          }
        });
      }

      toggler.parentNode.classList.toggle(CLASS_NAME_SHOW); // TODO: Set the toggler's position near to cursor after the click.
      // TODO: add transition end

      sidebar._psUpdate();
    } // PerfectScrollbar

  }, {
    key: "_psInit",
    value: function _psInit() {
      if (this._element.querySelector(SELECTOR_NAVIGATION_CONTAINER) && !this._isIOS()) {
        this._ps = new perfect_scrollbar__WEBPACK_IMPORTED_MODULE_4__["default"](this._element.querySelector(SELECTOR_NAVIGATION_CONTAINER), {
          suppressScrollX: true,
          wheelPropagation: false
        });
      }
    }
  }, {
    key: "_psUpdate",
    value: function _psUpdate() {
      if (this._ps) {
        this._ps.update();
      }
    }
  }, {
    key: "_psDestroy",
    value: function _psDestroy() {
      if (this._ps) {
        this._ps.destroy();

        this._ps = null;
      }
    }
  }, {
    key: "_getParents",
    value: function _getParents(element, selector) {
      // Setup parents array
      var parents = []; // Get matching parent elements

      for (; element && element !== document; element = element.parentNode) {
        // Add matching parents to array
        if (selector) {
          if (element.matches(selector)) {
            parents.push(element);
          }
        } else {
          parents.push(element);
        }
      }

      return parents;
    }
  }, {
    key: "_setActiveLink",
    value: function _setActiveLink() {
      var _this4 = this;

      // eslint-disable-next-line unicorn/prefer-spread
      Array.from(this._element.querySelectorAll(SELECTOR_NAV_LINK)).forEach(function (element) {
        var currentUrl = String(window.location);
        var urlHasParams = /\?.*=/;
        var urlHasQueryString = /\?./;
        var urlHasHash = /#./;

        if (urlHasParams.test(currentUrl) || urlHasQueryString.test(currentUrl)) {
          currentUrl = currentUrl.split('?')[0];
        }

        if (urlHasHash.test(currentUrl)) {
          currentUrl = currentUrl.split('#')[0];
        }

        var dataAttributes = element.closest(SELECTOR_NAVIGATION_CONTAINER).dataset;

        if (typeof dataAttributes.activeLinksExact !== 'undefined') {
          Default.activeLinksExact = JSON.parse(dataAttributes.activeLinksExact);
        }

        if (Default.activeLinksExact && element.href === currentUrl) {
          // eslint-disable-next-line unicorn/prefer-spread
          Array.from(_this4._getParents(element, SELECTOR_NAV_DROPDOWN)).forEach(function (element) {
            element.classList.add(CLASS_NAME_SHOW);
          });
        }

        if (!Default.activeLinksExact && element.href.startsWith(currentUrl)) {
          element.classList.add(CLASS_NAME_ACTIVE); // eslint-disable-next-line unicorn/prefer-spread

          Array.from(_this4._getParents(element, SELECTOR_NAV_DROPDOWN)).forEach(function (element) {
            element.classList.add(CLASS_NAME_SHOW);
          });
        }
      });
    }
  }, {
    key: "_addEventListeners",
    value: function _addEventListeners() {
      var _this5 = this;

      if (this._mobile && this._open) {
        this._addClickOutListener();
      }

      if (this._overlaid && this._open) {
        this._addClickOutListener();
      }

      _dom_event_handler__WEBPACK_IMPORTED_MODULE_2__["default"].on(this._element, EVENT_CLASS_TOGGLE, function (event) {
        if (event.detail.className === CLASS_NAME_SIDEBAR_MINIMIZED) {
          if (_this5._element.classList.contains(CLASS_NAME_SIDEBAR_MINIMIZED)) {
            _this5.minimize();
          } else {
            _this5.reset();
          }
        }

        if (event.detail.className === CLASS_NAME_SIDEBAR_UNFOLDABLE) {
          if (_this5._element.classList.contains(CLASS_NAME_SIDEBAR_UNFOLDABLE)) {
            _this5.unfoldable();
          } else {
            _this5.reset();
          }
        }

        if (typeof Object.keys(Default.breakpoints).find(function (key) {
          return Default.breakpoints[key] === event.detail.className;
        }) !== 'undefined') {
          var className = event.detail.className;
          var breakpoint = Object.keys(Default.breakpoints).find(function (key) {
            return Default.breakpoints[key] === className;
          });

          if (event.detail.add) {
            _this5.open(breakpoint);
          } else {
            _this5.close(breakpoint);
          }
        }
      });
      _dom_event_handler__WEBPACK_IMPORTED_MODULE_2__["default"].on(this._element, EVENT_CLICK_DATA_API, SELECTOR_NAV_DROPDOWN_TOGGLE, function (event) {
        event.preventDefault();

        _this5._toggleDropdown(event, _this5);
      });
      _dom_event_handler__WEBPACK_IMPORTED_MODULE_2__["default"].on(this._element, EVENT_CLICK_DATA_API, SELECTOR_NAV_LINK, function () {
        if (_this5._isMobile()) {
          _this5.close();
        }
      });
    } // Static

  }], [{
    key: "VERSION",
    get: function get() {
      return VERSION;
    }
  }, {
    key: "Default",
    get: function get() {
      return Default;
    }
  }, {
    key: "DefaultType",
    get: function get() {
      return DefaultType;
    }
  }, {
    key: "_sidebarInterface",
    value: function _sidebarInterface(element, config) {
      var data = _dom_data__WEBPACK_IMPORTED_MODULE_1__["default"].getData(element, DATA_KEY);

      var _config = _typeof(config) === 'object' && config;

      if (!data) {
        data = new Sidebar(element, _config);
      }

      if (typeof config === 'string') {
        if (typeof data[config] === 'undefined') {
          throw new TypeError("No method named \"".concat(config, "\""));
        }

        data[config]();
      }
    }
  }, {
    key: "jQueryInterface",
    value: function jQueryInterface(config) {
      return this.each(function () {
        Sidebar._sidebarInterface(this, config);
      });
    }
  }, {
    key: "getInstance",
    value: function getInstance(element) {
      return _dom_data__WEBPACK_IMPORTED_MODULE_1__["default"].getData(element, DATA_KEY);
    }
  }]);

  return Sidebar;
}();
/**
 * ------------------------------------------------------------------------
 * Data Api implementation
 * ------------------------------------------------------------------------
 */


_dom_event_handler__WEBPACK_IMPORTED_MODULE_2__["default"].on(window, EVENT_LOAD_DATA_API, function () {
  // eslint-disable-next-line unicorn/prefer-spread
  Array.from(document.querySelectorAll(SELECTOR_SIDEBAR)).forEach(function (element) {
    Sidebar._sidebarInterface(element);
  });
});
var $ = Object(_util__WEBPACK_IMPORTED_MODULE_0__["getjQuery"])();
/**
 * ------------------------------------------------------------------------
 * jQuery
 * ------------------------------------------------------------------------
 */

if ($) {
  var JQUERY_NO_CONFLICT = $.fn[NAME];
  $.fn[NAME] = Sidebar.jQueryInterface;
  $.fn[NAME].Constructor = Sidebar;

  $.fn[NAME].noConflict = function () {
    $.fn[NAME] = JQUERY_NO_CONFLICT;
    return Sidebar.jQueryInterface;
  };
}

/* harmony default export */ __webpack_exports__["default"] = (Sidebar);

/***/ }),

/***/ "./resources/vendor/sidebar/util/index.js":
/*!************************************************!*\
  !*** ./resources/vendor/sidebar/util/index.js ***!
  \************************************************/
/*! exports provided: getjQuery, TRANSITION_END, getUID, getSelectorFromElement, getElementFromSelector, getTransitionDurationFromElement, triggerTransitionEnd, isElement, emulateTransitionEnd, typeCheckConfig, isVisible, findShadowRoot, noop, reflow */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "getjQuery", function() { return getjQuery; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "TRANSITION_END", function() { return TRANSITION_END; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "getUID", function() { return getUID; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "getSelectorFromElement", function() { return getSelectorFromElement; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "getElementFromSelector", function() { return getElementFromSelector; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "getTransitionDurationFromElement", function() { return getTransitionDurationFromElement; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "triggerTransitionEnd", function() { return triggerTransitionEnd; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "isElement", function() { return isElement; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "emulateTransitionEnd", function() { return emulateTransitionEnd; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "typeCheckConfig", function() { return typeCheckConfig; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "isVisible", function() { return isVisible; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "findShadowRoot", function() { return findShadowRoot; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "noop", function() { return noop; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "reflow", function() { return reflow; });
/**
 * --------------------------------------------------------------------------
 * Bootstrap (v5.0.0-alpha1): util/index.js
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * --------------------------------------------------------------------------
 */
var MAX_UID = 1000000;
var MILLISECONDS_MULTIPLIER = 1000;
var TRANSITION_END = 'transitionend'; // Shoutout AngusCroll (https://goo.gl/pxwQGp)

var toType = function toType(obj) {
  if (obj === null || obj === undefined) {
    return "".concat(obj);
  }

  return {}.toString.call(obj).match(/\s([a-z]+)/i)[1].toLowerCase();
};
/**
 * --------------------------------------------------------------------------
 * Public Util Api
 * --------------------------------------------------------------------------
 */


var getUID = function getUID(prefix) {
  do {
    prefix += Math.floor(Math.random() * MAX_UID);
  } while (document.getElementById(prefix));

  return prefix;
};

var getSelector = function getSelector(element) {
  var selector = element.getAttribute('data-target');

  if (!selector || selector === '#') {
    var hrefAttr = element.getAttribute('href');
    selector = hrefAttr && hrefAttr !== '#' ? hrefAttr.trim() : null;
  }

  return selector;
};

var getSelectorFromElement = function getSelectorFromElement(element) {
  var selector = getSelector(element);

  if (selector) {
    return document.querySelector(selector) ? selector : null;
  }

  return null;
};

var getElementFromSelector = function getElementFromSelector(element) {
  var selector = getSelector(element);
  return selector ? document.querySelector(selector) : null;
};

var getTransitionDurationFromElement = function getTransitionDurationFromElement(element) {
  if (!element) {
    return 0;
  } // Get transition-duration of the element


  var _window$getComputedSt = window.getComputedStyle(element),
      transitionDuration = _window$getComputedSt.transitionDuration,
      transitionDelay = _window$getComputedSt.transitionDelay;

  var floatTransitionDuration = parseFloat(transitionDuration);
  var floatTransitionDelay = parseFloat(transitionDelay); // Return 0 if element or transition duration is not found

  if (!floatTransitionDuration && !floatTransitionDelay) {
    return 0;
  } // If multiple durations are defined, take the first


  transitionDuration = transitionDuration.split(',')[0];
  transitionDelay = transitionDelay.split(',')[0];
  return (parseFloat(transitionDuration) + parseFloat(transitionDelay)) * MILLISECONDS_MULTIPLIER;
};

var triggerTransitionEnd = function triggerTransitionEnd(element) {
  element.dispatchEvent(new Event(TRANSITION_END));
};

var isElement = function isElement(obj) {
  return (obj[0] || obj).nodeType;
};

var emulateTransitionEnd = function emulateTransitionEnd(element, duration) {
  var called = false;
  var durationPadding = 5;
  var emulatedDuration = duration + durationPadding;

  function listener() {
    called = true;
    element.removeEventListener(TRANSITION_END, listener);
  }

  element.addEventListener(TRANSITION_END, listener);
  setTimeout(function () {
    if (!called) {
      triggerTransitionEnd(element);
    }
  }, emulatedDuration);
};

var typeCheckConfig = function typeCheckConfig(componentName, config, configTypes) {
  Object.keys(configTypes).forEach(function (property) {
    var expectedTypes = configTypes[property];
    var value = config[property];
    var valueType = value && isElement(value) ? 'element' : toType(value);

    if (!new RegExp(expectedTypes).test(valueType)) {
      throw new Error("".concat(componentName.toUpperCase(), ": ") + "Option \"".concat(property, "\" provided type \"").concat(valueType, "\" ") + "but expected type \"".concat(expectedTypes, "\"."));
    }
  });
};

var isVisible = function isVisible(element) {
  if (!element) {
    return false;
  }

  if (element.style && element.parentNode && element.parentNode.style) {
    var elementStyle = getComputedStyle(element);
    var parentNodeStyle = getComputedStyle(element.parentNode);
    return elementStyle.display !== 'none' && parentNodeStyle.display !== 'none' && elementStyle.visibility !== 'hidden';
  }

  return false;
};

var findShadowRoot = function findShadowRoot(element) {
  if (!document.documentElement.attachShadow) {
    return null;
  } // Can find the shadow root otherwise it'll return the document


  if (typeof element.getRootNode === 'function') {
    var root = element.getRootNode();
    return root instanceof ShadowRoot ? root : null;
  }

  if (element instanceof ShadowRoot) {
    return element;
  } // when we don't find a shadow root


  if (!element.parentNode) {
    return null;
  }

  return findShadowRoot(element.parentNode);
};

var noop = function noop() {
  return function () {};
};

var reflow = function reflow(element) {
  return element.offsetHeight;
};

var getjQuery = function getjQuery() {
  var _window = window,
      jQuery = _window.jQuery;

  if (jQuery && !document.body.hasAttribute('data-no-jquery')) {
    return jQuery;
  }

  return null;
};



/***/ }),

/***/ 11:
/*!*****************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** multi ./resources/vendor/sidebar/sidebar.js ./resources/vendor/sidebar/class-toggler.js ./resources/vendor/sidebar/dom/data.js ./resources/vendor/sidebar/dom/event-handler.js ./resources/vendor/sidebar/dom/manipulator.js ./resources/vendor/sidebar/util/index.js ***!
  \*****************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\Nurdaulet\web\laravel-admin-panel\resources\vendor\sidebar\sidebar.js */"./resources/vendor/sidebar/sidebar.js");
__webpack_require__(/*! C:\Nurdaulet\web\laravel-admin-panel\resources\vendor\sidebar\class-toggler.js */"./resources/vendor/sidebar/class-toggler.js");
__webpack_require__(/*! C:\Nurdaulet\web\laravel-admin-panel\resources\vendor\sidebar\dom\data.js */"./resources/vendor/sidebar/dom/data.js");
__webpack_require__(/*! C:\Nurdaulet\web\laravel-admin-panel\resources\vendor\sidebar\dom\event-handler.js */"./resources/vendor/sidebar/dom/event-handler.js");
__webpack_require__(/*! C:\Nurdaulet\web\laravel-admin-panel\resources\vendor\sidebar\dom\manipulator.js */"./resources/vendor/sidebar/dom/manipulator.js");
module.exports = __webpack_require__(/*! C:\Nurdaulet\web\laravel-admin-panel\resources\vendor\sidebar\util\index.js */"./resources/vendor/sidebar/util/index.js");


/***/ })

/******/ });