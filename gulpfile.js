var gulp = require('gulp');
var path = require('path');
var concat = require('gulp-concat');
var sass = require('gulp-ruby-sass')
var sourcemaps = require('gulp-sourcemaps');
var rename = require('gulp-rename');
var runSequence = require('run-sequence');
var bower = require('gulp-bower');
var del = require('del');
var livereload = require('gulp-livereload');
var modernizr = require('gulp-modernizr');

var config = {
    bowerDir: './bower_components',
    npmDir: './node_modules',
    frontDir: './app/Resources/assets/front',
    adminDir: './src/Admin/BlogBundle/Resources/assets'
};

var configAdmin = {
    mailSASS: [
        config.adminDir
    ],
    globalSASS: [
        config.bowerDir + '/gentelella/src/scss',
        config.bowerDir + '/bootstrap-sass/assets/stylesheets/',
        config.bowerDir + '/font-awesome/scss/',
    ],
    globalJS:[
        config.bowerDir + '/jquery/dist/jquery.js',
        config.bowerDir + '/bootstrap-sass/assets/javascripts/bootstrap.js',
        config.bowerDir + '/datatables.net/js/jquery.dataTables.js',
        config.bowerDir + '/datatables.net-bs/js/dataTables.bootstrap.js',
        config.bowerDir + '/gentelella/src/js/helpers/smartresize.js',
        config.bowerDir + '/gentelella/src/js/custom.js'
    ],
    img: [
        config.frontDir + '/img/**/*'
    ],
    fonts: [
        config.bowerDir + '/font-awesome/fonts/**.*',
        config.bowerDir + '/bootstrap-sass/assets/fonts/bootstrap/**.js'
    ]
};

/**********************************************************************************
 * BOWER
 */

gulp.task('bower', function() {
    return bower()
        .pipe(gulp.dest(config.bowerDir))
});

/**********************************************************************************
 * CLEAN
 */

gulp.task('clean', ['clean-front', 'clean-admin']);

gulp.task('clean-front', function() {
    return del([
        './web/front/js',
        './web/front/css'
    ]);
});

gulp.task('clean-admin', function() {
    return del([
        './web/admin/js',
        './web/admin/css'
    ]);
});

/**********************************************************************************
 * FONTS
 */

gulp.task('icons', ['icons-front', 'icons-admin']);

gulp.task('icons-front', function() {
    return gulp.src(configFront.fonts)
        .pipe(gulp.dest('./web/front/fonts'));
});

gulp.task('icons-admin', function() {
    return gulp.src(configAdmin.fonts)
        .pipe(gulp.dest('./web/admin/fonts'));
});

/**********************************************************************************
 * IMAGE
 */

gulp.task('move-images', ['move-images-front', 'move-images-admin']);


gulp.task('move-images-front' ,['clean-images-front'], function(){
    return gulp.src(configFront.img)
        .pipe(gulp.dest('./web/front/img'));
});

gulp.task('clean-images-front', function(){
    return del([
        './web/front/img/*'
    ]);
});

gulp.task('move-images-admin' ,['clean-images-admin', 'move-images-media-bundle'], function(){
    return gulp.src(configAdmin.images)
        .pipe(gulp.dest('./web/admin/img'));
});

gulp.task('clean-images-admin', function(){
    return del([
        './web/admin/img/*'
    ]);
});

gulp.task('move-images-media-bundle' , function(){
    return gulp.src(configAdmin.mediaBundleImg)
        .pipe(gulp.dest('./web/admin/img/media-bundle'));
});

/**********************************************************************************
 * JS
 */

gulp.task('admin-js', ['login-js', 'admin-main-js']);

gulp.task('admin-main-js', function() {
    gulp.src(configAdmin.globalJS)
        .pipe(sourcemaps.init())
        .pipe(concat('main-admin.js'))
        .pipe(sourcemaps.write('./maps'))
        .pipe(gulp.dest('./web/admin/js'))
        .pipe(livereload());
});

gulp.task('login-js', function(){
    return gulp.src(configAdmin.loginJS)
        .pipe(concat('main-login.js'))
        .pipe(gulp.dest('./web/admin/js/'));
});

/**********************************************************************************
 * CSS
 */

gulp.task('admin-css', ['login-css', 'admin-main-css']);

gulp.task('admin-main-css', function() {
    return sass(config.adminDir + '/scss/main.scss', {
            style: 'compressed',
            sourcemap: true,
            loadPath:  configAdmin.globalSASS
        })
        .on("error", sass.logError)
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('./web/admin/css'))
        .pipe(livereload());
});


gulp.task('login-css', function(){
    return gulp.src(configAdmin.loginCSS)
        .pipe(concat('main-login.css'))
        .pipe(gulp.dest('./web/admin/css/'));
});


/**********************************************************************************
 * BUILD
 */

gulp.task('build', ['build-admin']);

gulp.task('build-admin', function(){
    runSequence('bower', [ 'icons-admin', 'admin-css', 'modernizr', 'admin-js']);
});

/**********************************************************************************
 * WATCHER
 */

gulp.task('watch-admin', ['admin-js' ], function() {
    livereload.listen();

    // gulp.watch([configFront.sassFiles ], ['front-css']);
    gulp.watch([configAdmin.globalJS], ['admin-js']);
});