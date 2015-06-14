// Karma configuration
// Generated on Thu Jan 02 2014 20:30:09 GMT+0000 (GMT)

module.exports = function (config) {
    config.set({

        // base path, that will be used to resolve files and exclude
        basePath: '',

        // frameworks to use
        frameworks: ['jasmine', 'requirejs'],

        // list of files / patterns to load in the browser
        files: [
            'app/assets/js/modules-test/vendors/sinon.js',
            'app/assets/js/modules-test/vendors/jasmine-sinon.js',
            'app/assets/js/modules-test/mockRequireJSModules.js',
            {pattern: 'app/assets/js/modules/**/*.js', included: false},
            {pattern: 'app/assets/js/modules-test/*.js', included: false},
            'app/assets/js/testMain.js'
        ],

        // Preprocesors to build files before run
        preprocessors: { 'app/assets/js/modules/**/*.js': ['coverage']},

        // test results reporter to use
        // possible values: 'dots', 'progress', 'junit', 'growl', 'coverage'
        reporters: ['progress', 'coverage'],
        coverageReporter: {
            reporters:[
                {type: 'html', dir:'test/reports/jscoverage'},
                {type: 'cobertura', dir:'test/reports/', file:'jscoverage.xml'}
            ]
        },

        // web server port
        port: 9876,

        // enable / disable colors in the output (reporters and logs)
        colors: true,

        // level of logging
        // possible values: config.LOG_DISABLE || config.LOG_ERROR || config.LOG_WARN || config.LOG_INFO || config.LOG_DEBUG
        logLevel: config.LOG_INFO,

        // enable / disable watching file and executing tests whenever any file changes
        autoWatch: true,

        // Start these browsers, currently available:
        // - Chrome
        // - ChromeCanary
        // - Firefox
        // - Opera (has to be installed with `npm install karma-opera-launcher`)
        // - Safari (only Mac; has to be installed with `npm install karma-safari-launcher`)
        // - PhantomJS
        // - IE (only Windows; has to be installed with `npm install karma-ie-launcher`)
        browsers: ['PhantomJS'],

        // If browser does not capture in given timeout [ms], kill it
        captureTimeout: 60000,

        // Continuous Integration mode
        // if true, it capture browsers, run tests and exit
        singleRun: true
    });
};
