import { format } from "date-fns";

const date = document.getElementById("date");
const hiddenDate = document.getElementById(
  "hidden-date",
) as HTMLInputElement | null;

if (date) {
  date.addEventListener("change", e => {
    const target = e.target as HTMLInputElement;
    const value = new Date(target.value);
    const timezone = value.getTimezoneOffset();
    const serverDate = new Date(
      value.setMinutes(value.getMinutes() + timezone),
    );
    const formatedDate = format(serverDate, "yyyy-L-dd HH:mm:ss");
    hiddenDate!.value = formatedDate;
  });
}
