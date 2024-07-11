"use strict";

$("#modal-1").fireModal({ body: "Modal body text goes here." });
$("#modal-2").fireModal({
  body: `
  <head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
  </head>
  <body>
    <div class="card-body">
      <form id="uploadForm" action="C_Visual/upload" method="POST" enctype="multipart/form-data">
        <div class="dropzone" id="dropzone">
          Drop file Excel disini atau klik untuk upload
          <input type="file" name="myFile" id="fileInput" accept=".csv,.xls,.xlsx" style="display: none;">
        </div>
        <div class="d-flex justify-content-center">
          <div class="file-preview" id="filePreview"></div>
        </div>
        <div class="d-flex justify-content-center">
          <button type="submit" class="btn rounded-pill btn-primary submit-btn">Upload</button>
        </div>
      </form>
    </div>
  </body>`,
  center: true,
  shown: function (modal) {
    // Ensure the elements are available after the modal is shown
    const dropzone = modal.querySelector("#dropzone");
    const fileInput = modal.querySelector("#fileInput");
    const filePreview = modal.querySelector("#filePreview");
    const uploadForm = modal.querySelector("#uploadForm");

    if (!dropzone || !fileInput || !filePreview || !uploadForm) {
      console.error("One or more elements not found.");
      return;
    }

    // Click to select file
    dropzone.addEventListener("click", () => {
      fileInput.click();
    });

    // Drag over event
    dropzone.addEventListener("dragover", (e) => {
      e.preventDefault();
      dropzone.classList.add("dragover");
    });

    // Drag leave event
    dropzone.addEventListener("dragleave", (e) => {
      e.preventDefault();
      dropzone.classList.remove("dragover");
    });

    // Drop event
    dropzone.addEventListener("drop", (e) => {
      e.preventDefault();
      dropzone.classList.remove("dragover");
      const files = e.dataTransfer.files;
      if (files.length) {
        validateAndPreviewFile(files[0]);
      }
    });

    // Change event when file is selected using file input
    fileInput.addEventListener("change", (e) => {
      const files = e.target.files;
      if (files.length) {
        validateAndPreviewFile(files[0]);
      }
    });

    function validateAndPreviewFile(file) {
      const allowedExtensions = /(\.xls|\.xlsx|\.csv)$/i;
      if (!allowedExtensions.exec(file.name)) {
        alert("Invalid file type! Please upload an Excel file.");
        fileInput.value = "";
        filePreview.innerHTML = "";
        return;
      }

      showFilePreview(file);
    }

    function showFilePreview(file) {
      filePreview.innerHTML = "";
      const fileType = file.type;

      let icon = "";
      if (fileType.includes("spreadsheet") || fileType.includes("excel")) {
        icon = "https://img.icons8.com/color/48/000000/ms-excel.png"; // Excel icon
      } else if (fileType.includes("csv")) {
        icon = "https://img.icons8.com/color/48/000000/csv.png"; // CSV icon
      } else {
        icon = "https://img.icons8.com/color/48/000000/document.png"; // Default document icon
      }

      filePreview.innerHTML = `<img src="${icon}" alt="File Icon"><span>${file.name}</span>`;
    }

    // Handle form submit
    uploadForm.addEventListener("submit", (e) => {
      if (!fileInput.files.length) {
        e.preventDefault();
        alert("Please select a file before submitting.");
      }
    });
  },
});

let modal_3_body =
  '<p>Object to create a button on the modal.</p><pre class="language-javascript"><code>';
modal_3_body += "[\n";
modal_3_body += " {\n";
modal_3_body += "   text: 'Login',\n";
modal_3_body += "   submit: true,\n";
modal_3_body += "   class: 'btn btn-primary btn-shadow',\n";
modal_3_body += "   handler: function(modal) {\n";
modal_3_body += "     alert('Hello, you clicked me!');\n";
modal_3_body += "   }\n";
modal_3_body += " }\n";
modal_3_body += "]";
modal_3_body += "</code></pre>";
$("#modal-3").fireModal({
  title: "Modal with Buttons",
  body: modal_3_body,
  buttons: [
    {
      text: "Click, me!",
      class: "btn btn-primary btn-shadow",
      handler: function (modal) {
        alert("Hello, you clicked me!");
      },
    },
  ],
});

$("#modal-4").fireModal({
  footerClass: "bg-whitesmoke",
  body: "Add the <code>bg-whitesmoke</code> class to the <code>footerClass</code> option.",
  buttons: [
    {
      text: "No Action!",
      class: "btn btn-primary btn-shadow",
      handler: function (modal) {},
    },
  ],
});

$("#modal-5").fireModal({
  title: "Login",
  body: $("#modal-login-part"),
  footerClass: "bg-whitesmoke",
  autoFocus: false,
  onFormSubmit: function (modal, e, form) {
    // Form Data
    let form_data = $(e.target).serialize();
    console.log(form_data);

    // DO AJAX HERE
    let fake_ajax = setTimeout(function () {
      form.stopProgress();
      modal
        .find(".modal-body")
        .prepend(
          '<div class="alert alert-info">Please check your browser console</div>'
        );

      clearInterval(fake_ajax);
    }, 1500);

    e.preventDefault();
  },
  shown: function (modal, form) {
    console.log(form);
  },
  buttons: [
    {
      text: "Login",
      submit: true,
      class: "btn btn-primary btn-shadow",
      handler: function (modal) {},
    },
  ],
});

$("#modal-6").fireModal({
  body: "<p>Now you can see something on the left side of the footer.</p>",
  created: function (modal) {
    modal
      .find(".modal-footer")
      .prepend('<div class="mr-auto"><a href="#">I\'m a hyperlink!</a></div>');
  },
  buttons: [
    {
      text: "No Action",
      submit: true,
      class: "btn btn-primary btn-shadow",
      handler: function (modal) {},
    },
  ],
});

$(".oh-my-modal").fireModal({
  title: "My Modal",
  body: "This is cool plugin!",
});
