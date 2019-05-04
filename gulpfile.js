var gulp 		= require('gulp');
var sass 		= require('gulp-ruby-sass');
var sourcemaps 	= require('gulp-sourcemaps');
var prefix		= require('gulp-autoprefixer');
var minify 		= require('gulp-minify-css');
// var livereload	= require('gulp-livereload');

gulp.task('sass', function(){
	return sass('app/webroot/scss/*.scss', { sourcemap: true, noCache: true })
		.on('error', function(err){ console.log(err.message); })
		.pipe(prefix({
			browsers: ['last 2 versions'],
			remove: false
		}))
		// .pipe(minify())
		.pipe(sourcemaps.write('.', {
			includeContent: false,
		}))
		.pipe(gulp.dest('app/webroot/css'))
		// .pipe(livereload());
});

gulp.task('watch', function(){
	// livereload.listen({
	// 	host: 'realboost.dev'
	// });
	gulp.watch('app/webroot/scss/*.scss', ['sass']);
});