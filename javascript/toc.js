$( document ).ready(function() {
  // URL of PDF document
  var url = "http://mozilla.github.io/pdf.js/examples/learning/helloworld.pdf";

  console.log('URL', url);

// Asynchronous download PDF
  pdfjsLib.getDocument(url)
    .then(function(pdf) {
      console.log('Rendering page 1');
      return pdf.getPage(1);
    })
    .then(function(page) {
      // Set scale (zoom) level
      var scale = 1.5;

      // Get viewport (dimensions)
      var viewport = page.getViewport(scale);

      // Get canvas#the-canvas
      var canvas = document.getElementById('toc-pdf');

      // Fetch canvas' 2d context
      var context = canvas.getContext('2d');

      // Set dimensions to Canvas
      canvas.height = viewport.height;
      canvas.width = viewport.width;

      console.log('W', canvas.width);
      console.log('H', canvas.height);

      // Prepare object needed by render method
      var renderContext = {
        canvasContext: context,
        viewport: viewport
      };

      // Render PDF page
      page.render(renderContext);
    });

});
