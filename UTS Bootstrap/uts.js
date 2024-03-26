document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("generateInputs").addEventListener("click", displayInputs);
});

function displayInputs() {
  const form = document.getElementById("myForm");
  const namaDepan = form.namaDepan.value.trim();
  const namaBelakang = form.namaBelakang.value.trim();
  const email = form.email.value.trim();

  // Error-trapping for Nama Depan
  if (!namaDepan.match(/^[A-Za-z\s]+$/)) {
    // Check if namaDepan contains only letters and spaces
    alert("Nama Depan harus berisi huruf saja. Mohon masukkan nama yang valid.");
    return;
  }

  // Error-trapping for Nama Belakang
  if (!namaBelakang.match(/^[A-Za-z\s]+$/)) {
    // Check if namaBelakang contains only letters and spaces
    alert("Nama Belakang harus berisi huruf saja. Mohon masukkan nama yang valid.");
    return;
  }

  // Error-trapping for Email
  if (!email.match(/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/)) {
    alert("Email tidak valid. Mohon masukkan email yang valid.");
    return;
  }

  const jumlahPilihan = parseInt(form.jumlahPilihan.value);

  // Error-trapping for jumlahPilihan
  if (isNaN(jumlahPilihan)) {
    alert("Input jumlah pilihan harus berupa angka. Mohon masukkan angka.");
    return;
  }

  const inputContainer = document.getElementById("inputContainer");

  // Remove existing input rows
  while (inputContainer.firstChild) {
    inputContainer.removeChild(inputContainer.firstChild);
  }

  // Create input rows
  const options = [];
  for (let i = 1; i <= jumlahPilihan; i++) {
    const inputRow = document.createElement("div");
    inputRow.className = "inputRow";

    const label = document.createElement("label");
    label.textContent = `Pilihan ${i}:`;

    const input = document.createElement("input");
    input.type = "text";
    input.name = `Pilihan${i}`;
    input.className = "form-control";

    inputRow.appendChild(label);
    inputRow.appendChild(input);

    inputContainer.appendChild(inputRow);

    // Store options for later use
    options.push(input);
  }

  // Create submit button
  const submitButton = document.createElement("input");
  submitButton.type = "button";
  submitButton.value = "Submit";

  submitButton.addEventListener("click", function () {
    const isFilled = options.every((option) => option.value.trim() !== "");
    if (!isFilled) {
      alert("Semua pilihan harus diisi. Mohon lengkapi semua pilihan.");
      return;
    }
    displayOutput(options, namaDepan, namaBelakang, email);
    // Submit button remains visible
    options.forEach((option) => (option.disabled = true)); // Disable all input options
    submitButton.disabled = true; // Disable submit button
  });

  // Disable namaDepan input, namaBelakang input, email input, jumlahPilihan input, and OK button
  form.namaDepan.disabled = true;
  form.namaBelakang.disabled = true;
  form.email.disabled = true;
  form.jumlahPilihan.disabled = true;
  document.querySelector('input[type="button"][value="OK"]').disabled = true;

  const outputContainer = document.getElementById("outputContainer");

  // Remove existing output rows
  while (outputContainer.firstChild) {
    outputContainer.removeChild(outputContainer.firstChild);
  }

  outputContainer.appendChild(submitButton);
}

function displayOutput(options, namaDepan, namaBelakang, email) {
  const form = document.getElementById("myForm");
  const outputContainer = document.getElementById("outputContainer");

  // Remove existing output rows
  while (outputContainer.firstChild) {
    outputContainer.removeChild(outputContainer.firstChild);
  }

  // Create checkbox options
  const checkboxContainer = document.createElement("div");
  checkboxContainer.className = "form-group checkboxContainer";

  const checkboxLabel = document.createElement("label");
  checkboxLabel.textContent = "Pilih Salah Satu atau Lebih:";
  checkboxContainer.appendChild(checkboxLabel);

  for (let input of options) {
    const checkboxDiv = document.createElement("div");
    checkboxDiv.className = "checkboxDiv";

    const checkbox = document.createElement("input");
    checkbox.type = "checkbox";
    checkbox.name = "selectedOptions[]";
    checkbox.className = "checkbox-input";

    const label = document.createElement("label");
    label.textContent = input.value;

    checkboxDiv.appendChild(checkbox);
    checkboxDiv.appendChild(label);

    checkboxContainer.appendChild(checkboxDiv);
  }

  outputContainer.appendChild(checkboxContainer);

  // Create additional submit button for final display
  const finalSubmitButton = document.createElement("input");
  finalSubmitButton.type = "button";
  finalSubmitButton.value = "Final Submit";
  finalSubmitButton.onclick = function () {
    const selectedOptions = document.querySelectorAll('input[name="selectedOptions[]"]:checked');
    if (selectedOptions.length > 0) {
      const selectedValues = Array.from(selectedOptions).map((option) => option.parentNode.textContent.trim());
      const options = [];
      const jumlahPilihan = parseInt(document.getElementById("jumlahPilihan").value);

      for (let i = 1; i <= jumlahPilihan; i++) {
        options.push(document.querySelector(`input[name="Pilihan${i}"]`).value);
      }

      const message = `Hallo, nama saya ${namaDepan} ${namaBelakang}, dengan email ${email}, saya mempunyai sejumlah ${jumlahPilihan} pilihan hobby yaitu: `;
      const finalMessage = `${message}${options.join(", ")}, dan saya menyukai ${selectedValues.join(", ")}`;

      // Remove form and output elements
      form.style.display = "none";
      outputContainer.style.display = "none";

      // Remove input rows
      const inputContainer = document.getElementById("inputContainer");
      while (inputContainer.firstChild) {
        inputContainer.removeChild(inputContainer.firstChild);
      }

      // Create a new paragraph element to display the final message
      const finalParagraph = document.createElement("p");
      finalParagraph.textContent = finalMessage;

      // Insert the final message below the "header" element
      const header = document.querySelector(".header");
      header.parentNode.insertBefore(finalParagraph, header.nextSibling);
    } else {
      alert("Silakan pilih setidaknya satu opsi.");
    }
  };

  outputContainer.appendChild(finalSubmitButton);
}
