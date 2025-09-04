import { Controller } from "@hotwired/stimulus";
import axios from "axios";

export default class extends Controller {
    static values = {
        id: Number,
        url: String
    }

    // JavaScript
    delete(event) {
        event.preventDefault();
        if (confirm("¿Estás seguro de que quieres eliminar este dato?")) {
            axios.post(this.urlValue, {})
                .then(response => {
                    if (response.data.success) {
                        const row = event.target.closest("tr");
                        const table = row.closest('table');
                        // Usar la instancia guardada en el DOM
                        table._dt.row(row).remove().draw();
                    } else {
                        alert('No se pudo eliminar');
                    }
                })
                .catch(() => {
                    alert('Error en la petición AJAX');
                });
        }
    }

    mensaje(event) {
        event.preventDefault();
        alert("Hola, este es un mensaje desde el controlador Stimulus.");
    }
}