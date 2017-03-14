var gulp = require('gulp');
var gutil = require('gulp-util');
var sass = require('gulp-sass');
var watch = require('gulp-watch');
var shell = require('gulp-shell');
var notify = require('gulp-notify');
var sourcemaps = require('gulp-sourcemaps');
var uglify = require('gulp-uglify');
var fs = require("fs");
var concat = require('gulp-concat');
var browserSync = require('browser-sync');
var reload = browserSync.reload;
var plumber = require('gulp-plumber');

/**
 * This task generates CSS from all SCSS files and compresses them down.
 */
gulp.task('sass', function () {
    // return gulp.src('./scss/**/*.scss')
			// .pipe(plumber(function(error) {
			// 	gutil.log(gutil.colors.red(error.message));
			// 	this.emit('end');
			// }))
    //   .pipe(sourcemaps.init())
    //     .pipe(sass({
    //         noCache: true,
    //         outputStyle: "compressed",
    //         lineNumbers: false,
    //         sourceMap: true
    //     }))
    //     .pipe(sourcemaps.write('./'))
    //     .pipe(gulp.dest('./'))
    //     .pipe(notify({
    //         title: "SASS Compiled",
    //         message: "All SASS files have been recompiled to CSS.",
    //         onLast: true
    //     }))
    //     .pipe(browserSync.stream());
		return gulp.src('./scss/*.scss')
			.pipe(sourcemaps.init())
			.pipe(sass({
			        noCache: true,
			        outputStyle: "compressed",
			        lineNumbers: false,
			        sourceMap: true
			    }))
			.pipe(sourcemaps.write('./'))
			.pipe(gulp.dest('./'))
			.pipe(browserSync.reload({stream: true}));

});


/**
 * This task minifies javascript in the js/js-src folder and places them in the js directory.
 */
gulp.task('compress', function() {
    return gulp.src('./js/js-src/*.js')
        .pipe(sourcemaps.init())
        .pipe(concat('scripts.js'))
        .pipe(uglify())
        .pipe(sourcemaps.write('./maps'))
        .pipe(gulp.dest('./js/build'))
        .pipe(notify({
            title: "JS Minified",
            message: "All JS files in the theme have been minified.",
            onLast: true
        }));
});

gulp.task('uglify', function() {
    gulp.src('./js/js-src/**/*.js')
        .pipe(uglify('vendor.js'))
        .pipe(gulp.dest('./js/vendor.js'))
        .pipe(notify({
            title: "JS Minified",
            message: "All JS files in the theme have been uglified.",
            onLast: true
        }))
});

/*
 * Browser Sync
 */

gulp.task('browser-sync', function () {
    browserSync.init({
        proxy: "https://theholistichorse.local",
        ws: true,
        notify: true
    });
    gulp.watch('./*.scss', ['sass']);
    gulp.watch('./js/**/*.js', ['compress']).on('change', browserSync.reload);
    gulp.watch('./*.php').on('change', browserSync.reload);
});

/**
 * Defines the watcher task.
 */
gulp.task('watch', function() {
    // watch scss for changes and clear drupal theme cache on change
    gulp.watch(['scss/**/*.scss'], ['sass']);

    // watch js for changes and clear drupal theme cache on change
    gulp.watch(['js-src/**/*.js'], ['compress']);

});

gulp.task('default', ['watch', 'browser-sync']);