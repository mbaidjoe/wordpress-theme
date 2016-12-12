/**
 * Gulpfile. Change the settings according to your wishes.
 *
 * Main tasks:
 * - build:develop (sourcemapped, but no minifying or rev'ing)
 * - build:production (no sourcemapping, but minified and rev'ed)
 * - watch (calls the styles and scripts develop tasks)
 *
 * Todo:
 * - Add base script task (jQuery, Bootstrap)
 * - Add task to replace image paths in stylesheets
 * - Add font optimization function
 */

const cssnano    = require('gulp-cssnano');
const del        = require('del');
const imagemin   = require('gulp-imagemin');
const gulp       = require('gulp');
const rev        = require('gulp-rev');
const sass       = require('gulp-sass');
const sourcemaps = require('gulp-sourcemaps');
const uglify     = require('gulp-uglify');

// ---------------------------------------------------------------------------------------------------------------------
// SETTINGS

let pathToResources = 'resources/assets';
let pathToPublic    = 'assets';

// ---------------------------------------------------------------------------------------------------------------------
// MAIN TASKS

gulp.task('build:develop', [
    'styles:develop',
    'scripts:develop',
    'images:develop',
    'fonts:develop',
]);

gulp.task('build:production', [
    'styles:production',
    'scripts:production',
    'images:production',
    'fonts:production',
]);

gulp.task('watch', () => {
    gulp.watch(pathToResources + '/styles/**/*.scss', ['styles:develop']);
    gulp.watch(pathToResources + '/scripts/**/*.js', ['scripts:develop']);
});

// ---------------------------------------------------------------------------------------------------------------------
// STYLES

gulp.task('styles:delete', () => del(pathToPublic + '/styles/*'));

gulp.task('styles:develop', ['styles:delete'], () => gulp.src(pathToResources + '/styles/**/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest(pathToPublic + '/styles'))
);

gulp.task('styles:production', ['styles:delete'], () => gulp.src(pathToResources + '/styles/**/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(cssnano({
        discardComments: {
            removeAll: true
        }
    }))
    .pipe(rev())
    .pipe(gulp.dest(pathToPublic + '/styles'))
    .pipe(rev.manifest({
        base: '',
        merge: true
    }))
    .pipe(gulp.dest(pathToPublic + '/styles'))
);

// ---------------------------------------------------------------------------------------------------------------------
// SCRIPTS

gulp.task('scripts:delete', () => del(pathToPublic + '/scripts/*'));

gulp.task('scripts:develop', ['scripts:delete'], () => gulp.src(pathToResources + '/scripts/**/*.js')
    .pipe(gulp.dest(pathToPublic + '/scripts'))
);

gulp.task('scripts:production', ['scripts:delete'], () => gulp.src(pathToResources + '/scripts/**/*.js')
    .pipe(uglify())
    .pipe(rev())
    .pipe(gulp.dest(pathToPublic + '/scripts'))
    .pipe(rev.manifest({
        base: '',
        merge: true
    }))
    .pipe(gulp.dest(pathToPublic + '/scripts'))
);

// ---------------------------------------------------------------------------------------------------------------------
// IMAGES

gulp.task('images:delete', () => del(pathToPublic + '/images/*'));

gulp.task('images:develop', ['images:delete'], () => gulp.src(pathToResources + '/images/**/*.{gif,jpeg,jpg,png}')
    .pipe(gulp.dest(pathToPublic + '/images'))
);

gulp.task('images:production', ['images:delete'], () => gulp.src(pathToResources + '/images/**/*.{gif,jpeg,jpg,png}')
    .pipe(imagemin())
    .pipe(rev())
    .pipe(gulp.dest(pathToPublic + '/images'))
    .pipe(rev.manifest({
        base: '',
        merge: true
    }))
    .pipe(gulp.dest(pathToPublic + '/images'))
);

// ---------------------------------------------------------------------------------------------------------------------
// FONTS

gulp.task('fonts:delete', () => del(pathToPublic + '/fonts/*'));

gulp.task('fonts:develop', ['fonts:delete'], () => gulp.src(pathToResources + '/fonts/**/*.{eot,otf,svg,ttf,woff,woff2}')
    .pipe(gulp.dest(pathToPublic + '/fonts'))
);

gulp.task('fonts:production', ['fonts:delete'], () => gulp.src(pathToResources + '/fonts/**/*.{eot,otf,svg,ttf,woff,woff2}')
    .pipe(rev())
    .pipe(gulp.dest(pathToPublic + '/fonts'))
    .pipe(rev.manifest({
        base: '',
        merge: true
    }))
    .pipe(gulp.dest(pathToPublic + '/fonts'))
);
