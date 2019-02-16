'use strict';

var fs = require('fs');
var gulp = require('gulp');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var minify = require('gulp-minify');
var rename = require('gulp-rename');
var sourcemaps = require('gulp-sourcemaps');

var path = {
    scss: './scss/style.scss',
    css: './css',
    js_src: './scripts.js',
    js: './js/'
};

// scss
gulp.task('scss', function () {
    return gulp.src(path.scss)
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest(path.css))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(path.css));
});
gulp.task('scss-minify', function () {
    return gulp.src(path.scss)
        .pipe(sass({ outputStyle: 'compressed' }))
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest(path.css));
});

// concat
gulp.task('concat_js', function () {
    // get file index 
    var includes = JSON.parse(fs.readFileSync('./js/index.json')).includes;
    //An array of files is required for the correct order of contact
    return gulp.src(includes) //file array need for 
        .pipe(concat(path.js_src))
        .pipe(gulp.dest(path.js))
        .pipe(minify({
            ext: {
                src: '',
                min: '.min.js'
            },
            noSource: true
        }))
        .pipe(gulp.dest(path.js));
});

// watch
gulp.task('watch', function () {
    gulp.watch('./js/partials/**/*.js', gulp.series('concat_js'));
    gulp.watch('./js/index.json', gulp.series('concat_js'));
    gulp.watch('./scss/**/*.scss', gulp.series('scss', 'scss-minify'));
});

gulp.task('default', gulp.series('watch', 'concat_js', 'scss', 'scss-minify'));