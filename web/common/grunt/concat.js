module.exports = {
    // JS FILES
    loginjs: {
        src: [
            '../../vendor/bower/angular/angular.js',
        ],
        dest: '../../web/theme/js/tareas-login.js'
    },
    appjs: {
        src: [
            '../../vendor/bower/jquery/dist/jquery.min.js',
            '../../vendor/bower/datatables.net/js/jquery.dataTables.min.js',
            '../../vendor/bower/angular/angular.js',
            '../../vendor/bower/angular-animate/angular-animate.js',
            '../../vendor/bower/angular-aria/angular-aria.js',
            '../../vendor/bower/angular-messages/angular-messages.min.js',
            '../../vendor/bower/angular-material/angular-material.min.js',
            '../../vendor/bower/AngularJS-Toaster/toaster.js',
            '../../vendor/bower/angular-datatables/demo/src/archives/dist/angular-datatables.min.js',
            '../../vendor/bower/angular_count_to/dist/angular-filter-count-to.min.js',
            '../../vendor/bower/chart.js/dist/Chart.js',
            '../../vendor/bower/angular-chart.js/dist/angular-chart.js',
            '../../vendor/bower/pdfmake/build/pdfmake.min.js',
            '../../vendor/bower/pdfmake/build/vfs_fonts.js',
            '../../web/fount/menu/js/bootstrap3.3.1.js',
            '../../web/fount/menu/js/customMn.js',
            '../../web/fount/menu/js/joinable.js',
            '../../web/fount/menu/js/Resizeable.js',
            '../../web/fount/menu/js/TweenMax.js',
            '../../web/fount/menu/js/xenonMail.js',
       
            '../../web/fount/collections.js',
        ],
        dest: '../../web/theme/js/tareas-app.js'
    },
    // CSS FILES
    logincss: {
        src: [
        ],
        dest: '../../web/theme/css/tareas-login.css'
    },
    appcss: {
        src: [
            '../../vendor/bower/bootstrap/dist/css/bootstrap.css',
            '../../vendor/bower/datatables.net-dt/css/jquery.dataTables.css',
            '../../vendor/bower/angular-material/angular-material.css',
            '../../vendor/bower/AngularJS-Toaster/toaster.css',
            '../../web/fount/menu/css/xenon-core.css',
            '../../vendor/bower/angular-datatables/demo/src/archives/dist/css/angular-datatables.css',
//            '../../vendor/bower/angular-material-data-table/dist/md-data-table.min.css',
            '../../web/fount/collections.css',
            
        ],
        dest: '../../web/theme/css/tareas-app.css'
    }
};