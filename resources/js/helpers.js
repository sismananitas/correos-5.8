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