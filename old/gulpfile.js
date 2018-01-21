const gulp = require('gulp');
const browserSync = require ('browser-sync').create();
const sass = require('gulp-sass');
const useref = require('gulp-useref');  
const gulpIf = require('gulp-if'); 
const uglify = require('gulp-uglify'); 
const cssnano = require('gulp-cssnano');
const imagemin = require('gulp-imagemin'); 
const cache = require('gulp-cache'); 
const del = require('del'); 
const runSequence = require('run-sequence'); 
const postcss = require('gulp-postcss');
const autoprefixer = require('gulp-autoprefixer'); 

//Compile Sass & Inject Into Browser
gulp.task('sass', function(){
	return gulp.src(['node_modules/bootstrap/scss/bootstrap.scss', 'src/scss/*.scss'])
	.pipe(sass())
	//tell it where to compile our scss files
	.pipe(gulp.dest("src/css"))
	.pipe(browserSync.stream());
});

//Move JS Files to src/js

gulp.task('js', function(){
	return gulp.src(['node_modules/bootstrap/dist/js/bootstrap.min.js', 'node_modules/jquery/dist/jquery.min.js', 'node_modules/popper.js/dist/umd/popper.min.js'])
	.pipe(gulp.dest("src/js"))
	.pipe(browserSync.stream()); 
}); 

//Watch Sass & Server

gulp.task('serve', ['sass'], function(){
	browserSync.init({
			server: "./src"
	});

	gulp.watch(['node_modules/bootstrap/scss/bootstrap.scss', 'src/scss/*.scss'], ['sass'])
	gulp.watch("src/*.html").on('change', browserSync.reload);
});


//POSTCSS & Plugins 

var autoprefixerOptions = {
  browsers: ['last 2 versions', '> 5%', 'Firefox ESR']
};

gulp.task('styles', function () {
	return gulp.src('src/styles.css')
		.pipe(
		 	postcss([
				require('postcss-font-magician')({ foundries: 'bootstrap google'})

		 ]))
		 .pipe(autoprefixer(autoprefixerOptions))
		 .pipe(gulp.dest('dist')
	);
});



// Move Fonts Folder to src/fonts
gulp.task('fonts', function(){
	return gulp.src('node_modules/font-awesome/fonts/*')
	.pipe(gulp.dest('src/fonts')); 
}); 

// Move Font Awesome CSS to src/css to src
gulp.task('fa', function(){
	return gulp.src('node_modules/font-awesome/css/font-awesome.min.css')
	.pipe(gulp.dest('src/css')); 
}); 

gulp.task('fonts', function() {
	return gulp.src('src/fonts/**/*')
	.pipe(gulp.dest('dist/fonts'))
})

//CONCATENATING AND MINIFYING JS AND CSSS
//Setting up useref task
gulp.task('useref', function(){
  return gulp.src('src/*.html')
		.pipe(useref())
		//gulpif makes sure we only minify js or css files each 
		.pipe(gulpIf('*.js', uglify()))
		.pipe(gulpIf('*.css', cssnano()))
    .pipe(gulp.dest('dist'))
});

//IMAGES
gulp.task('images', function(){
  return gulp.src('src/images/**/*.+(png|jpg|gif|svg|jpeg)')
  .pipe(cache(imagemin({
		//settings interlaced to true
		interlaced: true
	})))
  .pipe(gulp.dest('dist/images'))
});

//Cleaning
gulp.task('clean', function() {
  return del.sync('dist').then(function(cb) {
    return cache.clearAll(cb);
  });
})

gulp.task('clean:dist', function() {
  return del.sync(['dist/**/*', '!dist/images', '!dist/images/**/*']);
});


//Build Sequences 
gulp.task('default', function (callback) {
  runSequence(['serve','fa', 'js', 'styles'],
    callback
  )
});

gulp.task('build', function(callback) {
	runSequence('clean:dist', 
		['fonts', 'useref', 'images'], 
		callback
	)
});

