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
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 48);
/******/ })
/************************************************************************/
/******/ ({

/***/ 48:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(49);


/***/ }),

/***/ 49:
/***/ (function(module, exports) {

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var save = false;
var first_status_post = $("#btn-save-post").data('save');
if (first_status_post == 1) {
    document.getElementById("btn-save-post").title = "Unsave";
    document.getElementById("btn-save-post").style.backgroundColor = "#e40a0a";
    save = true;
}
if (first_status_post == 0) {
    document.getElementById("btn-save-post").title = "Save";
    document.getElementById("btn-save-post").style.backgroundColor = "#007bff";
    save = false;
}

$("#btn-save-post").on('click', function (e) {
    e.preventDefault();
    var post_id = $(this).data('id');

    if (save == false) {
        $.get('storages/posts/save', { id: post_id }, function (data) {
            if (data.authenticated) {
                console.log(data);
                $('#message-state-post').css('display', 'block');
                $('#message-state-post').html(data.authenticated);
                $('#message-state-post').addClass(data.class_name);

                $("#message-state-post").fadeTo(2000, 500).slideUp(500, function () {
                    $("#message-state-post").slideUp(500);
                });
            } else {
                document.getElementById("btn-save-post").title = "Unsave";
                document.getElementById("btn-save-post").style.backgroundColor = "#e40a0a";
                save = true;
                $('#message-state-post').css('display', 'block');
                $('#message-state-post').html(data.message);
                $('#message-state-post').addClass(data.class_name);

                $("#message-state-post").fadeTo(2000, 500).slideUp(500, function () {
                    $("#message-state-post").slideUp(500);
                });
            }
        });
    } else if (save == true) {
        $.get('storages/posts/remove', { id: post_id }, function (data) {
            document.getElementById("btn-save-post").title = "Save";
            document.getElementById("btn-save-post").style.backgroundColor = "#007bff";
            save = false;

            $('#message-state-post').css('display', 'block');
            $('#message-state-post').html(data.message);
            $('#message-state-post').addClass(data.class_name);

            $("#message-state-post").fadeTo(2000, 500).slideUp(500, function () {
                $("#message-state-post").slideUp(500);
            });
        });
    }
});

/***/ })

/******/ });