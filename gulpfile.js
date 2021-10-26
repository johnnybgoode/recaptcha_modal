var babel = require('gulp-babel'),
  beeper = require('beeper'),
  concat = require('gulp-concat'),
  eslint = require('gulp-eslint'),
  gulp = require('gulp'),
  notify = require('gulp-notify'),
  plumber = require('gulp-plumber'),
  sourcemaps = require('gulp-sourcemaps'),
  terser = require('gulp-terser');

// Paths
var paths = {
  scripts: {
    src: 'js/src/**/*.js',
    dist: 'js/dist',
  },
};

gulp.task('eslint', () => {
  return gulp
    .src(paths.scripts.src)
    .pipe(
      eslint({
        parser: 'babel-eslint',
        rules: {
          'no-mutable-exports': 0,
        },
        globals: ['jQuery', '$'],
        envs: ['browser'],
      })
    )
    .pipe(eslint.format());
});

gulp.task('scripts', () => {
  return gulp
    .src(paths.scripts.src)
    .pipe(
      plumber({
        errorHandler: function (err) {
          notify.onError({
            title: 'Gulp error in ' + err.plugin,
            message: err.toString(),
          })(err);
          beeper();
        },
      })
    )
    .pipe(
      babel({
        presets: ['env'],
      })
    )
    .pipe(plumber())
    .pipe(sourcemaps.init())
    .pipe(concat('app.js'))
    .pipe(sourcemaps.write('./maps'))
    .pipe(gulp.dest(paths.scripts.dist));
});

gulp.task('watch', () => {
  gulp.watch(paths.scripts.src, gulp.series('scripts', 'eslint'));
});

gulp.task('default', gulp.parallel('scripts', 'eslint'));
gulp.task(
  'build',
  gulp.series('scripts', 'eslint')
);
