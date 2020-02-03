import Swal from "sweetalert2"

let w = window

w.showLoading = () => {
    Swal.fire({
        html: `<div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>`,
        toast: true,
        showConfirmButton: false
    })
}

w.closeLoading = () => Swal.close()

w.showCompleted = (message, status = 'success') => {
    return Swal.fire({
        toast: true,
        type: status,
        position: 'top-right',
        title: message,
        timer: 2000,
        showConfirmButton: false
    })
}