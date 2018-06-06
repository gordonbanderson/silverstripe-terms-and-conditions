$( document ).ready(function() {
  // URL of PDF document
  console.log('Container', $('#toc-pdf'));
  var url = $('#toc-pdf').attr('data-url');

  //var url = "//cdn.mozilla.net/pdfjs/helloworld.pdf";

  console.log('URL', url);

// Asynchronous download PDF
// Asynchronous download of PDF
  var loadingTask = pdfjsLib.getDocument(url);
  loadingTask.promise.then(function (pdf) {
    console.log('PDF loaded');

    // Fetch the first page
    var pageNumber = 1;
    pdf.getPage(pageNumber).then(function (page) {
      console.log('Page loaded');

      var scale = 1.5;
      var viewport = page.getViewport(scale);

      // Prepare canvas using PDF page dimensions
      var canvas = document.getElementById('toc-pdf');
      var context = canvas.getContext('2d');
      canvas.height = viewport.height;
      canvas.width = viewport.width;

      // Render PDF page into canvas context
      var renderContext = {
        canvasContext: context,
        viewport: viewport
      };
      var renderTask = page.render(renderContext);
      renderTask.then(function () {
        console.log('Page rendered');
      });
    });
  }, function (reason) {
    // PDF loading error
    console.error(reason);
  })
});
