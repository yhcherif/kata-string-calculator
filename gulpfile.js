var gulp = require("gulp"),
	notify = require("gulp-notify"),
	phpspec = require("gulp-phpspec"),
	_ = require("lodash");


gulp.task("phpspec", function(){
	gulp
		.src(["spec/**/*.php"])
		.pipe(phpspec("./vendor/bin/phpspec run --verbose -fpretty", {notify: true}))

		.on("error", notify.onError((testNotification('fail', 'phpspec'))))
	    .pipe(notify(testNotification('pass', 'phpspec')))
	});



function testNotification(status, pluginName, override) {
	var options = {
		title:   ( status == 'pass' ) ? 'Well done' : 'Crap',
		message: ( status == 'pass' ) ? '\n\nAll tests have passed, Youssouf!\n\n' : '\n\nOne or more tests failed...\n\n',
		icon:    __dirname + '/node_modules/gulp-' + pluginName +'/assets/test-' + status + '.png'
	};
	options = _.merge(options, override);
  return options;
}


gulp.task("default", function(){
	gulp.watch(["spec/**/*.php", "src/**/*.php"], ['phpspec']);
});