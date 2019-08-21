const styleSyntax = '+(sass|scss)';
const markupSyntax = '+(php|html)';
const baseDir = 'markup/';

const gulp = require('gulp'),
  sass = require('gulp-sass'),
  browserSync = require('browser-sync').create(),
  concat = require('gulp-concat'),
  uglify = require('gulp-uglify'),
  cleancss = require('gulp-clean-css'),
  rename = require('gulp-rename'),
  autoprefixer = require('gulp-autoprefixer'),
  babel = require('gulp-babel'),
  notify = require('gulp-notify');

gulp.task('css', function () {
  return gulp.src(baseDir + 'sass/*.' + styleSyntax + '')
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
    .pipe(gulp.dest(baseDir + 'css'))
    .pipe(browserSync.stream());
});

gulp.task('js', () => {
  return gulp.src([
    baseDir + 'libs/js/jquery-3.3.1.min.js',
    baseDir + 'libs/js/popper.min.js',
    baseDir + 'libs/js/bootstrap.min.js',
    baseDir + 'libs/js/owl.carousel.min.js',
    baseDir + 'libs/js/jquery.fancybox.min.js',
    baseDir + 'libs/js/jquery.lazy.min.js',
    baseDir + 'libs/js/jquery.lazy.plugins.min.js',
    baseDir + 'libs/js/jquery.maskedinput.min.js',
    baseDir + 'js/main.js'
    ])
    .pipe(concat('main.min.js'))
    // .pipe(babel({
    //   presets: ['@babel/preset-env']
    // }))
    // .pipe(uglify())
    .pipe(gulp.dest(baseDir + 'js'))
    .pipe(browserSync.reload({
      stream: true
    }));
});

gulp.task('browser-sync', () => {
  browserSync.init({
		server: {
			baseDir: 'markup'
		},
    notify: false
  });

  browserSync.watch('./**/*.' + markupSyntax).on('change', browserSync.reload);
});

gulp.task('watch', () => {
  gulp.watch(baseDir + 'sass/**/*.' + styleSyntax, gulp.parallel('css'));
  gulp.watch(baseDir + 'js/main.js', gulp.parallel('js'));
});

gulp.task('default', gulp.series(
  gulp.parallel('css', 'js'),
  gulp.parallel('browser-sync', 'watch')
));