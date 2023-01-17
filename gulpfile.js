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

gulp.task("scripts", function () {
  return (
    gulp
      .src(["./cda/assets/js/**/*.js", "!./cda/assets/js/**/*.min.js"])
      // .pipe(sourcemaps.init())
      .pipe(
        babel({
          presets: ["@babel/env"],
        })
      )
      .pipe(uglify())
      .pipe(rename({ suffix: ".min" }))
      // .pipe(sourcemaps.write("."))
      .pipe(strip())
      .pipe(gulp.dest("./cda/assets/js"))
      .pipe(size())
  );
});

gulp.task("widgets-scripts", function () {
  return (
    gulp
      .src(["./cda/widgets/**/*.js", "!./cda/widgets/**/*.min.js"])
      // .pipe(sourcemaps.init())
      .pipe(
        babel({
          presets: ["@babel/env"],
        })
      )
      .pipe(uglify())
      .pipe(rename({ suffix: ".min" }))
      // .pipe(sourcemaps.write("."))
      .pipe(strip())
      .pipe(gulp.dest("./cda/widgets/"))
      .pipe(size())
  );
});

gulp.task("sass", function () {
  return (
    gulp
      .src(["./cda/assets/css/**/*.scss"])
      .pipe(debug())
      // .pipe(sourcemaps.init({ largeFile: true }))
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
        autoprefixer({
          browserslistrc: ["> 1%', 'last 3 versions"],
          cascade: true,
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
      // .pipe(sourcemaps.write("."))
      .pipe(gulp.dest("./cda/assets/css"))
      .pipe(size())
  );
});

gulp.task("sass-widget", function () {
  return (
    gulp
      .src("./cda/widgets/**/*.scss")
      // .pipe(sourcemaps.init({ largeFile: true }))
      .pipe(plumber())
      .pipe(
        sass({
          outputStyle: "expanded",
          includePaths: ["node_modules"],
        }).on("error", function (err) {
          this.emit("end");
          return notify().write(err);
        })
      )
      .pipe(
        autoprefixer({
          browserslistrc: ["> 1%', 'last 3 versions"],
          cascade: true,
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
      // .pipe(sourcemaps.write("."))
      .pipe(gulp.dest("./cda/widgets"))
      .pipe(size())
  );
});

//watcher
gulp.task("watch", function () {
  gulp.watch(
    ["./cda/assets/css/*.scss", "./cda/assets/css/**/*.scss"],
    gulp.series("sass")
  );
  gulp.watch("./cda/widgets/**/*.scss", gulp.series("sass-widget"));
  gulp.watch(
    ["./cda/widgets/**/*.js", "!./cda/widgets/**/*.min.js"],
    gulp.series("widgets-scripts")
  );
  gulp.watch(
    ["./cda/assets/js/*.js", "!./cda/assets/js/**/*.min.js"],
    gulp.series("scripts")
  );
});

gulp.task("default", gulp.series("watch"));
