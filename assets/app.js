import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';
// importar estilos
import './styles/app.css';

console.log('Hello World!');

//usar datables.net
import 'datatables.net-dt/css/dataTables.dataTables.css';
import DataTable from 'datatables.net-dt';

function initDataTables() {
    document.querySelectorAll('table.display').forEach(table => {
        if (!table.classList.contains('dt-initialized')) {
            const dt = new DataTable(table, {
                language: {
                    emptyTable: 'No hay datos disponibles.'
                }
            });
            table.classList.add('dt-initialized');
            // Guardar instancia para acceso posterior
            table._dt = dt;
        }
    });
}

document.addEventListener('turbo:load', initDataTables);
