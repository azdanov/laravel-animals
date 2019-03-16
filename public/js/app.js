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
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/images sync \\.(png|jpe?g|svg)$":
/*!***************************************************************!*\
  !*** ./resources/images sync nonrecursive \.(png|jpe?g|svg)$ ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var map = {
	"./amazon_parrot.jpg": "./resources/images/amazon_parrot.jpg",
	"./animals.svg": "./resources/images/animals.svg",
	"./anna.jpg": "./resources/images/anna.jpg",
	"./atlantic_canary.jpg": "./resources/images/atlantic_canary.jpg",
	"./beagle.jpg": "./resources/images/beagle.jpg",
	"./bird.svg": "./resources/images/bird.svg",
	"./brittany.png": "./resources/images/brittany.png",
	"./bulldog.jpg": "./resources/images/bulldog.jpg",
	"./cat.svg": "./resources/images/cat.svg",
	"./catdog.jpg": "./resources/images/catdog.jpg",
	"./chihuahua.jpg": "./resources/images/chihuahua.jpg",
	"./dog.svg": "./resources/images/dog.svg",
	"./labrador_retriever.jpg": "./resources/images/labrador_retriever.jpg",
	"./lovebird.jpg": "./resources/images/lovebird.jpg",
	"./maine_coon.jpg": "./resources/images/maine_coon.jpg",
	"./persian_cat.jpg": "./resources/images/persian_cat.jpg",
	"./russian_blue.jpg": "./resources/images/russian_blue.jpg",
	"./siamese_cat.jpg": "./resources/images/siamese_cat.jpg",
	"./taylor.png": "./resources/images/taylor.png"
};


function webpackContext(req) {
	var id = webpackContextResolve(req);
	return __webpack_require__(id);
}
function webpackContextResolve(req) {
	if(!__webpack_require__.o(map, req)) {
		var e = new Error("Cannot find module '" + req + "'");
		e.code = 'MODULE_NOT_FOUND';
		throw e;
	}
	return map[req];
}
webpackContext.keys = function webpackContextKeys() {
	return Object.keys(map);
};
webpackContext.resolve = webpackContextResolve;
module.exports = webpackContext;
webpackContext.id = "./resources/images sync \\.(png|jpe?g|svg)$";

/***/ }),

/***/ "./resources/images/amazon_parrot.jpg":
/*!********************************************!*\
  !*** ./resources/images/amazon_parrot.jpg ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/amazon_parrot.jpg?b090ecf02aeb3660682505c0ac5f9b4f";

/***/ }),

/***/ "./resources/images/animals.svg":
/*!**************************************!*\
  !*** ./resources/images/animals.svg ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/animals.svg?8583f40d1569368aa601c55ed6028319";

/***/ }),

/***/ "./resources/images/anna.jpg":
/*!***********************************!*\
  !*** ./resources/images/anna.jpg ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/anna.jpg?487efa01ccb4f01616741d026a2baddc";

/***/ }),

/***/ "./resources/images/atlantic_canary.jpg":
/*!**********************************************!*\
  !*** ./resources/images/atlantic_canary.jpg ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/atlantic_canary.jpg?a1e133a339334699bf7a9f5dac03b505";

/***/ }),

/***/ "./resources/images/beagle.jpg":
/*!*************************************!*\
  !*** ./resources/images/beagle.jpg ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/beagle.jpg?25e0a63ada6ccded149bb325a6bd8749";

/***/ }),

/***/ "./resources/images/bird.svg":
/*!***********************************!*\
  !*** ./resources/images/bird.svg ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/bird.svg?144a07fd3c7aafc0ef2f28274233aec7";

/***/ }),

/***/ "./resources/images/brittany.png":
/*!***************************************!*\
  !*** ./resources/images/brittany.png ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/brittany.png?6b7def0a8914183e00a7b7628e5cc2d0";

/***/ }),

/***/ "./resources/images/bulldog.jpg":
/*!**************************************!*\
  !*** ./resources/images/bulldog.jpg ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/bulldog.jpg?95191734f72433c7e688f5f7f3b9d635";

/***/ }),

/***/ "./resources/images/cat.svg":
/*!**********************************!*\
  !*** ./resources/images/cat.svg ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/cat.svg?afd37979d36744cf255474784f7c847d";

/***/ }),

/***/ "./resources/images/catdog.jpg":
/*!*************************************!*\
  !*** ./resources/images/catdog.jpg ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/catdog.jpg?c905d21f237a28f7b8ee01985e3a976f";

/***/ }),

/***/ "./resources/images/chihuahua.jpg":
/*!****************************************!*\
  !*** ./resources/images/chihuahua.jpg ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/chihuahua.jpg?2e8a405955e849ffef07ce9f44a24319";

/***/ }),

/***/ "./resources/images/dog.svg":
/*!**********************************!*\
  !*** ./resources/images/dog.svg ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/dog.svg?71c1da0ea39ba8fd5be524103fed3c01";

/***/ }),

/***/ "./resources/images/labrador_retriever.jpg":
/*!*************************************************!*\
  !*** ./resources/images/labrador_retriever.jpg ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/labrador_retriever.jpg?b530c2f55c379732eea833ea1beeba6f";

/***/ }),

/***/ "./resources/images/lovebird.jpg":
/*!***************************************!*\
  !*** ./resources/images/lovebird.jpg ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/lovebird.jpg?44f531740f00ab427eea71ca5a370135";

/***/ }),

/***/ "./resources/images/maine_coon.jpg":
/*!*****************************************!*\
  !*** ./resources/images/maine_coon.jpg ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/maine_coon.jpg?05c601ee8fd8e7d87b668db6fa38bb48";

/***/ }),

/***/ "./resources/images/persian_cat.jpg":
/*!******************************************!*\
  !*** ./resources/images/persian_cat.jpg ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/persian_cat.jpg?586ff1c5c761a619010ebbb8aba53e16";

/***/ }),

/***/ "./resources/images/russian_blue.jpg":
/*!*******************************************!*\
  !*** ./resources/images/russian_blue.jpg ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/russian_blue.jpg?a7dbba98e35f4debd5af7c4197fdf8af";

/***/ }),

/***/ "./resources/images/siamese_cat.jpg":
/*!******************************************!*\
  !*** ./resources/images/siamese_cat.jpg ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/siamese_cat.jpg?646f24c7e3d71b5d25f04c0a26eb99ec";

/***/ }),

/***/ "./resources/images/taylor.png":
/*!*************************************!*\
  !*** ./resources/images/taylor.png ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "/images/taylor.png?0212174eb4c6b4543aab5e5dcca9c924";

/***/ }),

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _bootstrap__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./bootstrap */ "./resources/js/bootstrap.js");
/* harmony import */ var _bootstrap__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_bootstrap__WEBPACK_IMPORTED_MODULE_0__);


/***/ }),

/***/ "./resources/js/bootstrap.js":
/*!***********************************!*\
  !*** ./resources/js/bootstrap.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

function importAll(r) {
  var images = {};
  r.keys().map(function (item) {
    images[item.replace('./', '')] = r(item);
  });
  return images;
}

var images = importAll(__webpack_require__("./resources/images sync \\.(png|jpe?g|svg)$"));
document.addEventListener('DOMContentLoaded', function () {
  var $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

  if ($navbarBurgers.length > 0) {
    $navbarBurgers.forEach(function ($el) {
      $el.addEventListener('click', function () {
        var target = $el.dataset.target;
        var $target = document.getElementById(target);
        $el.classList.toggle('is-active');
        $target.classList.toggle('is-active');
      });
    });
  }
});

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/app.scss ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Users/azdanov/Projects/php/animals/resources/js/app.js */"./resources/js/app.js");
module.exports = __webpack_require__(/*! /Users/azdanov/Projects/php/animals/resources/sass/app.scss */"./resources/sass/app.scss");


/***/ })

/******/ });