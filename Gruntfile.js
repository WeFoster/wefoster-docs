'use strict';
module.exports = function(grunt) {

  grunt.initConfig({
    jshint: {
      options: {
        jshintrc: '.jshintrc'
      },
      all: [
        'Gruntfile.js',
        'assets/js/*.js',
        '!assets/js/scripts.min.js'
      ]
    },
    less: {
      dist: {
        files: {
          'assets/css/main.min.css': [
            'assets/less/app.less'
          ]
        },
        options: {
          compress: true,
          // LESS source map
          // To enable, set sourceMap to true and update sourceMapRootpath based on your install
          sourceMap: true,
          sourceMapFilename: 'assets/css/main.min.css.map',
          sourceMapRootpath: '/wp-content/themes/wefoster-docs/'
        }
      }
    },
    uglify: {
      dist: {
        files: {
          'assets/js/scripts.min.js': [
            'assets/js/_*.js',
            '!assets/js/scripts.min.js'
          ]
        },
        options: {
          //JS source map: to enable, uncomment the lines below and update sourceMappingURL based on your install
          // sourceMap: 'assets/js/scripts.min.js.map',
          // sourceMappingURL: '/app/themes/wefoster-child/assets/js/scripts.min.js.map'
        }
      }
    },
    version: {
      options: {
        file: 'child-lib/scripts.php',
        css: 'assets/css/main.min.css',
        cssHandle: 'wef_main',
        js: 'assets/js/scripts.min.js',
        jsHandle: 'wef_scripts'
      }
    },
    watch: {
      less: {
        files: [
          //Watch for changes in parent
          '../wefoster-framework/assets/less/*.less',
          '../wefoster-framework/assets/less/plugins/*.less',
          '../wefoster-framework/assets/less/vendor/*.less',
          '../wefoster-framework/assets/less/bootstrap/*.less',
          '../wefoster-framework/assets/less/layout/*.less',
          '../wefoster-framework/assets/less/wordpress/*.less',
          '../wefoster-framework/assets/less/buddypress/*',
          '../wefoster-framework/assets/less/buddypress/plugins/*',
          // Watch for changes inside the child
          'assets/less/*.less',
          'assets/less/plugins/*.less',
          'assets/less/bootstrap/*.less',
          'assets/less/buddypress/*',
          'assets/less/buddypress/plugins/*'
        ],
        tasks: ['less']
      },
      js: {
        files: [
          '<%= jshint.all %>'
        ],
        tasks: ['uglify']
      },
      livereload: {
        // Browser live reloading
        // https://github.com/gruntjs/grunt-contrib-watch#live-reloading
        options: {
          livereload: true
        },
        files: [
          'assets/css/main.min.css',
          'assets/js/scripts.min.js',
          'templates/*.php',
          '*.php'
        ]
      }
    },
    clean: {
      dist: [
        'assets/css/main.min.css',
        'assets/js/scripts.min.js'
      ]
    }
  });


  // Load tasks
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-wp-version');
  grunt.loadNpmTasks('grunt-pot');

  // Register tasks
  grunt.registerTask('default', [
    'clean',
    'less',
    'uglify',
    'version'
  ]);
  grunt.registerTask('dev', [
    'watch'
  ]);

};