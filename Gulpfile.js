'use strict';

var gulp = require('gulp');
var stylus = require('gulp-stylus');
var browserSync = require('browser-sync');
var reload = browserSync.reload;

gulp.task('stylus:dev', function() {
  return gulp.src([ 'stylus/main.styl' ])
    .pipe(stylus())
    .pipe(gulp.dest('./'))
});

gulp.task('serve:dev', function() {
  browserSync.init({
    proxy: 'localhost/wordpress'
  })
});

gulp.task('watch', function() {
  gulp.watch([ 'stylus/**/*.styl' ], [ 'stylus:dev', reload ]);
  gulp.watch([ './**/*.php', './views/**/*.twig' ], [ reload ]);
});

gulp.task('build:dev', [ 'stylus:dev', 'serve:dev', 'watch' ]);

gulp.task('default', [ 'build:dev' ]);
