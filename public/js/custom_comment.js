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
/******/ 	return __webpack_require__(__webpack_require__.s = 52);
/******/ })
/************************************************************************/
/******/ ({

/***/ 52:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(53);


/***/ }),

/***/ 53:
/***/ (function(module, exports) {

$(document).ready(function () {
    if (document.getElementById("commment-body").value === "") {
        document.getElementById('send-comment').disabled = true;
    } else {
        document.getElementById('send-comment').disabled = false;
    }

    checkCommentReply();
    var id;
    function checkCommentReply() {
        if (document.getElementById("input-comment-" + id).value === "") {
            document.getElementById('send-reply-comment-' + id).disabled = true;
        } else {
            document.getElementById('send-reply-comment-' + id).disabled = false;
        }
    }

    $(".frm-comment").css('display', 'none');
    $(".reply-comment").css('display', 'none');

    $(".comment_option").on('click', '.show_reply', function (e) {
        e.preventDefault();
        $(".frm-comment").css('display', 'none');
        var comment_id = $(this).data('id');
        $('#comment-' + comment_id).show();
        document.getElementById("input-comment-" + comment_id).focus();
        id = comment_id;
    });

    $(".close_comment").on('click', function (e) {
        e.preventDefault();
        $(".frm-comment").css('display', 'none');
    });

    $(".reply_comment_option").on('click', function (e) {
        e.preventDefault();
        var reply_comment_id = $(this).data('id');

        var divelement = document.getElementById('reply-comment-' + reply_comment_id);

        if (divelement.style.display == 'none') {
            divelement.style.display = 'block';
            $('#view-opion-' + reply_comment_id).text('Ân câu trả lời');
        } else {

            divelement.style.display = 'none';
            $('#view-opion-' + reply_comment_id).text('Xem các câu trả lời');
        }
    });
});

/***/ })

/******/ });