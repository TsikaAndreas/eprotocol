require('./bootstrap');
require('alpinejs');

/**
 * We load all the required packages for the DataTables.
 */
// required for excel button extension
window.JSZip = require( 'jszip' );
// required for pdf export extension
window.pdfMake = require('pdfmake/build/pdfmake.min');
window.pdfFonts = require('pdfmake/build/vfs_fonts');
window.pdfMake.vfs = pdfFonts.pdfMake.vfs;
// datatables
require( 'datatables.net-dt/js/dataTables.dataTables.min' );
require( 'datatables.net-responsive-dt/js/responsive.dataTables.min' );
require( 'datatables.net-buttons/js/dataTables.buttons.min' );
require( 'datatables.net-buttons/js/buttons.html5.min' );
require( 'datatables.net-buttons/js/buttons.colVis.min' );
require( 'datatables.net-buttons/js/buttons.print.min' );

