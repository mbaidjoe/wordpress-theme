/**
 * The available tasks are:
 * - gulp (watch task with browser sync, don't forget to change the proxy)
 * - gulp build (calls the the task below including minifying and optimizing assets)
 * - gulp styles
 * - gulp scripts
 * - gulp images
 * - gulp fonts
 */

const browsersync = require('browser-sync').create();
const del         = require('del');
const fs          = require('fs');
const gulp        = require('gulp');
const notify      = require('gulp-notify');
const rev         = require('gulp-rev');
const replace     = require('gulp-replace');
const sourcemaps  = require('gulp-sourcemaps');

// plugins for styles
const cssnano = require('gulp-cssnano');
const sass    = require('gulp-sass');

// plugins for scripts
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');

// plugins for images
const imagemin = require('gulp-imagemin');

// plugins for fonts

// ---------------------------------------------------------------------------------------------------------------------
// MAIN TASKS

/**
 * Creates the browser sync.
 *
 * https://www.browsersync.io/docs/options/
 */
gulp.task('browser-sync', () => {
    browsersync.init({
        proxy:         'local.example.com',
        injectChanges: true
    });
});

/**
 * Watch task.
 */
gulp.task('default', ['styles', 'scripts', 'images', 'fonts', 'browser-sync'], () => {
    gulp.watch('resources/views/**/*.php', ['', browsersync.reload]);
    gulp.watch('resources/assets/**/*.scss', ['styles:compile', browsersync.reload]);
    gulp.watch('resources/assets/**/*.js', ['scripts:compile', browsersync.reload]);
    browsersync.reload();
});

/**
 * Build task.
 */
gulp.task('build', [
    'images',
    'fonts'
], () => {
    gulp.start('styles');
    gulp.start('scripts');
});

// ---------------------------------------------------------------------------------------------------------------------
// STYLES

/**
 * Main task.
 */
gulp.task('styles', [
    'styles:minify'
], () => {
    gulp.start('styles:replace:images');
    gulp.start('styles:replace:fonts');
});

/**
 * Compiles the stylesheets.
 */
gulp.task('styles:compile', ['styles:delete'], () =>
    gulp.src('resources/assets/styles/**/*.scss')
        .pipe(sourcemaps.init())
        .pipe(sass({
            errLogToConsole: true
        }))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest('assets/styles'))
        .pipe(notify({
            message: 'Styles compiled',
            onLast:  true
        }))
);

/**
 * Minifies and hashes the stylesheets.
 */
gulp.task('styles:minify', ['styles:compile'], () =>
    gulp.src('assets/styles/**/*.css')
        .pipe(cssnano({
            discardComments: {
                removeAll: true
            }
        }))
        .pipe(rev())
        .pipe(gulp.dest('assets/styles'))
        .pipe(rev.manifest())
        .pipe(gulp.dest('assets/styles'))
        .pipe(notify({
            message: 'Styles minified',
            onLast:  true
        }))
);

/**
 * Replaces the paths of the image url's.
 */
gulp.task('styles:replace:images', () => {
    if (!fs.existsSync('assets/images/rev-manifest.json')) {
        return;
    }

    var manifest = JSON.parse(fs.readFileSync('assets/images/rev-manifest.json', 'utf-8'));

    return gulp.src('assets/styles/*.css')
        .pipe(replace(/url\((|'|")\.\.\/img\/([a-z0-9-_]+)(\.[a-z0-9]+)(|'|")\)/g, (match, p1, p2, p3, p4) => {
            var filename       = p2 + p3;
            var filenameHashed = p2.replace(/.*(-[a-z0-9]{10})/, '') + p3;

            if (filename in manifest) {
                return match.replace(filename, manifest[filename]);
            } else if (filenameHashed in manifest) {
                return match.replace(filenameHashed, manifest[filenameHashed]);
            }

            return match;
        }))
        .pipe(gulp.dest('assets/styles'))
        .pipe(notify({
            message: 'Image url\'s replaced',
            onLast:  true
        }));
});

/**
 * Replaces the paths of the font url's.
 */
gulp.task('styles:replace:fonts', () => {
    if (!fs.existsSync('assets/fonts/rev-manifest.json')) {
        return;
    }

    var manifest = JSON.parse(fs.readFileSync('assets/fonts/rev-manifest.json', 'utf-8'));

    return gulp.src('assets/styles/*.css')
        .pipe(replace(/url\((|'|")\.\.\/fonts\/([a-z0-9-_]+)(\.[a-z0-9]+)(|'|")\)/g, (match, p1, p2, p3, p4) => {
            var filename       = p2 + p3;
            var filenameHashed = p2.replace(/.*(-[a-z0-9]{10})/, '') + p3;

            if (filename in manifest) {
                return match.replace(filename, manifest[filename]);
            } else if (filenameHashed in manifest) {
                return match.replace(filenameHashed, manifest[filenameHashed]);
            }

            return match;
        }))
        .pipe(gulp.dest('assets/styles'))
        .pipe(notify({
            message: 'Font url\'s replaced',
            onLast:  true
        }));
});

/**
 * Deletes the files in the css directory.
 */
gulp.task('styles:delete', () =>
    del('assets/styles/*')
);

// ---------------------------------------------------------------------------------------------------------------------
// SCRIPTS

/**
 * Main task.
 */
gulp.task('scripts', [
    'scripts:minify'
]);

/**
 * Deletes the files in the js directory.
 */
gulp.task('scripts:delete', () =>
    del('assets/scripts/*')
);

// BASE SCRIPT

/**
 * Main task for the base script.
 */
gulp.task('scripts:compile', ['scripts:delete'], () =>
    gulp.src([
        'resources/assets/vendor/jquery/dist/jquery.js',
        'resources/assets/scripts/base.js'
    ])
        .pipe(sourcemaps.init())
        .pipe(concat('main.js'))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest('assets/scripts'))
        .pipe(notify({
            message: 'Scripts compiled',
            onLast:  true
        }))
);

/**
 * Creates the minified and hashed version of the base script.
 */
gulp.task('scripts:minify', ['scripts:compile'], () =>
    gulp.src('assets/scripts/main.js')
        .pipe(uglify())
        .pipe(rev())
        .pipe(gulp.dest('assets/scripts'))
        .pipe(rev.manifest({
            base:  '',
            merge: true
        }))
        .pipe(gulp.dest('assets/scripts'))
        .pipe(notify({
            message: 'Scripts minified',
            onLast:  true
        }))
);

/**
 * Deletes the base files.
 */
gulp.task('scripts:delete', () =>
    del('assets/scripts/*')
);

// ---------------------------------------------------------------------------------------------------------------------
// IMAGES

/**
 * Main task.
 */
gulp.task('images', ['images:copy'], () => {
    gulp.start('styles:replace:images');
});

/**
 * Copies and optimizes the images.
 */
gulp.task('images:copy', ['images:delete'], () =>
    gulp.src('resources/assets/images/*.{gif,jpeg,jpg,png,svg}')
        .pipe(gulp.dest('assets/images'))
        .pipe(imagemin())
        .pipe(rev())
        .pipe(gulp.dest('assets/images'))
        .pipe(rev.manifest())
        .pipe(gulp.dest('assets/images'))
        .pipe(notify({
            message: 'Images copied and optimized',
            onLast:  true
        }))
);

/**
 * Deletes the files from the img directory.
 */
gulp.task('images:delete', () =>
    del('assets/images/*')
);

// ---------------------------------------------------------------------------------------------------------------------
// FONTS

/**
 * Main task.
 */
gulp.task('fonts', ['fonts:copy'], () => {
    gulp.start('styles:replace:fonts');
});

/**
 * Copies the fonts.
 */
gulp.task('fonts:copy', ['fonts:delete'], () =>
    gulp.src([
        'resources/assets/vendor/font-awesome/fonts/*.{eof,otf,svg,ttf,woff,woff2}',
        'resources/assets/fonts/*.{eof,otf,svg,ttf,woff,woff2}'
    ])
        .pipe(gulp.dest('assets/fonts'))
        .pipe(rev())
        .pipe(gulp.dest('assets/fonts'))
        .pipe(rev.manifest())
        .pipe(gulp.dest('assets/fonts'))
        .pipe(notify({
            message: 'Fonts copied',
            onLast:  true
        }))
);

/**
 * Deletes the files from the fonts directory.
 */
gulp.task('fonts:delete', () =>
    del('assets/fonts/*')
);
