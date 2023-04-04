<?php 
  

  $qSelect = $this->db->query("SELECT * FROM mod_document WHERE document_id='".$this->uri->segment(4)."'");

        foreach ($qSelect->result_array() as $row){}

        $this->load->helper('download');

        $users = $session_data['user_id'];

        $file = 'document/'.$row['document_upload'];

        $exten = $row['document_upload'];

?>
<?php 
    

    $file_extension = pathinfo($exten, PATHINFO_EXTENSION);
    if($file_extension == 'pdf'){
      $pages = base_url('').$file; 
    } else {
      force_download($file, NULL);
    }
    
?>
<div class="pagination">
    <div class="wrap">
        <button id="prev">Previous</button>
        <button id="next">Next</button>
        &nbsp; &nbsp;
        <span>Page: <span id="page_num"></span> / 
        <span id="page_count"></span></span>
    </div>
</div>
<style type="text/css">

  .pagination{
    background: #ffffff;
    width: 100%;
    float: left;
}
.pagination .wrap{
    float:right;
    width: 300px;
} 
#the-canvas {
    border: 1px solid black;
    direction: ltr;
    margin: 0 auto;
    display: block;
}
@media print {
  body {display:none;}
}

body {
  position: absolute;
  margin: 0;
}

body:before {
  content: "";
  position: absolute;
  z-index: 9999;
  top: 100;
  bottom: 0;
  left: 0;
  right: 0;
  background-image: url("https://192.168.20.1:60004/coding/eArsip/document/watermark.png");
  background-repeat: no-repeat 0;
}
</style>
<canvas id="the-canvas">
  
</canvas>

<script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
<script>
// Disable Canvas Image Downloading    
document.addEventListener('contextmenu', event => event.preventDefault());

// If absolute URL from the remote server is provided, configure the CORS
// header on that server.
var url = '<?php echo $pages;?>'; // your file location and file name with ext.

// Loaded via <script> tag, create shortcut to access PDF.js exports.
var pdfjsLib = window['pdfjs-dist/build/pdf'];

// The workerSrc property shall be specified.
pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://mozilla.github.io/pdf.js/build/pdf.worker.js';

var pdfDoc = null,
    pageNum = 1,
    pageRendering = false,
    pageNumPending = null,
    scale = 2,
    canvas = document.getElementById('the-canvas'),
    ctx = canvas.getContext('2d');

/**
 * Get page info from document, resize canvas accordingly, and render page.
 * @param num Page number.
 */
function renderPage(num) {
  pageRendering = true;
  // Using promise to fetch the page
  pdfDoc.getPage(num).then(function(page) {
    var viewport = page.getViewport({scale: scale});
    canvas.height = viewport.height;
    canvas.width = viewport.width;

    // Render PDF page into canvas context
    var renderContext = {
      canvasContext: ctx,
      viewport: viewport
    };
    var renderTask = page.render(renderContext);

    // Wait for rendering to finish
    renderTask.promise.then(function() {
      pageRendering = false;
      if (pageNumPending !== null) {
        // New page rendering is pending
        renderPage(pageNumPending);
        pageNumPending = null;
      }
    });
  });

  // Update page counters
  document.getElementById('page_num').textContent = num;
}

/**
 * If another page rendering in progress, waits until the rendering is
 * finised. Otherwise, executes rendering immediately.
 */
function queueRenderPage(num) {
  if (pageRendering) {
    pageNumPending = num;
  } else {
    renderPage(num);
  }
}

/**
 * Displays previous page.
 */
function onPrevPage() {
  if (pageNum <= 1) {
    return;
  }
  pageNum--;
  queueRenderPage(pageNum);
}
document.getElementById('prev').addEventListener('click', onPrevPage);

/**
 * Displays next page.
 */
function onNextPage() {
  if (pageNum >= pdfDoc.numPages) {
    return;
  }
  pageNum++;
  queueRenderPage(pageNum);
}
document.getElementById('next').addEventListener('click', onNextPage);

/**
 * Asynchronously downloads PDF.
 */
pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
  pdfDoc = pdfDoc_;
  document.getElementById('page_count').textContent = pdfDoc.numPages;

  // Initial/first page rendering
  renderPage(pageNum);
});



</script>