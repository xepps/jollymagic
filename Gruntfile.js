module.exports = function(grunt) {

    var shelljs = require('shelljs');

    grunt.loadNpmTasks('grunt-composer');
    grunt.loadNpmTasks('grunt-contrib-compass');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-karma');
    grunt.loadNpmTasks('grunt-contrib-requirejs');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-phpcs');
    grunt.loadNpmTasks('grunt-phpunit');

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        compass: {
            dist: {
                options: {
                    config: 'app/assets/scss/compass_config.rb',
                    outputStyle: 'compressed',
                    bundleExec: true
                }
            },
            dev: {
                options: {
                    config: 'app/assets/scss/compass_config.rb',
                    bundleExec: true
                }
            }
        },
        composer: {
            options: {
                composerLocation: './composer.phar'
            }
        },
        copy: {
            jsVendor: {
                expand: true,
                cwd: "app/assets/js/",
                src: "vendors/*",
                dest: "static/js/"
            },
            images: {
                expand: true,
                cwd: "app/assets/images/",
                src: "*",
                dest: "static/images/"
            },
            requireJS: {
                expand: true,
                cwd: "node_modules/requirejs/",
                src: "require.js",
                dest: "static/js/"
            },
            content: {
                expand: true,
                cwd: "app/assets/content/",
                src: "*",
                dest: "static/content/"
            },
            release: {
                expand: true,
                src: ["app/lib/**", "static/**", "vendor/**", ".htaccess", "package.json", "composer.json"],
                dest: "release/"
            }
        },
        clean: {
            staticContent: {
                src: ["static/content"]
            },
            staticCss: {
                src: ["static/css"]
            },
            staticImages: {
                src: ["static/images"]
            },
            staticJs: {
                src: ["static/js"]
            },
            releaseFiles: {
                src: ["release"]
            }
        },
        jshint: {
            all: ['app/assets/js/modules/**/*.js']
        },
        karma: {
            unit: {
                options: {
                    configFile: 'karma.conf.js'
                }
            }
        },
        phpcs: {
            application: {
                dir: ['app']
            },
            options: {
                bin: 'vendor/bin/phpcs',
                standard: 'PSR2',
                ignore: ['views/*.php', 'app/assets']
            }
        },
        phpunit: {
            classes: {
                dir: 'app/tests'
            },
            options: {
                configuration: 'app/tests/phpunit.xml',
                colors: true,
                bin: 'php -dapc.enable_cli=1 vendor/phpunit/phpunit/composer/bin/phpunit'
            }
        },
        requirejs: {
            compile: {
                options: {
                    baseUrl: "app/assets/js/modules",
                    paths: {},
                    keepBuildDir: true,
                    name: "jollymagic/controller",
                    out: "static/js/controller.js"
                }
            },
            "compile-dev": {
                options: {
                    baseUrl: "app/assets/js/modules",
                    paths: {},
                    keepBuildDir: true,
                    name: "jollymagic/controller",
                    out: "static/js/controller.js",
                    optimize: "none"
                }
            }
        },
        watch: {
            css: {
                options: {
                    livereload: true
                },
                files: ['app/assets/scss/**/*.scss'],
                tasks: ['clean:staticCss', 'clean:staticImages', 'compass:dev', 'copy:images']
            },
            js: {
                files: ['app/assets/js/modules/**/*.js', 'app/assets/js/modules-test/*.js'],
                tasks: ['requirejs:compile-dev', 'karma:unit', 'jshint']
            },
            jsVendor: {
                files: ['app/assets/js/vendors/*.js'],
                tasks: ['clean:staticJs', 'copy:jsVendor']
            },
            images: {
                files: ['app/assets/images/*'],
                tasks: ['clean:staticImages', 'copy:images']
            },
            content: {
                files: ['app/assets/content/*'],
                tasks: ['clean:staticContent', 'copy:content']
            }
        }
    });

    grunt.registerTask("bundle", 'Do bundle install', function () {
        // This task will try to use the local caches first
        // If that fails, it will just run bundle normally
        if (shelljs.exec('bundle --local --path=vendor/bundle').code !== 0) {
            return shelljs.exec('bundle --path=vendor/bundle').code === 0;
        } else {
            return true;
        }
    });

    grunt.registerTask(
        'default',
        [
            'install-deps',
            'build-assets-dist',
            'run-tests'
        ]
    );

    grunt.registerTask(
        'dev',
        [
            'install-deps',
            'build-assets-dev',
            'watch'
        ]
    );

    grunt.registerTask(
        'install-deps',
        [
            'composer:install',
            'bundle',
            'copy:requireJS'
        ]
    );

    grunt.registerTask(
        'build-assets-dev',
        [
            'requirejs:compile-dev',
            'copy:jsVendor',
            'copy:images',
            'copy:content',
            'compass:dev'
        ]
    );

    grunt.registerTask(
        'build-assets-dist',
        [
            'requirejs:compile',
            'copy:jsVendor',
            'copy:images',
            'copy:content',
            'compass:dist'
        ]
    );

    grunt.registerTask(
        'run-tests',
        [
            'install-deps',
            'phpunit',
            'phpcs',
            'karma:unit',
            'jshint'
        ]
    );

    grunt.registerTask(
        'release',
        [
            'clean:releaseFiles',
            'copy:release'
        ]
    );

};