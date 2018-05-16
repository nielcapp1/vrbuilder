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
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(1);
module.exports = __webpack_require__(2);


/***/ }),
/* 1 */
/***/ (function(module, exports) {

// Start upload preview image
var $uploadCrop = void 0;
var uploadCroppedThumbnail = void 0;
var uploadCroppedSlide1 = void 0;
var uploadCroppedSlide2 = void 0;
var uploadCroppedSlide3 = void 0;
var uploadCroppedSlide4 = void 0;
var uploadCroppedSlide5 = void 0;
var uploadCroppedSlide6 = void 0;
var tempFilename = void 0;
var imageFromInput = void 0;
var thumbnailFromInput = void 0;
var slide1FromInput = void 0;
var slide2FromInput = void 0;
var slide3FromInput = void 0;
var slide4FromInput = void 0;
var slide5FromInput = void 0;
var slide6FromInput = void 0;
var imageId = void 0;

function readPano(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#pano-img-output').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function readAudio(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#audio-output').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function readVideoPano(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#video-pano-output').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function readSlide1(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.upload-slide-1').addClass('ready');
            $('#crop-slide-1-modal').modal('open');
            slide1FromInput = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        console.log("Sorry - you're browser doesn't support the FileReader API");
    }
}

function readSlide2(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.upload-slide-2').addClass('ready');
            $('#crop-slide-2-modal').modal('open');
            slide2FromInput = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        console.log("Sorry - you're browser doesn't support the FileReader API");
    }
}

function readSlide3(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.upload-slide-3').addClass('ready');
            $('#crop-slide-3-modal').modal('open');
            slide3FromInput = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        console.log("Sorry - you're browser doesn't support the FileReader API");
    }
}

function readSlide4(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.upload-slide-4').addClass('ready');
            $('#crop-slide-4-modal').modal('open');
            slide4FromInput = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        console.log("Sorry - you're browser doesn't support the FileReader API");
    }
}

function readSlide5(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.upload-slide-5').addClass('ready');
            $('#crop-slide-5-modal').modal('open');
            slide5FromInput = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        console.log("Sorry - you're browser doesn't support the FileReader API");
    }
}

function readSlide6(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.upload-slide-6').addClass('ready');
            $('#crop-slide-6-modal').modal('open');
            slide6FromInput = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        console.log("Sorry - you're browser doesn't support the FileReader API");
    }
}

$("#pano").change(function () {
    readPano(this);
});

$("#audio").change(function () {
    readAudio(this);
    var fullPath = document.getElementById('audio').value;
    if (fullPath) {
        var startIndex = fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/');
        var filename = fullPath.substring(startIndex);
        if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
            filename = filename.substring(1);
        }
        $('#audio-name').text(filename);
    }
});

$("#video_pano").change(function () {
    readVideoPano(this);
    var fullPath = document.getElementById('video_pano').value;
    if (fullPath) {
        var startIndex = fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/');
        var filename = fullPath.substring(startIndex);
        if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
            filename = filename.substring(1);
        }
        $('#video-pano-name').text(filename);
    }
});

$(document).ready(function () {

    $('.card-preview').hide();
    $('.empty-fields').hide();
    $('.empty-fields-info').show();

    $('.tabs').tabs();

    $('.tabs').tabs('updateTabIndicator');

    $('.step-one').click(function () {
        $('.tabs').tabs('select', 'step1');
    });

    $('.step-two').click(function () {
        $('.tabs').tabs('select', 'step2');
    });

    $('.step-three').click(function () {
        $('.tabs').tabs('select', 'step3');
    });

    $('.step-four').click(function () {
        $('.tabs').tabs('select', 'step4');
    });

    $('.step-five').click(function () {
        $('.tabs').tabs('select', 'step5');
    });
});

// Modal for Errors
$('#error-modal').modal({
    dismissible: false,
    opacity: .85,
    in_duration: 300,
    out_duration: 200
});

// Thumbnail Crop

$('#crop-thumbnail-modal').modal({
    dismissible: false,
    opacity: .85,
    in_duration: 300,
    out_duration: 200,
    onOpenEnd: function onOpenEnd() {
        $uploadCroppedThumbnail.croppie('bind', {
            url: thumbnailFromInput
        }).then(function () {
            console.log('jQuery bind complete');
        });
    }
});

$('#crop-slide-1-modal').modal({
    dismissible: false,
    opacity: .85,
    in_duration: 300,
    out_duration: 200,
    onOpenEnd: function onOpenEnd() {
        $uploadCroppedSlide1.croppie('bind', {
            url: slide1FromInput
        }).then(function () {
            console.log('jQuery bind complete');
        });
    }
});

$('#crop-slide-2-modal').modal({
    dismissible: false,
    opacity: .85,
    in_duration: 300,
    out_duration: 200,
    onOpenEnd: function onOpenEnd() {
        $uploadCroppedSlide2.croppie('bind', {
            url: slide2FromInput
        }).then(function () {
            console.log('jQuery bind complete');
        });
    }
});

$('#crop-slide-3-modal').modal({
    dismissible: false,
    opacity: .85,
    in_duration: 300,
    out_duration: 200,
    onOpenEnd: function onOpenEnd() {
        $uploadCroppedSlide3.croppie('bind', {
            url: slide3FromInput
        }).then(function () {
            console.log('jQuery bind complete');
        });
    }
});

$('#crop-slide-4-modal').modal({
    dismissible: false,
    opacity: .85,
    in_duration: 300,
    out_duration: 200,
    onOpenEnd: function onOpenEnd() {
        $uploadCroppedSlide4.croppie('bind', {
            url: slide4FromInput
        }).then(function () {
            console.log('jQuery bind complete');
        });
    }
});

$('#crop-slide-5-modal').modal({
    dismissible: false,
    opacity: .85,
    in_duration: 300,
    out_duration: 200,
    onOpenEnd: function onOpenEnd() {
        $uploadCroppedSlide5.croppie('bind', {
            url: slide5FromInput
        }).then(function () {
            console.log('jQuery bind complete');
        });
    }
});

$('#crop-slide-6-modal').modal({
    dismissible: false,
    opacity: .85,
    in_duration: 300,
    out_duration: 200,
    onOpenEnd: function onOpenEnd() {
        $uploadCroppedSlide6.croppie('bind', {
            url: slide6FromInput
        }).then(function () {
            console.log('jQuery bind complete');
        });
    }
});

// Initialize Croppie
var $uploadCroppedThumbnail = $('#upload-thumbnail').croppie({
    enableExif: true,
    viewport: {
        width: 200,
        height: 100,
        type: 'square'
    },
    showZoomer: true,
    enforceBoundary: true
});

// Initialize Croppie Slide 1
var $uploadCroppedSlide1 = $('#upload-slide-1').croppie({
    enableExif: true,
    viewport: {
        width: 200,
        height: 200,
        type: 'square'
    },
    showZoomer: true,
    enforceBoundary: true
});

// Initialize Croppie Slide 2
var $uploadCroppedSlide2 = $('#upload-slide-2').croppie({
    enableExif: true,
    viewport: {
        width: 200,
        height: 200,
        type: 'square'
    },
    showZoomer: true,
    enforceBoundary: true
});

// Initialize Croppie Slide 3
var $uploadCroppedSlide3 = $('#upload-slide-3').croppie({
    enableExif: true,
    viewport: {
        width: 200,
        height: 200,
        type: 'square'
    },
    showZoomer: true,
    enforceBoundary: true
});

// Initialize Croppie Slide 4
var $uploadCroppedSlide4 = $('#upload-slide-4').croppie({
    enableExif: true,
    viewport: {
        width: 200,
        height: 200,
        type: 'square'
    },
    showZoomer: true,
    enforceBoundary: true
});

// Initialize Croppie Slide 5
var $uploadCroppedSlide5 = $('#upload-slide-5').croppie({
    enableExif: true,
    viewport: {
        width: 200,
        height: 200,
        type: 'square'
    },
    showZoomer: true,
    enforceBoundary: true
});

// Initialize Croppie Slide 6
var $uploadCroppedSlide6 = $('#upload-slide-6').croppie({
    enableExif: true,
    viewport: {
        width: 200,
        height: 200,
        type: 'square'
    },
    showZoomer: true,
    enforceBoundary: true
});

// Thumbnail Input is filled
$('.thumbnail-input').on('change', function () {
    imageId = $(this).data('id');
    tempFilename = $(this).val();
    readThumbnail(this);
});

// Thumbnail Input is filled
$('.slide-1-input').on('change', function () {
    imageId = $(this).data('id');
    tempFilename = $(this).val();
    readSlide1(this);
});

$('.slide-2-input').on('change', function () {
    imageId = $(this).data('id');
    tempFilename = $(this).val();
    readSlide2(this);
});

$('.slide-3-input').on('change', function () {
    imageId = $(this).data('id');
    tempFilename = $(this).val();
    readSlide3(this);
});

$('.slide-4-input').on('change', function () {
    imageId = $(this).data('id');
    tempFilename = $(this).val();
    readSlide4(this);
});

$('.slide-5-input').on('change', function () {
    imageId = $(this).data('id');
    tempFilename = $(this).val();
    readSlide5(this);
});

$('.slide-6-input').on('change', function () {
    imageId = $(this).data('id');
    tempFilename = $(this).val();
    readSlide6(this);
});

// Read the thumbnail
// Open modal
function readThumbnail(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.upload-thumbnail').addClass('ready');
            $('#crop-thumbnail-modal').modal('open');
            thumbnailFromInput = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        console.log("Sorry - you're browser doesn't support the FileReader API");
    }
}

$('#cropThumbnailButton').on('click', function (ev) {
    $uploadCroppedThumbnail.croppie('result', {
        type: 'base64',
        format: 'jpeg',
        size: { width: 1000, height: 500 }
    }).then(function (resp) {
        $("#thumbnailEncoded").val(resp);
        $('#thumbnail-img-output').attr('src', resp);
        $('#card-thumbnail-img-output').attr('src', resp);
        $('#crop-thumbnail-modal').modal('close');
    });
});

$('#cropSlide1Button').on('click', function (ev) {
    $uploadCroppedSlide1.croppie('result', {
        type: 'base64',
        format: 'jpeg',
        size: { width: 1000, height: 1000 }
    }).then(function (resp) {
        $("#slide-1-Encoded").val(resp);
        $('#slide-1-img-output').attr('src', resp);
        $('#card-slide-1-img-output').attr('src', resp);
        $('#crop-slide-1-modal').modal('close');
    });
});

$('#cropSlide2Button').on('click', function (ev) {
    $uploadCroppedSlide2.croppie('result', {
        type: 'base64',
        format: 'jpeg',
        size: { width: 1000, height: 1000 }
    }).then(function (resp) {
        $("#slide-2-Encoded").val(resp);
        $('#slide-2-img-output').attr('src', resp);
        $('#card-slide-2-img-output').attr('src', resp);
        $('#crop-slide-2-modal').modal('close');
    });
});

$('#cropSlide3Button').on('click', function (ev) {
    $uploadCroppedSlide3.croppie('result', {
        type: 'base64',
        format: 'jpeg',
        size: { width: 1000, height: 1000 }
    }).then(function (resp) {
        $("#slide-3-Encoded").val(resp);
        $('#slide-3-img-output').attr('src', resp);
        $('#card-slide-3-img-output').attr('src', resp);
        $('#crop-slide-3-modal').modal('close');
    });
});

$('#cropSlide4Button').on('click', function (ev) {
    $uploadCroppedSlide4.croppie('result', {
        type: 'base64',
        format: 'jpeg',
        size: { width: 1000, height: 1000 }
    }).then(function (resp) {
        $("#slide-4-Encoded").val(resp);
        $('#slide-4-img-output').attr('src', resp);
        $('#card-slide-4-img-output').attr('src', resp);
        $('#crop-slide-4-modal').modal('close');
    });
});

$('#cropSlide5Button').on('click', function (ev) {
    $uploadCroppedSlide5.croppie('result', {
        type: 'base64',
        format: 'jpeg',
        size: { width: 1000, height: 1000 }
    }).then(function (resp) {
        $("#slide-5-Encoded").val(resp);
        $('#slide-5-img-output').attr('src', resp);
        $('#card-slide-5-img-output').attr('src', resp);
        $('#crop-slide-5-modal').modal('close');
    });
});

$('#cropSlide6Button').on('click', function (ev) {
    $uploadCroppedSlide6.croppie('result', {
        type: 'base64',
        format: 'jpeg',
        size: { width: 1000, height: 1000 }
    }).then(function (resp) {
        $("#slide-6-Encoded").val(resp);
        $('#slide-6-img-output').attr('src', resp);
        $('#card-slide-6-img-output').attr('src', resp);
        $('#crop-slide-6-modal').modal('close');
    });
});

$('#title').on('change', function () {
    var value = $('#title').val();
    $('#card-title').text(value);
    $('.card-preview').show();
    $('.empty-fields').show();
    $('.empty-fields-info').hide();
});

$('#thumbnail').on('change', function () {
    $('.card-preview').show();
    $('.empty-fields').show();
    $('.empty-fields-info').hide();
});

// RADIO BUTTONS CHECK
if ($("#slides_2").is(':checked')) {
    $("#slides_1_input").show();
    $("#slides_2_input").show();
    $("#slides_3_input").hide();
    $("#slides_4_input").hide();
    $("#slides_5_input").hide();
    $("#slides_6_input").hide();
    $("#slide-1-Encoded").hide().attr("required", "true");
    $("#slide-2-Encoded").hide().attr("required", "true");
    $("#slide-3-Encoded").hide().attr('disabled', 'disabled');
    $("#slide-4-Encoded").hide().attr('disabled', 'disabled');
    $("#slide-5-Encoded").hide().attr('disabled', 'disabled');
    $("#slide-6-Encoded").hide().attr('disabled', 'disabled');
}

if ($("#slides_3").is(':checked')) {
    $("#slides_1_input").show();
    $("#slides_2_input").show();
    $("#slides_3_input").show();
    $("#slides_4_input").hide();
    $("#slides_5_input").hide();
    $("#slides_6_input").hide();
    $("#slide-1-Encoded").hide().attr("required", "true");
    $("#slide-2-Encoded").hide().attr("required", "true");
    $("#slide-3-Encoded").hide().attr("required", "true");
    $("#slide-4-Encoded").hide().attr('disabled', 'disabled');
    $("#slide-5-Encoded").hide().attr('disabled', 'disabled');
    $("#slide-6-Encoded").hide().attr('disabled', 'disabled');
}

if ($("#slides_4").is(':checked')) {
    $("#slides_1_input").show();
    $("#slides_2_input").show();
    $("#slides_3_input").show();
    $("#slides_4_input").show();
    $("#slides_5_input").hide();
    $("#slides_6_input").hide();
    $("#slide-1-Encoded").hide().attr("required", "true");
    $("#slide-2-Encoded").hide().attr("required", "true");
    $("#slide-3-Encoded").hide().attr("required", "true");
    $("#slide-4-Encoded").hide().attr("required", "true");
    $("#slide-5-Encoded").hide().attr('disabled', 'disabled');
    $("#slide-6-Encoded").hide().attr('disabled', 'disabled');
}

if ($("#slides_5").is(':checked')) {
    $("#slides_1_input").show();
    $("#slides_2_input").show();
    $("#slides_3_input").show();
    $("#slides_4_input").show();
    $("#slides_5_input").show();
    $("#slides_6_input").hide();
    $("#slide-1-Encoded").hide().attr("required", "true");
    $("#slide-2-Encoded").hide().attr("required", "true");
    $("#slide-3-Encoded").hide().attr("required", "true");
    $("#slide-4-Encoded").hide().attr("required", "true");
    $("#slide-5-Encoded").hide().attr("required", "true");
    $("#slide-6-Encoded").hide().attr('disabled', 'disabled');
}

if ($("#slides_6").is(':checked')) {
    $("#slides_1_input").show();
    $("#slides_2_input").show();
    $("#slides_3_input").show();
    $("#slides_4_input").show();
    $("#slides_5_input").show();
    $("#slides_6_input").show();
    $("#slide-1-Encoded").hide().attr("required", "true");
    $("#slide-2-Encoded").hide().attr("required", "true");
    $("#slide-3-Encoded").hide().attr("required", "true");
    $("#slide-4-Encoded").hide().attr("required", "true");
    $("#slide-5-Encoded").hide().attr("required", "true");
    $("#slide-6-Encoded").hide().attr("required", "true");
}

$('#slides_2').click(function () {
    if ($('#slides_2').is(':checked')) {
        console.log('SLIDES 2 IS CHECKED');
        $("#slide3").val("");
        $("#slide4").val("");
        $("#slide5").val("");
        $("#slide6").val("");
        $("#title_slide_3").val("");
        $("#title_slide_4").val("");
        $("#title_slide_5").val("");
        $("#title_slide_6").val("");
        $("#slide-3-Encoded").val("");
        $("#slide-4-Encoded").val("");
        $("#slide-5-Encoded").val("");
        $("#slide-6-Encoded").val("");
        $('#slide-3-img-output').attr('src', '');
        $('#slide-4-img-output').attr('src', '');
        $('#slide-5-img-output').attr('src', '');
        $('#slide-6-img-output').attr('src', '');
        $("#slides_1_input").show();
        $("#slides_2_input").show();
        $("#slides_3_input").hide();
        $("#slides_4_input").hide();
        $("#slides_5_input").hide();
        $("#slides_6_input").hide();
        $("#slide-1-Encoded").hide().attr("required", "true").removeAttr('disabled');
        $("#slide-2-Encoded").hide().attr("required", "true").removeAttr('disabled');
        $("#slide-3-Encoded").hide().attr('disabled', 'disabled').removeAttr('required');
        $("#slide-4-Encoded").hide().attr('disabled', 'disabled').removeAttr('required');
        $("#slide-5-Encoded").hide().attr('disabled', 'disabled').removeAttr('required');
        $("#slide-6-Encoded").hide().attr('disabled', 'disabled').removeAttr('required');
    }
});

$('#slides_3').click(function () {
    if ($('#slides_3').is(':checked')) {
        console.log('SLIDES 3 IS CHECKED');
        $("#slide4").val("");
        $("#slide5").val("");
        $("#slide6").val("");
        $("#title_slide_4").val("");
        $("#title_slide_5").val("");
        $("#title_slide_6").val("");
        $("#slide-4-Encoded").val("");
        $("#slide-5-Encoded").val("");
        $("#slide-6-Encoded").val("");
        $('#slide-4-img-output').attr('src', '');
        $('#slide-5-img-output').attr('src', '');
        $('#slide-6-img-output').attr('src', '');
        $("#slides_1_input").show();
        $("#slides_2_input").show();
        $("#slides_3_input").show();
        $("#slides_4_input").hide();
        $("#slides_5_input").hide();
        $("#slides_6_input").hide();
        $("#slide-1-Encoded").hide().attr("required", "true").removeAttr('disabled');
        $("#slide-2-Encoded").hide().attr("required", "true").removeAttr('disabled');
        $("#slide-3-Encoded").hide().attr("required", "true").removeAttr('disabled');
        $("#slide-4-Encoded").hide().attr('disabled', 'disabled').removeAttr('required');
        $("#slide-5-Encoded").hide().attr('disabled', 'disabled').removeAttr('required');
        $("#slide-6-Encoded").hide().attr('disabled', 'disabled').removeAttr('required');
    }
});

$('#slides_4').click(function () {
    if ($('#slides_4').is(':checked')) {
        console.log('SLIDES 4 IS CHECKED');
        $("#slide5").val("");
        $("#slide6").val("");
        $("#title_slide_5").val("");
        $("#title_slide_6").val("");
        $("#slide-5-Encoded").val("");
        $("#slide-6-Encoded").val("");
        $('#slide-5-img-output').attr('src', '');
        $('#slide-6-img-output').attr('src', '');
        $("#slides_1_input").show();
        $("#slides_2_input").show();
        $("#slides_3_input").show();
        $("#slides_4_input").show();
        $("#slides_5_input").hide();
        $("#slides_6_input").hide();
        $("#slide-1-Encoded").hide().attr("required", "true").removeAttr('disabled');
        $("#slide-2-Encoded").hide().attr("required", "true").removeAttr('disabled');
        $("#slide-3-Encoded").hide().attr("required", "true").removeAttr('disabled');
        $("#slide-4-Encoded").hide().attr("required", "true").removeAttr('disabled');
        $("#slide-5-Encoded").hide().attr('disabled', 'disabled').removeAttr('required');
        $("#slide-6-Encoded").hide().attr('disabled', 'disabled').removeAttr('required');
    }
});

$('#slides_5').click(function () {
    if ($('#slides_5').is(':checked')) {
        console.log('SLIDES 5 IS CHECKED');
        $("#slide6").val("");
        $("#title_slide_6").val("");
        $("#slide-6-Encoded").val("");
        $('#slide-6-img-output').attr('src', '');
        $("#slides_1_input").show();
        $("#slides_2_input").show();
        $("#slides_3_input").show();
        $("#slides_4_input").show();
        $("#slides_5_input").show();
        $("#slides_6_input").hide();
        $("#slide-1-Encoded").hide().attr("required", "true").removeAttr('disabled');
        $("#slide-2-Encoded").hide().attr("required", "true").removeAttr('disabled');
        $("#slide-3-Encoded").hide().attr("required", "true").removeAttr('disabled');
        $("#slide-4-Encoded").hide().attr("required", "true").removeAttr('disabled');
        $("#slide-5-Encoded").hide().attr("required", "true").removeAttr('disabled');
        $("#slide-6-Encoded").hide().attr('disabled', 'disabled').removeAttr('required');
    }
});

$('#slides_6').click(function () {
    if ($('#slides_6').is(':checked')) {
        console.log('SLIDES 6 IS CHECKED');
        $("#slides_1_input").show();
        $("#slides_2_input").show();
        $("#slides_3_input").show();
        $("#slides_4_input").show();
        $("#slides_5_input").show();
        $("#slides_6_input").show();
        $("#slide-1-Encoded").hide().attr("required", "true").removeAttr('disabled');
        $("#slide-2-Encoded").hide().attr("required", "true").removeAttr('disabled');
        $("#slide-3-Encoded").hide().attr("required", "true").removeAttr('disabled');
        $("#slide-4-Encoded").hide().attr("required", "true").removeAttr('disabled');
        $("#slide-5-Encoded").hide().attr("required", "true").removeAttr('disabled');
        $("#slide-6-Encoded").hide().attr("required", "true").removeAttr('disabled');
    }
});

// Profile Picture Crop
$('#cropImagePop').modal({
    dismissible: false,
    opacity: .85,
    in_duration: 300,
    out_duration: 200,
    onOpenEnd: function onOpenEnd() {
        $uploadCrop.croppie('bind', {
            url: imageFromInput
        }).then(function () {
            console.log('jQuery bind complete');
        });
    }
});

function readFile(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.upload-demo').addClass('ready');
            $('#cropImagePop').modal('open');
            imageFromInput = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        console.log("Sorry - you're browser doesn't support the FileReader API");
    }
}

$uploadCrop = $('#upload-demo').croppie({
    enableExif: true,
    viewport: {
        width: 200,
        height: 200,
        type: 'square'
    },
    showZoomer: true,
    enforceBoundary: true
});

$('.profile-picture-image').on('change', function () {
    imageId = $(this).data('id');
    tempFilename = $(this).val();
    readFile(this);
});

$('#cropImageButton').on('click', function (ev) {
    $uploadCrop.croppie('result', {
        type: 'base64',
        format: 'jpeg',
        size: { width: 1000, height: 1000 }
    }).then(function (resp) {
        $("#profilePictureEncoded").val(resp);
        $('#profilepicture-img-output').attr('src', resp);
        $('#cropImagePop').modal('close');
        $('#crop-thumbnail-modal').modal('close');
    });
});

// Empty input when cancel
$('.cancelCropButton').on('click', function () {
    $("#thumbnail").val('');
    $("#profile_picture").val('');
});

$('.cancelCropButtonSlide1').on('click', function () {
    $("#slide1").val('');
});

$('.cancelCropButtonSlide2').on('click', function () {
    $("#slide2").val('');
});

$('.cancelCropButtonSlide3').on('click', function () {
    $("#slide3").val('');
});

$('.cancelCropButtonSlide4').on('click', function () {
    $("#slide4").val('');
});

$('.cancelCropButtonSlide5').on('click', function () {
    $("#slide5").val('');
});

$('.cancelCropButtonSlide6').on('click', function () {
    $("#slide6").val('');
});

/***/ }),
/* 2 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })
/******/ ]);