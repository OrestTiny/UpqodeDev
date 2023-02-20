const gulp = require("gulp"),
  strip = require("gulp-strip-comments"),
  babel = require("gulp-babel"),
  sass = require("gulp-sass")(require("sass")),
  autoprefixer = require("gulp-autoprefixer"),
  size = require("gulp-size"),
  notify = require("gulp-notify"),
  uglify = require("gulp-uglify"), // minify file
  rename = require("gulp-rename"),
  cleanCSS = require("gulp-clean-css"), // remove all comments
  plumber = require("gulp-plumber"), // intercepts errors
  postCSS = require("gulp-postcss"),
  mqpacker = require("css-mqpacker"),
  sortCSSmq = require("sort-css-media-queries"),
  debug = require("gulp-debug");

const path = {
  scss: {
    src: [
      "./upqode/assets/scss/*.scss",
      "./upqode/assets/scss/{header,footer}/*.scss",
    ],
    dest: "./upqode/assets/css",
  },
  scss_inner: {
    src: [
      "./upqode/assets/scss/**/*.scss",
      "!./upqode/assets/scss/*.scss",
      "!./upqode/assets/scss/{header,footer}/*.scss",
      "!./upqode/assets/scss/**/_*.scss",
      "./upqode/assets/scss/blog/*.scss",
    ],
    dest: "./upqode/assets/css",
  },
  js: {
    src: [
      "./upqode/assets/js/**/*.js",
      "!./upqode/assets/js/**/*.min.js",
      "!./upqode/assets/js/lib{,/**}/*.js",
    ],
    dest: "./upqode/assets/js",
  },
};

const options = {
  mqpacker: { sort: sortCSSmq.desktopFirst },
  size: { title: "Size" },
  rename: { suffix: ".min" },
  cleanCss: { level: { 1: { specialComments: 0 } }, compatibility: "ie8" },
  autoprefixer: ["last 2 version", "> 2%", "ie 6"],
  debug: { title: "Focus:" },
  babel: { presets: ["@babel/env"] },
  sass: { outputStyle: "compressed", includePaths: ["node_modules"] },
  onError: function (err) {
    this.emit("end");
    return notify().write(err);
  },
};

gulp.task("scripts", function () {
  return gulp
    .src(path.js.src)
    .pipe(debug(options.debug))
    .pipe(babel(options.babel))
    .pipe(uglify())
    .pipe(rename(options.rename))
    .pipe(strip())
    .pipe(gulp.dest(path.js.dest))
    .pipe(size(options.size));
});

gulp.task("sass", function () {
  return gulp
    .src(path.scss.src)
    .pipe(debug(options.debug))
    .pipe(plumber())
    .pipe(sass(options.sass).on("error", options.onError))
    .pipe(postCSS([mqpacker(options.mqpacker)]))
    .pipe(cleanCSS(options.cleanCss))
    .pipe(autoprefixer(options.autoprefixer))
    .pipe(rename(options.rename))
    .pipe(gulp.dest(path.scss.dest))
    .pipe(size(options.size));
});

gulp.task("sass-inner", function () {
  return gulp
    .src(path.scss_inner.src)
    .pipe(debug(options.debug))
    .pipe(plumber())
    .pipe(sass(options.sass).on("error", options.onError))
    .pipe(postCSS([mqpacker(options.mqpacker)]))
    .pipe(cleanCSS(options.cleanCss))
    .pipe(autoprefixer(options.autoprefixer))
    .pipe(rename(options.rename))
    .pipe(gulp.dest(path.scss_inner.dest))
    .pipe(size(options.size));
});

gulp.task("watch", async () => {
  gulp.watch(path.scss.src, gulp.series("sass"));
  gulp.watch(path.scss_inner.src, gulp.series("sass-inner"));
  gulp.watch(path.js.src, gulp.series("scripts"));
});

gulp.task("default", gulp.series("watch"));
