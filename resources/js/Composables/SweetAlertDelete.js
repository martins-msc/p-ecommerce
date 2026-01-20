import Swal from 'sweetalert2'
// Puedo crear mas funciones y usarlas import { confirmDelete, successAlert } from '@/Utils/SweetAlert'; // Importas la
export const confirmDelete = (title, onConfirm) => {
    Swal.fire({
        title: title || "Estas seguro?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Eliminar",
        denyButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            onConfirm(); // Ejecutamos la acción (ej. el borrado en Inertia)
        }
    });
}