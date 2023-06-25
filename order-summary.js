jQuery(document).ready(function ($) {
  function downloadasTextFile(filename, text) {
    var element = document.createElement("a");
    element.setAttribute(
      "href",
      "data:text/plain;charset=utf-8," + encodeURIComponent(text)
    );
    element.setAttribute("download", filename);

    element.style.display = "none";
    document.body.appendChild(element);

    element.click();

    document.body.removeChild(element);
  }

  var orderDownloadButtons = document.querySelectorAll(".orderDownloadButton");
  orderDownloadButtons.forEach((orderDownloadButton) => {
    // Start file download.
    orderDownloadButton.addEventListener(
      "click",
      function () {
        var fileName = $(this).siblings(".orderId").val();
        var fileContent = $(this).siblings(".orderSummaryContent").val();
        // Generate download of phpcodertech.txt file with some content
        var text = document.getElementById("orderSummaryContent").value;
        var filename = "phpcodertech.txt";

        downloadasTextFile(fileName, fileContent);
      },
      false
    );
  });
});
