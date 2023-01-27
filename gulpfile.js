const gulp = require("gulp"),
  strip = require("gulp-strip-comments"),
  babel = require("gulp-babel"),
  // sourcemaps = require("gulp-sourcemaps"),
  sass = require("gulp-sass")(require("sass")),
  autoprefixer = require("gulp-autoprefixer"),
  size = require("gulp-size"),
  notify = require("gulp-notify"),
  uglify = require("gulp-uglify"), // minify file
  rename = require("gulp-rename"),
  cleanCSS = require("gulp-clean-css"), // remove all comments
  plumber = require("gulp-plumber"),
  postCSS = require("gulp-postcss"),
  mqpacker = require("css-mqpacker"),
  sortCSSmq = require("sort-css-media-queries"),
  debug = require("gulp-debug");

const path = {
  scss: ["./upqode/assets/css/*.scss"],
  scss_inner: ["./upqode/assets/css/**/*.scss", "!./upqode/assets/css/*.scss"],
  js: ["./upqode/assets/js/**/*.js", "!./upqode/assets/js/**/*.min.js"],
};

gulp.task("scripts", function () {
  return gulp
    .src(path.js)
    .pipe(
      babel({
        presets: ["@babel/env"],
      })
    )
    .pipe(uglify())
    .pipe(rename({ suffix: ".min" }))
    .pipe(strip())
    .pipe(gulp.dest("./upqode/assets/js"))
    .pipe(size());
});

gulp.task("sass", function () {
  return gulp
    .src(path.scss)
    .pipe(plumber())
    .pipe(
      sass({
        outputStyle: "compressed",
        includePaths: ["node_modules"],
      }).on("error", function (err) {
        this.emit("end");
        return notify().write(err);
      })
    )
    .pipe(
      postCSS([
        mqpacker({
          sort: sortCSSmq.desktopFirst,
        }),
      ])
    )
    .pipe(
      cleanCSS({ level: { 1: { specialComments: 0 } }, compatibility: "ie8" })
    )
    .pipe(autoprefixer("last 2 version", "> 2%", "ie 6", "ie 5"))
    .pipe(rename({ suffix: ".min" }))
    .pipe(gulp.dest("./upqode/assets/css"))
    .pipe(debug({ title: "Quantity:", showFiles: false }))
    .pipe(size({ title: "Size", showFiles: true }));
});

gulp.task("sass-inner", function () {
  return gulp
    .src(path.scss_inner)
    .pipe(plumber())
    .pipe(
      sass({
        outputStyle: "compressed",
        includePaths: ["node_modules"],
      }).on("error", function (err) {
        this.emit("end");
        return notify().write(err);
      })
    )
    .pipe(
      postCSS([
        mqpacker({
          sort: sortCSSmq.desktopFirst,
        }),
      ])
    )
    .pipe(
      cleanCSS({ level: { 1: { specialComments: 0 } }, compatibility: "ie8" })
    )
    .pipe(autoprefixer("last 2 version", "> 2%", "ie 6", "ie 5"))
    .pipe(rename({ suffix: ".min" }))
    .pipe(gulp.dest("./upqode/assets/css"))
    .pipe(debug({ title: "Quantity:", showFiles: false }))
    .pipe(size({ title: "Size", showFiles: true }));
});

gulp.task("watch", function () {
  gulp.watch(path.scss, gulp.series("sass"));
  gulp.watch(path.scss_inner, gulp.series("sass-inner"));
  gulp.watch(path.js, gulp.series("scripts"));
});

gulp.task("default", gulp.series("watch"));
