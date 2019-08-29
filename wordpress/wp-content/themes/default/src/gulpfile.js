'use strict';

///////////////////////////////////////////
// DEPENDENCIES                          //
///////////////////////////////////////////

// Main
const gulp         = require('gulp');
const format       = require('@o2team/gulp-prettier-eslint');

// Utils
const plumber      = require('gulp-plumber');
const rename       = require('gulp-rename');
const browserSync  = require('browser-sync');

// Styles
const sass         = require('gulp-sass');
const sassLint     = require('gulp-sass-lint');
// const sourcemaps   = require('gulp-sourcemaps');
const gcmq         = require('gulp-group-css-media-queries');
const cssnano      = require('gulp-cssnano');

// Scripts
const concat       = require('gulp-concat');
const uglify       = require('gulp-uglify');

// Assets
const imagemin     = require('gulp-imagemin');
const svgmin       = require('gulp-svgmin');
const svgstore     = require('gulp-svgstore');

const reload       = browserSync.reload;



///////////////////////////////////////////
// CONFIGURATION                         //
///////////////////////////////////////////

const paths = {
  styles  : '../assets/styles',
  scripts : '../assets/scripts',
  images  : '../assets/images',
  icons   : '../assets/images/icons',
  svg     : '../assets/svg'
};

const HOST = 'http://localhost:8080/';


///////////////////////////////////////////
// STYLES                                //
///////////////////////////////////////////

gulp.task('styles', () => {
  const options = {
    'errLogToConsole': true,
    'outputStyle': 'expanded'
  };

  return gulp
    .src(`${paths.styles}/**/*.{sass,scss}`)
    .pipe(plumber())
    .pipe(sass(options).on('error', sass.logError))
    // .pipe(sourcemaps.init())
    .pipe(gcmq())
    // .pipe(cssnano())
    // .pipe(sourcemaps.write('./'))
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest(paths.styles))
    // .pipe(reload({ stream: true }))
});


gulp.task('sasslint', () => {
  return gulp
    .src(`${paths.styles}/**/*.scss`)
    .pipe(sassLint())    
    .pipe(sassLint.format())
    .pipe(sassLint.failOnError())
});

///////////////////////////////////////////
// SCRIPTS                               //
///////////////////////////////////////////

gulp.task('scripts', () => {
  return gulp
    .src(`${paths.scripts}/main.js`)
    .pipe(plumber())
    // .pipe(sourcemaps.init())
    // .pipe(babel())
    .pipe(concat('main.js'))
    // .pipe(uglify())
    // .pipe(sourcemaps.write('.'))
    .pipe(rename({ suffix: '.min' }))
    .pipe(gulp.dest(paths.scripts))
    // .pipe(reload({ stream: true }));
});

gulp.task('vendors', () => {
  return gulp
    .src(`${paths.scripts}/vendors/*.js`)
    .pipe(plumber())
    .pipe(concat('vendors.js'))
    // .pipe(uglify())
    .pipe(rename({ suffix: '.min' }))
    .pipe(gulp.dest(`${paths.scripts}/vendors/`))
    // .pipe(reload({ stream: true }));
});


///////////////////////////////////////////
// ASSETS                                //
///////////////////////////////////////////

gulp.task('images', () => {
  return gulp
    .src(paths.images)
    .pipe(plumber())
    .pipe(imagemin({
      optimizationLevel: 3,
      progressive: true,
      interlaced: true
    }))
    .pipe(gulp.dest(paths.images))
    // .pipe(reload({ stream: true }));
});

gulp.task('svg', () => {
  gulp.src(paths.svg)
    .pipe(svgmin())
    .pipe(gulp.dest(paths.svg))
    .pipe(reload({ stream: true }));
  gulp.src(paths.svg)
    .pipe(svgmin())
    .pipe(gulp.dest(paths.svg))
    // .pipe(reload({ stream: true }));
});

gulp.task('icons', () => {
  gulp.src(paths.icons)
    .pipe(plumber())
    .pipe(svgmin())
    .pipe(svgstore({ fileName: 'icons.svg', inlineSvg: true }))
    .pipe(gulp.dest(paths.svg))
    // .pipe(reload({ stream: true }));
});


///////////////////////////////////////////
// WATCH AND SYNC                        //
///////////////////////////////////////////

const syncFiles = {
  'scripts' : ['../assets/scripts/main.js'],
  'styles'  : ['../assets/styles/**/*.{sass,scss}'],
  'images'  : ['../assets/images/*.{png,jpg}'],
  'icons'   : ['../assets/images/icons/*'],
  'views'   : ['../**/*.php']
};

// Watch for changes
// Gulp Watch Error in Linunx: https://github.com/gulpjs/gulp/issues/217
gulp.task('watch', () => {
  gulp.watch(syncFiles.views,     { debounceDelay: 300 });
  gulp.watch(syncFiles.styles,    ['styles']);
  gulp.watch(syncFiles.sassLint,  ['sasslint'])
  gulp.watch(syncFiles.scripts,   ['scripts']);
  gulp.watch(syncFiles.images,    ['images']);
  gulp.watch(syncFiles.icons,     ['icons']);
});

// Prettier / ESLint
gulp.task('prettier-eslint', () => {
  return gulp.src('*.js')
    .pipe(format({ 
      eslintConfig: {
        parserOptions: {
          ecmaVersion: 6
        },
        rules: {
          semi: ["error", "never"]
        }
      },
      prettierOptions: {
        printWidth: 80,
        tabWidth: 2,
        singleQuote: true,
        trailingComma: 'none',
        bracketSpacing: true,
        semi: true,
        useTabs: false,
      },
      fallbackPrettierOptions: {
        singleQuote: false
      }
     }))
    .pipe(gulp.dest('./dist'));
});

// Start server and Sync files.
gulp.task('sync', () => {
  browserSync.init(syncFiles, {
    proxy  : HOST,
    open   : true,
    notify : true
  });
});


///////////////////////////////////////////
// CUSTOM TASKS                          //
///////////////////////////////////////////

// Default Task
gulp.task('default', ['build', 'watch']);

// Images
gulp.task('assets', ['images']);

// Build
gulp.task('build', ['scripts', 'styles']);
// gulp.task('build', ['scripts', 'vendors', 'styles']);
