import { format } from "date-fns";

const editBtns = document.querySelectorAll<HTMLButtonElement>(".edit-btn");
const addBtn = document.getElementById("addBtn") as HTMLButtonElement;
const modalForm = document.getElementById("modalForm") as HTMLFormElement;
const modalTitle = document.getElementById("modal-title");
const modalBtn = document.getElementById("modal-btn");

const idHiddenInput = document.createElement("input");
idHiddenInput.name = "weather_id";
idHiddenInput.id = "weather_id";
idHiddenInput.type = "hidden";

const date = document.getElementById("date") as HTMLInputElement;
const hiddenDate = document.getElementById("hidden-date") as HTMLInputElement;
const overallId = document.getElementById("overall") as HTMLSelectElement;
const temperature = document.getElementById("temp") as HTMLInputElement;
const wind = document.getElementById("wind") as HTMLInputElement;
const pressure = document.getElementById("pressure") as HTMLInputElement;
const humidity = document.getElementById("humid") as HTMLInputElement;
const visibility = document.getElementById("visibility") as HTMLInputElement;

editBtns.forEach(btn => {
  btn.addEventListener("click", e => {
    const target = e.target as HTMLElement;
    const weatherRow = target.closest(".weather-row");

    const dateCol = weatherRow!.querySelector("[data-date]");
    const tempCol = weatherRow!.querySelector("[data-temp]");
    const windCol = weatherRow!.querySelector("[data-wind]");
    const pressureCol = weatherRow!.querySelector("[data-pressure]");
    const overallCol = weatherRow!.querySelector("[data-overall]");
    const humidCol = weatherRow!.querySelector("[data-humid]");
    const visibilityCol = weatherRow!.querySelector("[data-visibility]");

    const btn = target.closest(".edit-btn") as HTMLButtonElement;

    idHiddenInput.value = btn.getAttribute("data-id")!;

    if (modalForm) {
      modalForm.classList.remove("was-validated");
      modalForm.action = "editData.php";
      modalForm.appendChild(idHiddenInput);

      const dateStr = dateCol!.getAttribute("data-date")!;
      const offset = new Date().getTimezoneOffset();
      const unformatedDate = new Date(dateStr);
      const formatedDate = format(
        new Date(
          unformatedDate.setMinutes(unformatedDate.getMinutes() - offset),
        ),
        "yyyy-L-dd",
      );

      date.value = formatedDate;
      hiddenDate.value = dateStr;
      overallId.value = overallCol!.getAttribute("data-overall")!;
      temperature.value = tempCol!.getAttribute("data-temp")!;
      wind.value = windCol!.getAttribute("data-wind")!;
      pressure.value = pressureCol!.getAttribute("data-pressure")!;
      humidity.value = humidCol!.getAttribute("data-humid")!;
      visibility.value = visibilityCol!.getAttribute("data-visibility")!;

      modalTitle!.innerText = "Update Data";

      modalBtn!.innerText = "Update";
    }
  });
});

if (addBtn) {
  addBtn.addEventListener("click", () => {
    if (modalForm) {
      modalForm.classList.remove("was-validated");
      modalForm.action = "addData.php";
      if (document.getElementById("weather_id")) {
        modalForm.removeChild(idHiddenInput);
      }

      date.value = "";
      hiddenDate.value = "";
      overallId.value = "";
      temperature.value = "";
      wind.value = "";
      pressure.value = "";
      humidity.value = "";
      visibility.value = "";

      modalTitle!.innerText = "Add Data";
      modalBtn!.innerText = "Add";
    }
  });
}
