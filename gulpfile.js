'use strict';

const gulp = require('gulp');
const sass = require('gulp-sass');
const debug = require('gulp-debug');
const cleanCSS = require('gulp-clean-css');
const babelify = require('babelify');
const browserify = require('browserify');
const buffer = require('vinyl-buffer');
const source = require('vinyl-source-stream');
const rename = require('gulp-rename');
const uglify = require('gulp-uglify');

const paths = {
    sass: './resources/assets/sass/**/*.scss',
    css: './public/styles',
    foundation: {
        scss: './node_modules/foundation-sites/scss/',
        motionUi: './node_modules/motion-ui/src'
    },
    js: {
        src: './js/main.js',
        outputDir: './public/gulp-build',
        mapDir: './maps/',
        outputFile: 'bundle.js'
    }
};

gulp.task('default', ['sass', 'bundle', 'watch']);

gulp.task('build', ['sass', 'bundle']);

gulp.task('sass', () => {
    const sassTask = sass({
        includePaths: [paths.foundation.scss, paths.foundation.motionUi]
    }).on('error', sass.logError);

    return gulp
        .src(paths.sass)
        .pipe(debug({title: 'file'}))
        .pipe(sassTask)
        .pipe(cleanCSS({compatibility: 'ie8'}))
        .pipe(gulp.dest(paths.css));
});

gulp.task('bundle', () => {
    var bundler = browserify(paths.js.src)
        .transform(babelify);

    bundle(bundler);
});

gulp.task('watch', () => {
    gulp.watch(paths.sass, ['sass']);
    gulp.watch('./js/**/*.js', ['bundle']);
});

function bundle (bundler) {
    bundler
        .bundle()
        .pipe(source(paths.js.src))
        .pipe(buffer())
        .pipe(rename(paths.js.outputFile))
        .pipe(gulp.dest(paths.js.outputDir));
}