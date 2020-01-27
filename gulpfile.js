"use strict";
const gulp          = require('gulp');
const sass          = require('gulp-sass');
const concat        = require('gulp-concat');
const multipipe     = require('multipipe');
const autopref      = require('gulp-autoprefixer');
const notify        = require('gulp-notify');
const remember      = require('gulp-remember');
const del           = require('del');
const bs            = require('browser-sync').create();
const php           = require('gulp-connect-php7');
const paths         = { php: './*.php' };

/*==== server ====*/
gulp.task('server', function() {
    let files = [
        '**/*.php',
        '**/*.{png,jpg,gif}'
    ];
    return php.server({}, function(){
        bs.init(files,{
            proxy: 'http://localhost/francedance.wp',
            keepalive: true
        });
    });
    // Serve files from the root of this project

    bs.watch('./*.php').on('change', bs.reload);
});

/*=== sass ===*/
gulp.task('sass', function(){
    return multipipe(
        gulp.src('sass/style.scss', {since: gulp.lastRun('sass')}),
        autopref(),
        remember('sass'),
        sass().on('error', sass.logError),
        concat('style.css'),
        gulp.dest('./'),
        bs.stream()
    ).on('error', notify.onError())
});
/*==== delete ====*/
gulp.task('del', function(){
    return del('style.css');
});
/*==== watch ====*/
gulp.task('watch', function(){
    gulp.watch('sass/**/*.scss', gulp.series('sass'));
    // gulp.watch('js/**/*.js', gulp.series('js'));
    gulp.watch(paths.php).on('change', bs.reload);

});
/*==== build ====*/
gulp.task('build', gulp.series('del', gulp.parallel('sass')));

/*==== DEV ====*/
gulp.task('default', gulp.series('build', gulp.parallel('watch', 'server')));