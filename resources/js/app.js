import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();
import { DataTable } from "simple-datatables";
document.addEventListener("DOMContentLoaded", function () {
    const categoryTable = document.querySelector("#sortable-table");
    if (categoryTable) {
        new DataTable("#sortable-table", {
            sortable: true,
            caseFirst: "false",
            footer: false,
            // paging: true, // enable or disable pagination
            // perPage: 2, // set the number of rows per page
            // perPageSelect: [5, 10, 20, 50], // set the number of rows per page options
            // firstLast: true, // enable or disable the first and last buttons
            // nextPrev: true, // enable or disable the next and previous buttons
        });
    }
});
