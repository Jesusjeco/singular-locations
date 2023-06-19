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

function compileBlocksJs(cb) {
    cb();
    return src('src/js/blocks/**/*.js')
        .pipe(babel())
        //.pipe(concat('singularlocations-slider.js'))
        .pipe(dest('blocks/'));
}

function compileBlocksCss(cb) {
    cb();
    return src('src/scss/blocks/**/*.scss')
        .pipe(sass())
        .pipe(autoprefixer())
        .pipe(cleanCSS())
        .pipe(dest('blocks/'));
}

function compileSwipperJS(cb) {
    //cb();
    return src(['node_modules/swiper/swiper-bundle.min.js'])
        .pipe(babel())
        .pipe(concat('swiper.js'))
        .pipe(dest('assets/js/'));
}

function compileSwiperCss(cb) {
    //cb();
    return src('node_modules/swiper/swiper-bundle.min.css')
        .pipe(sass())
        .pipe(dest('assets/css/'));
}

function compileImages(cb) {
    cb();
    return src('src/images/*')
        .pipe(imagemin())
        .pipe(dest('assets/images/'));
}

//exports.build = build;
exports.default = series(compileCss, compileBlocksCss, compileSwipperJS, compileSwiperCss, compileBlocksJs, compileImages);

exports.watcher = function () {
    watch(['src/scss/*.scss', 'src/scss/**/*.scss', 'src/scss/template-parts/**/*.scss'], compileCss);
    watch(['src/scss/*.scss', 'src/scss/**/*.scss', 'src/scss/template-parts/**/*.scss'], compileBlocksCss);
};