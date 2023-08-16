$(document).ready(function () {
  var sortDirection = {
    montant: "asc",
    date: "asc",
    id: "asc",
  };

  $(".sort-btn").click(function () {
    var column = $(this).parent().index(); // Get the index of the clicked header cell
    var columnName = $(this).parent().find("span").text().trim().toLowerCase();

    sortTable(column, columnName);
  });

  function sortTable(columnIndex, columnName) {
    var table, rows, switching, i, x, y, shouldSwitch;
    table = document.querySelector(".table");
    switching = true;

    while (switching) {
      switching = false;
      rows = table.rows;

      for (i = 1; i < rows.length - 1; i++) {
        shouldSwitch = false;

        x = rows[i].getElementsByTagName("td")[columnIndex];
        y = rows[i + 1].getElementsByTagName("td")[columnIndex];

        if (columnIndex === 2) {
          x = new Date(x.textContent);
          y = new Date(y.textContent);
        } else {
          x = parseFloat(x.textContent);
          y = parseFloat(y.textContent);
        }

        if (isNaN(x)) {
          x = x.textContent.toLowerCase();
          y = y.textContent.toLowerCase();
        }

        if (
          (sortDirection[columnName] === "asc" && x > y) ||
          (sortDirection[columnName] === "desc" && x < y)
        ) {
          shouldSwitch = true;
          break;
        }
      }

      if (shouldSwitch) {
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
      }
    }

    // Toggle the sorting direction for the clicked column
    sortDirection[columnName] =
      sortDirection[columnName] === "asc" ? "desc" : "asc";
  }
});
