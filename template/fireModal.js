const dropzone = document.getElementById("dropzone");
const fileInput = document.getElementById("fileInput");
const filePreview = document.getElementById("filePreview");
const uploadForm = document.getElementById("uploadForm");

// Klik untuk memilih file
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
