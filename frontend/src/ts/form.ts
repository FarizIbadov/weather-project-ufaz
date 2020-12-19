const form = document.querySelector<HTMLFormElement>(".needs-validation");

if (form) {
  form.addEventListener("submit", e => {
    if (!form.checkValidity()) {
      e.preventDefault();
      e.stopPropagation();
      form.classList.add("was-validated");
    }
  });
}
