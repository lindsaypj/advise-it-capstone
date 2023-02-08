
const copyBtn = document.getElementById("copy-url");

copyBtn.onclick = () => {
    const url = document.getElementById("urlInput");

    // Select the text field
    url.select();
    url.setSelectionRange(0, 99999); // For mobile devices

    // Copy the text inside the text field
    navigator.clipboard.writeText(url.value);
}