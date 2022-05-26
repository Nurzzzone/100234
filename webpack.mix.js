const mix = require('laravel-mix');

//******************* CSS ***********************
mix.sass('resources/sass/style.scss', 'public/css'); //main css

mix.copy([
    'resources/vendors/quill/css/quill.css',
    'node_modules/cropperjs/dist/cropper.css',
    'node_modules/@coreui/icons/css/flag.min.css',
    'node_modules/@coreui/icons/css/brand.min.css',
    'node_modules/@coreui/icons/css/free.min.css'
], 'public/css');
//**************** END: CSS ********************

//******************* SCRIPTS ***********************
mix.copy('resources/vendors/quill/js', 'public/js/vendors/quill');
mix.copy('resources/vendors/jquery/jquery.min.js', 'public/js/vendors/jquery');

mix.minify([
    'resources/js/modal.js',
    'resources/js/quill.js',
    'resources/js/table-row.js',
    'resources/js/map-show.js',
    'resources/js/map-form.js',
    'resources/js/upload-image.js',
    'resources/js/sortable.js',
    'resources/js/menu-edit.js',
    'resources/js/menu-create.js',
    'resources/js/menu.js'
]);

mix.copy([
    'resources/js/modal.min.js',
    'resources/js/quill.min.js',
    'resources/js/table-row.min.js',
    'resources/js/map-show.min.js',
    'resources/js/map-form.min.js',
    'resources/js/upload-image.min.js',
    'resources/js/sortable.min.js',
    'resources/js/menu-edit.min.js',
    'resources/js/menu-create.min.js',
    'resources/js/menu.min.js',
    'node_modules/@coreui/coreui/dist/js/coreui.bundle.min.js'
], 'public/js');
//**************** END: SCRIPTS ********************

//******************* OTHER ***********************
mix.copy('node_modules/@coreui/icons/fonts', 'public/fonts');           // fonts
mix.copy('node_modules/@coreui/icons/svg/flag', 'public/svg/flag');     // icons
mix.copy('node_modules/@coreui/icons/sprites/', 'public/icons/sprites');

mix.copy('resources/assets', 'public/assets'); // images
// mix.copy('resources/images', 'public/images'); // images
//**************** END: OTHER ********************