const gulp = require('gulp');
const del = require('del');
const rev = require('gulp-rev');
const sass = require('gulp-sass');
const nano = require('gulp-cssnano');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const minify = require('gulp-imagemin');

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

// ---------------------------------------------------------------------------------------------------------------------
// STYLES

gulp.task('styles:delete', () => del('assets/styles'));

gulp.task('styles:develop', ['styles:delete'], () => gulp.src('resources/assets/styles/**/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('assets/styles'))
);

gulp.task('styles:production', ['styles:delete'], () => gulp.src('assets/styles/**/*.css')
    .pipe(sass().on('error', sass.logError))
    .pipe(nano())
    .pipe(rev())
    .pipe(gulp.dest('assets/styles'))
    .pipe(rev.manifest())
    .pipe(gulp.dest('assets/styles'))
);

// ---------------------------------------------------------------------------------------------------------------------
// IMAGES

gulp.task('images:delete', () => del('assets/images'));

gulp.task('images:develop', ['images:delete'], () => gulp.src('resources/assets/images/*')
    .pipe(gulp.dest('assets/images'))
);

gulp.task('images:production', ['images:delete'], () => gulp.src('resources/assets/images/*')
    .pipe(rev())
    .pipe(minify())
    .pipe(gulp.dest('assets/images'))
    .pipe(rev.manifest())
    .pipe(gulp.dest('assets/images'))
);

// ---------------------------------------------------------------------------------------------------------------------
// FONTS

gulp.task('fonts:delete', () => del('assets/fonts'));

gulp.task('fonts:develop', ['fonts:delete'], () => gulp.src('node_modules/font-awesome/fonts/*.{eot,otf,svg,ttf,woff,woff2}')
    .pipe(gulp.dest('assets/fonts'))
);

gulp.task('fonts:production', ['fonts:delete'], () => gulp.src('node_modules/font-awesome/fonts/*.{eot,otf,svg,ttf,woff,woff2}')
    .pipe(rev())
    .pipe(gulp.dest('assets/fonts'))
    .pipe(rev.manifest())
    .pipe(gulp.dest('assets/fonts'))
);

// ---------------------------------------------------------------------------------------------------------------------
// SCRIPTS

gulp.task('scripts:delete', () => del('assets/scripts'));

gulp.task('scripts:develop', ['scripts:delete'], () => gulp.src([
    'node_modules/jquery/dist/jquery.min.js',
    'node_modules/popper.js/dist/umd/popper.min.js',
    'node_modules/bootstrap/dist/js/bootstrap.min.js',
    'resources/assets/scripts/main.js',
])
    .pipe(concat('main.js'))
    .pipe(gulp.dest('assets/scripts'))
);

gulp.task('scripts:production', ['scripts:delete'], () => gulp.src([
    'node_modules/jquery/dist/jquery.min.js',
    'node_modules/popper.js/dist/umd/popper.min.js',
    'node_modules/bootstrap/dist/js/bootstrap.min.js',
    'resources/assets/scripts/main.js',
])
    .pipe(concat('main.js'))
    .pipe(uglify())
    .pipe(rev())
    .pipe(gulp.dest('assets/scripts'))
    .pipe(rev.manifest())
    .pipe(gulp.dest('assets/scripts'))
);
