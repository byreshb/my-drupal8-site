/**
 * Using jquery's document-ready event to invoke javascript functions.
 */
$(document).ready(function () {

  // Server has its own sorting (by representative set). The data is sorted on the client side as well
  $("#rep-list").DataTable({
    "order": [[1, "asc"]]
  });

  // By default, the cursor is set to enter postal code
  $("#edit-postal-code").focus();

});
