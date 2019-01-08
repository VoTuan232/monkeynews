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
/******/ 	return __webpack_require__(__webpack_require__.s = 44);
/******/ })
/************************************************************************/
/******/ ({

/***/ 44:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(45);


/***/ }),

/***/ 45:
/***/ (function(module, exports) {

var like = 1;
var first_status_post = $("#btn-like-post").data('like');
if (first_status_post == 2) {
    document.getElementById("btn-like-post").title = "Bỏ like";
    document.getElementById("btn-like-post").style.backgroundColor = "#e40a0a";

    document.getElementById("btn-dislike-post").title = "Dislike";
    document.getElementById("btn-dislike-post").style.backgroundColor = "#007bff";

    like = 2;
}
if (first_status_post == 0) {
    document.getElementById("btn-like-post").title = "Like";
    document.getElementById("btn-like-post").style.backgroundColor = "#007bff";

    document.getElementById("btn-dislike-post").title = "Bỏ Dislike";
    document.getElementById("btn-dislike-post").style.backgroundColor = "#e40a0a";
    like = 0;
}

$("#btn-like-post").on('click', function (e) {
    e.preventDefault();

    var post_id = $(this).data('id');

    if (like != 2) {
        $.get('state/posts/like', { id: post_id }, function (data) {
            if (data.authenticated) {
                $('#message-state-post').css('display', 'block');
                $('#message-state-post').html(data.authenticated);
                $('#message-state-post').addClass(data.class_name);

                $("#message-state-post").fadeTo(2000, 500).slideUp(500, function () {
                    $("#message-state-post").slideUp(500);
                });
            } else {
                document.getElementById("btn-like-post").title = "Remove Like";
                document.getElementById("btn-like-post").style.backgroundColor = "#e40a0a";
                document.getElementById("btn-dislike-post").title = "Dislike";
                document.getElementById("btn-dislike-post").style.backgroundColor = "#007bff";

                $("#number-like-post").text(data.post_data.like);
                $("#number-dislike-post").text(data.post_data.dislike);

                like = 2;
                $('#message-state-post').css('display', 'block');
                $('#message-state-post').html(data.message);
                $('#message-state-post').addClass(data.class_name);

                $("#message-state-post").fadeTo(2000, 500).slideUp(500, function () {
                    $("#message-state-post").slideUp(500);
                });
            }
        });
    } else if (like == 2) {
        $.get('state/posts/removeLike', { id: post_id }, function (data) {
            document.getElementById("btn-like-post").title = "Like";
            document.getElementById("btn-like-post").style.backgroundColor = "#007bff";

            $("#number-dislike-post").text(data.post_data.dislike);
            $("#number-like-post").text(data.post_data.like);

            like = 1;

            $('#message-state-post').css('display', 'block');
            $('#message-state-post').html(data.message);
            $('#message-state-post').addClass(data.class_name);

            $("#message-state-post").fadeTo(2000, 500).slideUp(500, function () {
                $("#message-state-post").slideUp(500);
            });
        });
    }
});

$("#btn-dislike-post").on('click', function (e) {
    e.preventDefault();

    var post_id = $(this).data('id');
    if (like != 0) {
        $.get('state/posts/dislike', { id: post_id }, function (data) {
            if (data.authenticated) {
                $('#message-state-post').css('display', 'block');
                $('#message-state-post').html(data.authenticated);
                $('#message-state-post').addClass(data.class_name);

                $("#message-state-post").fadeTo(2000, 500).slideUp(500, function () {
                    $("#message-state-post").slideUp(500);
                });
            } else {
                document.getElementById("btn-dislike-post").title = "Bỏ Dislike";
                document.getElementById("btn-dislike-post").style.backgroundColor = "#e40a0a";
                document.getElementById("btn-like-post").style.backgroundColor = "#007bff";

                document.getElementById("btn-like-post").title = "Like";

                $("#number-like-post").text(data.post_data.like);
                $("#number-dislike-post").text(data.post_data.dislike);

                like = 0;
                $('#message-state-post').css('display', 'block');
                $('#message-state-post').html(data.message);
                $('#message-state-post').addClass(data.class_name);

                $("#message-state-post").fadeTo(2000, 500).slideUp(500, function () {
                    $("#message-state-post").slideUp(500);
                });
            }
        });
    } else if (like == 0) {
        $.get('state/posts/removeDislike', { id: post_id }, function (data) {
            document.getElementById("btn-dislike-post").title = "Dislike";
            document.getElementById("btn-dislike-post").style.backgroundColor = "#007bff";

            $("#number-dislike-post").text(data.post_data.dislike);
            $("#number-like-post").text(data.post_data.like);

            like = 1;

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