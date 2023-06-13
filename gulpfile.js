const { src, dest, series, watch } = require('gulp');
const autoprefixer = require('gulp-autoprefixer');
const sass = require('gulp-sass')(require('sass'));
const babel = require('gulp-babel');
const cleanCSS = require('gulp-clean-css');
var concat = require('gulp-concat');
const imagemin = require('gulp-imagemin');

function compileCss(cb) {
    cb();
    return src('src/scss/*.scss')
        .pipe(sass())
        .pipe(autoprefixer())
        .pipe(cleanCSS())
        .pipe(dest('assets/css/'));
}

function compilePartsCss(cb) {
    cb();
    return src('src/scss/blocks/**/*.scss')
        .pipe(sass())
        .pipe(autoprefixer())
        .pipe(cleanCSS())
        .pipe(dest('blocks/'));
}

//exports.build = build;
exports.default = series(compileCss, compilePartsCss);

exports.watcher = function () {
    watch(['src/scss/*.scss', 'src/scss/**/*.scss', 'src/scss/template-parts/**/*.scss'], compileCss);
    watch(['src/scss/*.scss', 'src/scss/**/*.scss', 'src/scss/template-parts/**/*.scss'], compilePartsCss);
};