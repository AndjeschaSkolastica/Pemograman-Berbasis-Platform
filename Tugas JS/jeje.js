document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("generateInputs").addEventListener("click", displayInputs);
});

function displayInputs() {
    const form = document.getElementById("myForm");
    const nama = form.nama.value.trim();

    // Error-trapping for Nama
    if (!nama.match(/^[A-Za-z\s]+$/)) { // Check if nama contains only letters and spaces
        alert("Nama harus berisi huruf saja. Mohon masukkan nama yang valid.");
        return;
    }

    // Capitalize first letter of each word in nama
    const capitalizedNama = nama.replace(/\b\w/g, c => c.toUpperCase());

    // Update nama input value with capitalizedNama
    form.nama.value = capitalizedNama;

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
        input.id = `Pilihan${i}`;
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

    submitButton.addEventListener("click", function() {
        const isFilled = options.every(option => option.value.trim() !== "");
        if (!isFilled) {
            alert("Semua pilihan harus diisi. Mohon lengkapi semua pilihan.");
            return;
        }
        displayOutput(options);
        // Submit button remains visible
        options.forEach(option => option.disabled = true); // Disable all input options
        submitButton.disabled = true; // Disable submit button
    });

    // Disable nama input, jumlahPilihan input, and OK button
    form.nama.disabled = true;
    form.jumlahPilihan.disabled = true;
    document.querySelector('input[type="button"][value="OK"]').disabled = true;

    const outputContainer = document.getElementById("outputContainer");

    // Remove existing output rows
    while (outputContainer.firstChild) {
        outputContainer.removeChild(outputContainer.firstChild);
    }

    outputContainer.appendChild(submitButton);
}

function displayOutput(options) {
    const form = document.getElementById("myForm");
    const nama = form.nama.value.trim();
    const outputContainer = document.getElementById("outputContainer");

    // Remove existing output rows
    while (outputContainer.firstChild) {
        outputContainer.removeChild(outputContainer.firstChild);
    }

    // Create radio buttons
    const radioContainer = document.createElement("div");
    radioContainer.className = "form-group radioContainer";

    const radioLabel = document.createElement("label");
    radioLabel.textContent = "Pilih Salah Satu:";
    radioContainer.appendChild(radioLabel);

    for (let input of options) {
        const radioDiv = document.createElement("div");

        const radioButton = document.createElement("input");
        radioButton.type = "radio";
        radioButton.id = input.id;
        radioButton.name = "selectedOption";
        radioButton.value = input.value;

        const radioText = document.createElement("label");
        radioText.textContent = input.value;
        radioText.setAttribute("for", input.id);

        radioDiv.appendChild(radioButton);
        radioDiv.appendChild(radioText);

        radioContainer.appendChild(radioDiv);
    }

    outputContainer.appendChild(radioContainer);

    // Create additional submit button for final display
    const finalSubmitButton = document.createElement("input");
    finalSubmitButton.type = "button";
    finalSubmitButton.value = "Final Submit";
    finalSubmitButton.onclick = function() {
        const selectedOption = document.querySelector('input[name="selectedOption"]:checked');
        if (selectedOption) {
            const options = [];
            const jumlahPilihan = parseInt(document.getElementById("jumlahPilihan").value);
    
            for (let i = 1; i <= jumlahPilihan; i++) {
                options.push(document.getElementById(`Pilihan${i}`).value);
            }
    
            const message = `Hallo, nama saya ${nama}, saya mempunyai sejumlah ${jumlahPilihan} pilihan yaitu: `;
            const finalMessage = `${message}${options.join(', ')}, dan saya memilih ${selectedOption.nextSibling.textContent}`;
    
            // Remove form and output elements
            form.style.display = "none";
            outputContainer.style.display = "none";

            // Remove input rows
            const inputContainer = document.getElementById("inputContainer");
            while (inputContainer.firstChild) {
                inputContainer.removeChild(inputContainer.firstChild);
            }
    
            // Create a new paragraph element to display the final message
            const finalParagraph = document.createElement('p');
            finalParagraph.textContent = finalMessage;
    
            // Insert the final message below the "header" element
            const header = document.querySelector('.header');
            header.parentNode.insertBefore(finalParagraph, header.nextSibling);
        } else {
            alert("Silakan pilih salah satu opsi.");
        }
    };

    outputContainer.appendChild(finalSubmitButton);

    
}


