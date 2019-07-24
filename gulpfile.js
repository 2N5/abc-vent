const syntax = 'sass';

const gulp = require('gulp'),
  sass = require('gulp-sass'),
  browserSync = require('browser-sync').create(),
  concat = require('gulp-concat'),
  uglify = require('gulp-uglify'),
  cleancss = require('gulp-clean-css'),
  rename = require('gulp-rename'),
  autoprefixer = require('gulp-autoprefixer'),
  notify = require('gulp-notify'),
  tinypng = require('gulp-tinypng'),
  tinypngKey = 'MDX5GCYr3s0F2sH9clnqg23HGMvD8JXp';

gulp.task('css', function () {
  return gulp.src('./assets/' + syntax + '/**/*.' + syntax + '')
    .pipe(sass({
      outputStyle: 'expanded'
    }).on('error', notify.onError()))
    .pipe(rename({
      suffix: '.min',
      prefix: ''
    }))
    .pipe(autoprefixer(['last 15 versions']))
    .pipe(cleancss({
      level: {
        1: {
          specialComments: 0
        }
      }
    }))
    .pipe(gulp.dest('./assets/css'))
    .pipe(browserSync.stream());
});

gulp.task('js', function () {
  return gulp.src([
      './assets/libs/js/jquery-3.3.1.min.js',
      './assets/libs/js/popper.min.js',
      './assets/libs/js/bootstrap.min.js',
      './assets/libs/js/owl.carousel.min.js',
      './assets/libs/js/jquery.fancybox.min.js',
      './assets/libs/js/jquery.lazy.min.js',
      './assets/libs/js/jquery.lazy.plugins.min.js',
      './assets/libs/js/jquery.maskedinput.min.js',
      './assets/js/main.js'
    ])
    .pipe(concat('main.min.js'))
    // .pipe(uglify())
    .pipe(gulp.dest('./assets/js'))
    .pipe(browserSync.reload({
      stream: true
    }));
});

gulp.task('img', function () {
  return gulp.src('./assets/img/**/*.+(png|jpg|jpeg|gif)')
    .pipe(tinypng(tinypngKey))
    .pipe(gulp.dest('./assets/img'))
});

gulp.task('browser-sync', function () {
  browserSync.init({
    proxy: 'abc.vent',
    notify: false
  });

  browserSync.watch('./**/*.+(php|html)').on('change', browserSync.reload);
});

gulp.task('watch', function () {
  gulp.watch('./assets/sass/*.sass', gulp.parallel('css'));
  gulp.watch('./assets/js/main.js', gulp.parallel('js'));
});

gulp.task('default', gulp.series(
  gulp.parallel('css', 'js'),
  gulp.parallel('browser-sync', 'watch')
));