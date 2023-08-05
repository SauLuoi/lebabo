var gulp          = require('gulp');
var sass          = require('gulp-sass')(require('sass'));
var cssnano       = require('gulp-cssnano');
var sourcemaps    = require('gulp-sourcemaps');
var jshint        = require('gulp-jshint');
var uglify        = require('gulp-uglify');
var concat        = require('gulp-concat');
var bust          = require('gulp-buster');
var imagemin      = require('gulp-imagemin');
var cache         = require('gulp-cache');
var del           = require('del');
var runSequence   = require('gulp4-run-sequence');
var watch         = require('gulp-chokidar')(gulp);
gulp.task('css', function () {
    return gulp.src([
        'assets/scss/index.scss',
        // 'assets/css/scss/**/*.scss',
    ])
        .pipe(sourcemaps.init())    //phải đứng đầu tiên
        .pipe(sass().on('error', sass.logError))
        .pipe(concat('main.css'))
        .pipe(cssnano())
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('dist/css/'))
});

//js
gulp.task('js', function(){
    return gulp.src([
        'assets/js/main.js',
    ])
        .pipe(jshint())
        .pipe(jshint.reporter('default'))
        .pipe(concat('main.js'))
        .pipe(uglify())
        .pipe(gulp.dest('dist/js/'))
});

// image
gulp.task('images', function(){
    return gulp.src([
        'assets/images/**/*.+(png|jpg|jpeg|gif|svg)',
        // 'bower_components/slick-carousel/slick/ajax-loader.gif',
    ])
        .pipe(cache(imagemin({
            interlaced: true
        })))
        .pipe(gulp.dest('dist/images'))
});