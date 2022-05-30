const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js');
//******************* CSS ***********************

mix.copy([
    'resources/vendors/quill/css/quill.css',
    'node_modules/cropperjs/dist/cropper.css',
    'node_modules/@coreui/icons/css/flag.min.css',
    'node_modules/@coreui/icons/css/brand.min.css',
    'node_modules/@coreui/icons/css/free.min.css'
], 'public/css');

mix.sass('resources/sass/style.scss', 'public/css');

//**************** END: CSS ********************

//******************* SCRIPTS ***********************
mix.copy('resources/vendors/quill/js', 'public/js/vendors/quill');
mix.copy('resources/vendors/popper.min.js', 'public/js/vendors/');
mix.copy('node_modules/jquery/dist/jquery.min.js', 'public/js/vendors/');
mix.copy('node_modules/bootstrap/dist/js/bootstrap.min.js', 'public/js/vendors/');

mix.js('resources/js/modal.js',         'public/js/src/modal.js')
    .js('resources/js/quill.js',        'public/js/src/quill.js')
    .js('resources/js/table-row.js',    'public/js/src/table-row.js')
    .js('resources/js/map-show.js',     'public/js/src/map-show.js')
    .js('resources/js/map-form.js',     'public/js/src/map-form.js')
    .js('resources/js/upload-image.js', 'public/js/src/upload-image.js')
    .js('resources/js/sortable.js',     'public/js/src/sortable.js')
    .js('resources/js/menu-edit.js',    'public/js/src/menu-edit.js')
    .js('resources/js/menu-create.js',  'public/js/src/menu-create.js')
    .js('resources/js/menu.js',         'public/js/src/menu.js')

mix.js([
    'resources/vendors/sidebar/sidebar.js',
    'resources/vendors/sidebar/class-toggler.js',
    'resources/vendors/sidebar/dom/data.js',
    'resources/vendors/sidebar/dom/event-handler.js',
    'resources/vendors/sidebar/dom/manipulator.js',
    'resources/vendors/sidebar/util/index.js',
],'public/js/vendors/sidebar/sidebar.js')
//**************** END: SCRIPTS ********************

//******************* OTHER ***********************
mix.copy('node_modules/@coreui/icons/fonts', 'public/fonts');           // fonts
mix.copy('node_modules/@coreui/icons/svg/flag', 'public/svg/flag');     // icons
mix.copy('node_modules/@coreui/icons/sprites/', 'public/icons/sprites');

mix.copy('resources/assets', 'public/assets'); // images
// mix.copy('resources/images', 'public/images'); // images
//**************** END: OTHER ********************