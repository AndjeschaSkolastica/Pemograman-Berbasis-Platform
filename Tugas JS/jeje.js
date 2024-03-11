document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("generateInputs").addEventListener("click", displayInputs);
});

function displayInputs() {
    const form = document.getElementById("myForm");
    const nama = form.nama.value.trim();
    const jumlahPilihan = parseInt(form.jumlahPilihan.value);
    const inputContainer = document.getElementById("inputContainer");
    const outputContainer = document.getElementById("outputContainer");

    // Remove existing input rows
    while (inputContainer.firstChild) {
        inputContainer.removeChild(inputContainer.firstChild);
    }

    // Remove existing output rows
    while (outputContainer.firstChild) {
        outputContainer.removeChild(outputContainer.firstChild);
    }

    // Create input rows
    const options = [];
    for (let i = 1; i <= jumlahPilihan; i++) {
        const inputRow = document.createElement("div");
        inputRow.className = "inputRow";

        const label = document.createElement("label");
        label.textContent = `Teks Pilihan ${i}:`;

        const input = document.createElement("input");
        input.type = "text";
        input.id = `teksPilihan${i}`;
        input.name = `teksPilihan${i}`;
        input.className = "form-control";

        inputRow.appendChild(label);
        inputRow.appendChild(input);

        inputContainer.appendChild(inputRow);

        // Store options for later use
        options.push(`Teks Pilihan ${i}`);
    }

    // Create submit button
    const submitButton = document.createElement("input");
    submitButton.type = "button";
    submitButton.value = "Submit";
    submitButton.onclick = function() {
        displayOutput(options);
    };

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
    radioContainer.className = "form-group";

    const radioLabel = document.createElement("label");
    radioLabel.textContent = "Pilih Salah Satu:";
    radioContainer.appendChild(radioLabel);

    for (let option of options) {
        const radioDiv = document.createElement("div");

        const radioButton = document.createElement("input");
        radioButton.type = "radio";
        radioButton.id = option.replace(/\s+/g, "");
        radioButton.name = "selectedOption";
        radioButton.value = option;

        const radioText = document.createElement("label");
        radioText.textContent = option;
        radioText.setAttribute("for", option.replace(/\s+/g, ""));

        radioDiv.appendChild(radioButton);
        radioDiv.appendChild(radioText);

        radioContainer.appendChild(radioDiv);
    }

    outputContainer.appendChild(radioContainer);
}
