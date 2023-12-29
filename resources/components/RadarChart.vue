<script setup>
import { ref, onMounted } from "vue";

const props = defineProps(["radarChartData"]);

// Chart.js
const loadChartJS = () => {
  return new Promise((resolve, reject) => {
    const scriptChartJS = document.createElement("script");
    scriptChartJS.src =
      "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js";
    scriptChartJS.defer = true;
    document.head.appendChild(scriptChartJS);

    scriptChartJS.onload = resolve;
    scriptChartJS.onerror = reject;
    // scriptChartJS.onload = () => {
    //   // Vue Chart.jsを読み込みたいが、404not foundが出て読み込めない
    //   const scriptVueChartJS = document.createElement("script");
    //   scriptVueChartJS.src =
    //     "https://unpkg.com/vue-chartjs/dist/vue-chartjs.min.js";
    //   scriptVueChartJS.defer = true;
    //   document.head.appendChild(scriptVueChartJS);
    // };
  });
};

const radarChart = ref(null);

const chartData = {
  labels: [
    "単位取得のしやすさ",
    "面白さ",
    "教員の質",
    "サポート体制",
    "スキルが身につく",
  ],
  datasets: [
    {
      label: "カテゴリ別5段階評価",
      data: props.radarChartData,
      backgroundColor: "rgba(75, 192, 192, 0.2)",
      borderColor: "rgba(75, 192, 192, 1)",
      borderWidth: 2,
    },
  ],
};

onMounted(async () => {
  await loadChartJS();

  // Create Radar Chart
  const context = radarChart.value.getContext("2d");
  new Chart(context, {
    type: "radar",
    data: chartData,
    options: {
      scales: {
        r: {
          beginAtZero: true,
          min: 0,
          max: 5, // Adjust the max value as needed
          stepSize: 1, //Adjust the step size as needed
        },
        maintainAspectRatio: false,
        responsive: true,
      },
    },
  });
});
</script>

<template>
  <div>
    <canvas ref="radarChart" width="350" height="350"></canvas>
  </div>
</template>