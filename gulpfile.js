const gulp = require('gulp');
const concat = require('gulp-concat');
const gzip = require('gulp-gzip');
const uglify_es = require('gulp-uglify-es').default;
const clean_css = require('gulp-clean-css');

function concatGulpCss () {
    return gulp.src([
        'resources/css/bootstrap/bootstrap.css',
        'resources/css/bootstrap/bootstrap-grid.css',
        'resources/css/app.css'
    ])
        .pipe(concat('app.css'))
        //.pipe(clean_css())
        //.pipe(gulp.dest("public/css"))
        //.pipe(gzip())
        .pipe(gulp.dest("public/css"));
};

function concatGulpJs () {
    return gulp.src([
        'resources/js/bootstrap/bootstrap.js',
        'resources/js/app.js'
    ])
        .pipe(concat('app.js'))
        //.pipe(uglify_es())
        //.pipe(gulp.dest("public/js"))
        //.pipe(gzip())
        .pipe(gulp.dest("public/js"));
};

function concatGulpJsAdmin () {
    return gulp.src([
        'resources/js/jquery_v2.2.4.js',
        'resources/js/jquery.dataTables_v1.10.12.min.js',
        'resources/js/admin_index_list.js',
        'resources/js/script_admin_company.js'
    ])
        .pipe(concat('admin_app.js'))
        //.pipe(uglify_es())
        //.pipe(gulp.dest("public/js"))
        //.pipe(gzip())
        .pipe(gulp.dest("public/js"));
};



exports.concatcss = concatGulpCss;
exports.concatjs = concatGulpJs;
exports.concatadminjs = concatGulpJsAdmin;
