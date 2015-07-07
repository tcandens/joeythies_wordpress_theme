'use strict';

var gulp = require('gulp');
var autoprefixer = require('autoprefixer-core');
var postcss = require('gulp-postcss');
var sourcemaps = require('gulp-sourcemaps');
var stylus = require('gulp-stylus');
var browserSync = require('browser-sync').create();
var reload = browserSync.reload;

gulp.task('stylus:dev', function() {
  return gulp.src([ 'stylus/main.styl' ])
    .pipe(sourcemaps.init())
    .pipe(stylus())
    .pipe(postcss([ autoprefixer({ browsers: ['last 2 versions'] }) ]))
    .pipe(sourcemaps.write('.'))
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
