const { src, dest, watch, series } = require('gulp')
const sass = require('gulp-sass')(require('sass'));

function buildStyles() {
  return src('public/styles/**/*.scss')
    .pipe(sass())
    .pipe(dest('public/css'))
}

function watchTask() {
  watch(['public/styles/**/*scss'], buildStyles);
}

exports.default = series(buildStyles, watchTask);