function displayInputs() {
    const form = document.getElementById("myForm");
    const nama = form.nama.value;
    const jumlahPilihan = form.jumlahPilihan.value;
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
    for (let i = 1; i <= jumlahPilihan; i++) {
        const inputRow = document.createElement("div");
        inputRow.className = "inputRow";

        const label = document.createElement("label");
        label.textContent = `Pilihan ${i}:`;

        const input = document.createElement("input");
        input.type = "text";
        input.id = `teksPilihan${i}`;
        input.name = `teksPilihan${i}`;
        input.className = "form-control";

        inputRow.appendChild(label);
        inputRow.appendChild(input);

        inputContainer.appendChild(inputRow);
    }

    // Create output rows
    for (let i = 1; i <= jumlahPilihan; i++) {
        const outputRow = document. 
    