// Alpine Js

require("alpinejs");

 import flatpickr from "flatpickr";

// Sweetalert notifications

import Swal from "sweetalert2";

const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000
});

window.Toast = Toast;

window.flatpickr = flatpickr;
