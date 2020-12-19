import "bootstrap";
import "../sass/main.scss";

import "./date";
import "./addEdit";
import "./form";
import "./weatherListWithChart";

// class MyChart {
//   private element: HTMLElement | null;
//   private spinner: HTMLDivElement | null = null;

//   constructor(elementId: string, private url: string) {
//     this.element = document.getElementById(elementId);
//     if (this.element) this.startBuildChart();
//   }

//   startBuildChart() {
//     this.buildSpinner();
//     this.getData();
//   }

//   buildSpinner() {
//     this.spinner = document.createElement("div");
//     this.spinner.classList.add("loader");
//     this.spinner.innerText = "Loading...";
//     this.element!.appendChild(this.spinner);
//   }

//   destroySpinner() {
//     this.element!.removeChild(this.spinner!);
//   }

//   buildDangerIcon() {
//     const dangerIcon = document.createElement("i");
//     dangerIcon.classList.add("gg-danger");
//     this.element!.appendChild(dangerIcon);
//   }

//   buildChart(res: AxiosResponse<ChartDim>) {
//     const { x, y } = res.data;
//     const canvas = document.createElement("canvas");
//     const ctx = canvas.getContext("2d")!;
//     const gray = getComputedStyle(document.documentElement).getPropertyValue(
//       "--primary",
//     );
//     const chart = new Chart(ctx, {
//       type: "line",
//       data: {
//         labels: x.map(date => {
//           const newDate = new Date(date);
//           const formatedDate = format(newDate, "E");
//           return formatedDate;
//         }),
//         datasets: [
//           {
//             label: "# of Votes",
//             data: y,
//             backgroundColor: "transparent",
//             borderColor: gray,
//             borderWidth: 1,
//             lineTension: 0,
//           },
//         ],
//       },
//       options: {
//         legend: {
//           display: false,
//         },
//         tooltips: {
//           callbacks: {
//             label: tooltipItem => `${tooltipItem.yLabel} ℃`,
//             title: () => "",
//           },
//         },
//         scales: {
//           yAxes: [
//             {
//               ticks: {
//                 beginAtZero: true,
//               },
//             },
//           ],
//         },
//       },
//     });
//     this.element!.appendChild(canvas);
//   }

//   getData() {
//     axios
//       .get<ChartDim>(this.url)
//       .then(res => this.buildChart(res))
//       .catch(() => this.buildDangerIcon())
//       .finally(() => this.destroySpinner());
//   }
// }

// new MyChart("tempChart", "city.api.php/" + location.search);
