var gulp = require('gulp')
var path = require('path')
var concat = require('gulp-concat')
var sass = require('gulp-ruby-sass')
var less = require('gulp-less')
var sourcemaps = require('gulp-sourcemaps')
var del = require('del')
var livereload = require('gulp-livereload')

var config = {
    bowerDir: './bower_components',
    npmDir: './node_modules',
    frontDir: './src/AppBundle/Resources/assets',
    adminDir: './src/Admin/BlogBundle/Resources/assets'
}

var configFront = {
    globalLESS: [
        config.bowerDir + '/font-awesome/less/font-awesome.less',
        config.bowerDir + '/bootstrap/less/bootstrap.less',
        config.frontDir + '/less/clean-blog.less'
    ],
    globalJS: [
        config.bowerDir + '/jquery/dist/jquery.js',
        config.bowerDir + '/bootstrap-sass/assets/javascripts/bootstrap.js',
        config.frontDir + '/js/clean-blog.js'
    ],
    img: [
        config.frontDir + '/img/**/*'
    ],
    fonts: [
        config.bowerDir + '/font-awesome/fonts/**.*',
        config.bowerDir + '/bootstrap-sass/assets/fonts/bootstrap/**.js'
    ]
}

var configAdmin = {
    mailSASS: [
        config.adminDir
    ],
    globalSASS: [
        config.bowerDir + '/gentelella/src/scss',
        config.bowerDir + '/bootstrap-sass/assets/stylesheets/',
        config.bowerDir + '/font-awesome/scss/',
    ],
    globalJS: [
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
}

/**********************************************************************************
 * CLEAN
 */

gulp.task('clean', ['clean-front', 'clean-admin'])

gulp.task('clean-front', function () {
    return del([
        './web/front/js',
        './web/front/css',
        './web/front/img',
        './web/front/fonts'
    ])
})

gulp.task('clean-admin', function () {
    return del([
        './web/admin/js',
        './web/admin/css',
        './web/admin/img',
        './web/admin/fonts'
    ])
})

/**********************************************************************************
 * FONTS
 */

gulp.task('icons', ['front-icons', 'admin-icons'])

gulp.task('front-icons', function () {
    return gulp.src(configFront.fonts)
        .pipe(gulp.dest('./web/front/fonts'))
})

gulp.task('admin-icons', function () {
    return gulp.src(configAdmin.fonts)
        .pipe(gulp.dest('./web/admin/fonts'))
})

/**********************************************************************************
 * IMAGE
 */

gulp.task('images', ['front-images', 'images-admin'])

gulp.task('front-images', ['clean-images-front'], function () {
    return gulp.src(configFront.img)
        .pipe(gulp.dest('./web/front/img'))
})

gulp.task('clean-images-front', function () {
    return del([
        './web/front/img/*'
    ])
})

gulp.task('admin-images', ['clean-images-admin', 'move-images-media-bundle'], function () {
    return gulp.src(configAdmin.images)
        .pipe(gulp.dest('./web/admin/img'))
})

gulp.task('clean-images-admin', function () {
    return del([
        './web/admin/img/*'
    ])
})

/**********************************************************************************
 * JS
 */

gulp.task('front-js', function () {
    gulp.src(configFront.globalJS)
        .pipe(sourcemaps.init())
        .pipe(concat('main-front.js'))
        .pipe(sourcemaps.write('./maps'))
        .pipe(gulp.dest('./web/front/js'))
        .pipe(livereload())
})

gulp.task('admin-js', function () {
    gulp.src(configAdmin.globalJS)
        .pipe(sourcemaps.init())
        .pipe(concat('main-admin.js'))
        .pipe(sourcemaps.write('./maps'))
        .pipe(gulp.dest('./web/admin/js'))
        .pipe(livereload())
})

/**********************************************************************************
 * CSS
 */

gulp.task('less', function () {

});

gulp.task('front-css', function () {
    return gulp.src(configFront.globalLESS)
        .pipe(sourcemaps.init())
        .pipe(less())
        .pipe(concat('main.css'))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('./web/front/css'))
        .pipe(livereload())
})

gulp.task('admin-css', function () {
    return sass(config.adminDir + '/scss/main.scss', {
        style: 'compressed',
        sourcemap: true,
        loadPath: configAdmin.globalSASS
    })
        .on('error', sass.logError)
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('./web/admin/css'))
        .pipe(livereload())
})

/**********************************************************************************
 * BUILD
 */

gulp.task('build', ['build-admin', 'build-front'])

gulp.task('build-admin', ['admin-icons', 'admin-css', 'admin-js'])

gulp.task('build-front', ['front-icons', 'front-images', 'front-css', 'front-js'])

/**********************************************************************************
 * WATCHER
 */

gulp.task('watch', ['front-js', 'front-css', 'admin-js', 'admin-css'], function () {
    livereload.listen()

    gulp.watch([configFront.globalLESS], ['front-css'])
    gulp.watch([configFront.globalJS], ['front-js'])
    gulp.watch([configAdmin.globalSASS], ['admin-css'])
    gulp.watch([configAdmin.globalJS], ['admin-js'])
})