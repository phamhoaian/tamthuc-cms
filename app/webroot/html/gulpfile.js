var gulp 		= require('gulp');
var sass 		= require('gulp-ruby-sass');
var sourcemaps 	= require('gulp-sourcemaps');
var prefix		= require('gulp-autoprefixer');
var minify 		= require('gulp-minify-css');
var concat 		= require('gulp-concat');
var rename 		= require('gulp-rename');
var addsrc 		= require('gulp-add-src');
var uglify 		= require('gulp-uglify');

gulp.task('public-css', function(){
	return sass('assets/scss/*.scss', { sourcemap: true, noCache: true })
		.on('error', function(err){ console.log(err.message); })
		.pipe(prefix({
			browsers: ['last 2 versions'],
			remove: false
		}))
		.pipe(minify())
		.pipe(sourcemaps.write('.', {
			includeContent: true,
		}))
		.pipe(gulp.dest('webroot/css'))
});

gulp.task('public-js', function(){
	return gulp.src('assets/js/jquery.min.js')
		.pipe(addsrc.append(['assets/js/*.js', '!assets/js/jquery.min.js']))
    	.pipe(sourcemaps.init())
        .pipe(concat('public.js'))
        .pipe(sourcemaps.write('.', {
			includeContent: true,
		}))
        .pipe(gulp.dest('webroot/js'));
});

gulp.task('watch', function(){
	gulp.watch('assets/scss/*.scss', ['public-css']);
	gulp.watch('assets/js/*.js', ['public-js']);
});