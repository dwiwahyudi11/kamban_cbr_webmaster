const gulp = require('gulp');
const sass = require('gulp-sass');
const terser = require('gulp-terser');
const minifyCSS = require('gulp-csso');

// Source Path
const appSassFiles = 'public/css/app/**/*.scss';
const sassFiles = 'public/css/dashboards/**/*.scss';
const jsFiles = 'public/src/js/*.js';

// Dest Path
const cssDest = 'public/css';
const jsDest = 'public/js';


gulp.task('css', () => {
    return gulp.src([appSassFiles, sassFiles])
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest(cssDest))
});

gulp.task('minifycss', () => {
    return gulp.src([appSassFiles, sassFiles])
        .pipe(sass().on('error', sass.logError))
        .pipe(minifyCSS())
        .pipe(gulp.dest(cssDest))
});

/*gulp.task('js', () => {
    return gulp.src(jsFiles)
        .pipe(terser())
        .pipe(gulp.dest(jsDest))
});*/

// Watch task
gulp.task('default', () => {
    gulp.watch([appSassFiles, sassFiles], gulp.series('css'));
    // gulp.watch(jsFiles, gulp.series('js'));
});

gulp.task('prod', () => {
    gulp.watch([appSassFiles, sassFiles], gulp.series('minifycss'));
    // gulp.watch(jsFiles, gulp.series('js'));
});