document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("generateInputs").addEventListener("click", displayInputs);
});

function displayInputs() {
    const form = document.getElementById("myForm");
    const nama = form.nama.value.trim();
    const jumlahPilihan = parseInt(form.jumlahPilihan.value);
    const inputContainer = document.getElementById("inputContainer");
    const outputContainer = document.getElementById("outputContainer");
    const okButton = document.querySelector('input[type="button"][value="OK"]');
    const submitButton = document.createElement("input");
    
    // Disable nama input, jumlahPilihan input, and OK button
    form.nama.disabled = true;
    form.jumlahPilihan.disabled = true;
    okButton.disabled = true;

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
        options.push(input);
    }

    // Create submit button
    submitButton.type = "button";
    submitButton.value = "Submit";
    submitButton.onclick = function() {
        displayOutput(options);
        // Submit button remains visible
        options.forEach(option => option.disabled = true); // Disable all input options
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

    // Create submit button
    const submitButton = document.createElement("input");
    submitButton.type = "button";
    submitButton.value = "Submit";
    submitButton.onclick = function() {
        displayOutput(options);
        // Disable submit button after it's clicked
        submitButton.disabled = true;

        // Submit button remains visible
        options.forEach(option => option.disabled = true); // Disable all input options
    };
    
    outputContainer.appendChild(submitButton);

    // Create radio buttons
    const radioContainer = document.createElement("div");
    radioContainer.className = "form-group";

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
            const selectedText = selectedOption.nextSibling.textContent;
            const selectedValue = selectedOption.value;
    
            // Create the message to display
            const message = `Hallo, nama saya ${nama}, saya mempunyai sejumlah ${options.length} pilihan yaitu: `;
            const choices = options.map(option => option.value).join(', ');
            const finalMessage = `${message}${choices}, dan saya memilih ${selectedText}`;
    
            // Remove existing input and output elements
            while (inputContainer.firstChild) {
                inputContainer.removeChild(inputContainer.firstChild);
            }
    
            while (outputContainer.firstChild) {
                outputContainer.removeChild(outputContainer.firstChild);
            }
    
            // Create a new paragraph element to display the final message
            const finalParagraph = document.createElement('p');
            finalParagraph.textContent = finalMessage;
    
            // Append the final message to the output container
            outputContainer.appendChild(finalParagraph);
        } else {
            alert("Silakan pilih salah satu opsi.");
        }
    };
    
    

    outputContainer.appendChild(finalSubmitButton);
}
