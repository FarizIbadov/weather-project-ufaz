import { format } from "date-fns";
import Chart from "chart.js";

class WeatherList {
  page = 1;
  itemPerPage = 7;
  paginator: HTMLElement | null;
  tableBody: HTMLElement | null;
  maxPage?: number;
  weatherList?: Element[];
  leftButton?: HTMLElement;
  rigthButton?: HTMLElement;

  constructor(private elementId: string) {
    this.paginator = document.getElementById("paginator");
    this.tableBody = document.getElementById("weather-body");
    if (this.paginator) {
      const btns = this.paginator.querySelectorAll<HTMLElement>("[data-x]");
      this.leftButton = btns[0];
      this.rigthButton = btns[1];

      this.leftButton.addEventListener("click", this.goToPrevPage.bind(this));
      this.rigthButton.addEventListener("click", this.goToNextPage.bind(this));
    }

    if (this.tableBody) {
      this.weatherList = [...this.tableBody.querySelectorAll(".weather-row")];
      this.maxPage = Math.ceil(this.weatherList.length / this.itemPerPage);

      this.paginateList(this.page);
    }
  }

  goToNextPage() {
    this.page++;
    this.paginateList(this.page);
  }

  goToPrevPage() {
    this.page--;
    this.paginateList(this.page);
  }

  paginateList(page: number) {
    const currentList = this.weatherList!.slice(
      (page - 1) * this.itemPerPage,
      page * this.itemPerPage,
    );
    this.startBuildChart(currentList);
    this.tableBody!.innerHTML = "";
    currentList.forEach(item => {
      this.tableBody!.append(item);
    });
    this.constructPaginator();
  }

  constructPaginator() {
    if (this.page >= this.maxPage!) {
      this.rigthButton!.classList.add("d-none");
    } else {
      this.rigthButton!.classList.remove("d-none");
    }

    if (this.page <= 1) {
      this.leftButton!.classList.add("d-none");
    } else {
      this.leftButton!.classList.remove("d-none");
    }
  }

  startBuildChart(weatherList: Element[]) {
    const x: string[] = [];
    const y: number[] = [];
    weatherList.forEach(weather => {
      const date = weather
        .querySelector("[data-date]")!
        .getAttribute("data-date")!;
      x.push(date);
      const temp = weather
        .querySelector("[data-temp]")!
        .getAttribute("data-temp")!;
      y.push(+temp);
    });
    this.constructChart(x, y);
  }

  constructChart(x: string[], y: number[]) {
    const element = document.getElementById(this.elementId);
    element!.innerHTML = "";
    const canvas = document.createElement("canvas");
    const ctx = canvas.getContext("2d")!;
    const gray = getComputedStyle(document.documentElement).getPropertyValue(
      "--primary",
    );
    const chart = new Chart(ctx, {
      type: "line",
      data: {
        labels: x.map(date => {
          const newDate = new Date(date);
          const formatedDate = format(newDate, "E");
          return formatedDate;
        }),
        datasets: [
          {
            label: "",
            data: y,
            backgroundColor: "transparent",
            borderColor: gray,
            borderWidth: 1,
            lineTension: 0,
          },
        ],
      },
      options: {
        legend: {
          display: false,
        },
        tooltips: {
          callbacks: {
            label: tooltipItem => `${tooltipItem.yLabel} ℃`,
            title: () => "",
          },
        },
        scales: {
          yAxes: [
            {
              ticks: {
                beginAtZero: true,
              },
            },
          ],
        },
      },
    });

    element!.appendChild(canvas);
  }
}

new WeatherList("tempChart");
