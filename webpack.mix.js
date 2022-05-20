const mix = require('laravel-mix');

//mix.js('resources/js/app.js', 'public/js')
//mix.sass('resources/sass/app.scss', 'public/css');

//******************* CSS ***********************
//css
//mix.copy('resources/vendors/pace-progress/css/pace.min.css', 'public/css');
mix.copy('node_modules/@coreui/chartjs/dist/css/coreui-chartjs.css', 'public/css');
mix.copy('node_modules/cropperjs/dist/cropper.css', 'public/css');
mix.sass('resources/sass/style.scss', 'public/css'); //main css
mix.copy('resources/vendors/quill/css/quill.css', 'public/css');
//**************** END: CSS ********************

//******************* SCRIPTS ***********************

mix.copy('node_modules/axios/dist/axios.min.js', 'public/js');  // general scripts
//mix.copy('node_modules/pace-progress/pace.min.js', 'public/js');
mix.copy('node_modules/chart.js/dist/Chart.min.js', 'public/js'); // views scripts
mix.copy('node_modules/cropperjs/dist/cropper.js', 'public/js'); // views scripts

mix.copy('resources/js/modal.js', 'public/js');
mix.copy('resources/js/quill.js', 'public/js');
mix.copy('resources/js/table-row.js', 'public/js');
mix.copy('resources/js/upload-image.js', 'public/js');
mix.copy('resources/js/map-show.js', 'public/js');
mix.copy('resources/js/map-form.js', 'public/js');

mix.copy('resources/vendors/quill/js', 'public/js/vendors/quill');
mix.copy('resources/vendors/jquery/jquery.min.js', 'public/js/vendors/jquery');
mix.copy('resources/vendors/jquery-sortable-lists/jquery-sortable-lists.min.js', 'public/js');
mix.js('resources/js/menu.js', 'public/js');
mix.js('resources/js/menu-create.js', 'public/js');
mix.js('resources/js/menu-edit.js', 'public/js');
//**************** END: SCRIPTS ********************

//******************* OTHER ***********************
mix.copy('node_modules/@coreui/icons/fonts', 'public/fonts');           // fonts
mix.copy('node_modules/@coreui/icons/css/free.min.css', 'public/css');  // icons
mix.copy('node_modules/@coreui/icons/css/brand.min.css', 'public/css'); // icons
mix.copy('node_modules/@coreui/icons/css/flag.min.css', 'public/css');  // icons
mix.copy('node_modules/@coreui/icons/svg/flag', 'public/svg/flag');     // icons
mix.copy('node_modules/@coreui/icons/sprites/', 'public/icons/sprites');
mix.copy('node_modules/@coreui/utils/dist/coreui-utils.js', 'public/js'); // general scripts
mix.copy('node_modules/@coreui/coreui/dist/js/coreui.bundle.min.js', 'public/js');
mix.copy('node_modules/@coreui/chartjs/dist/js/coreui-chartjs.bundle.js', 'public/js'); // views scripts

mix.copy('resources/assets', 'public/assets'); // images
// mix.copy('resources/images', 'public/images'); // images
//**************** END: OTHER ********************