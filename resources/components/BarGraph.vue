<script setup>
  import { ref, onMounted } from "vue";

  const props = defineProps(["barGraphData", "chartTitle"]);

  const extractKeyAndValue = (jsonData) => {
    const keysArray = [];
    const valuesArray = [];

    for (const key in jsonData) {
      if (jsonData.hasOwnProperty(key)) {
        keysArray.push(key);
        valuesArray.push(jsonData[key]);
      }
    }

    return {
      keys: keysArray,
      values: valuesArray
    };
  };

  // 最大値の大きさごとにグラフの最大の高さを指定する関数
  const getMaxValueResponse = (arr) => {
    // 境界値
    const thresholds = [10, 25, 50, 100];
    // 受け取った配列から最大値を取得する
    const maxValue = Math.max(...arr);
    for (let threshold of thresholds) {
      if (maxValue < threshold) {
        return threshold;
      }
    }
    return maxValue;
  };

  const keysAndValues = extractKeyAndValue(props.barGraphData);
  const labels = keysAndValues.keys;
  const data = keysAndValues.values;
  const maxValue = getMaxValueResponse(data);

  // Chart.js
  const loadChartJS = () => {
    return new Promise((resolve, reject) => {
      const scriptChartJS = document.createElement("script");
      scriptChartJS.src = "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.0.1/chart.umd.js";
      scriptChartJS.defer = true;
      document.head.appendChild(scriptChartJS);

      scriptChartJS.onload = resolve;
      scriptChartJS.onerror = reject;
    });
  };

  const barGraph = ref(null);

  const chartData = {
    labels: labels,
    datasets: [
      {
        label: props.chartTitle,
        data: data,
        backgroundColor: "rgba(75, 192, 192, 0.2)",
        borderColor: "rgba(75, 192, 192, 1)",
        borderWidth: 2
      }
    ]
  };

  onMounted(async () => {
    await loadChartJS();

    // Wait for the script to be executed
    await new Promise((resolve) => {
      const checkExist = setInterval(() => {
        if (typeof Chart !== "undefined") {
          clearInterval(checkExist);
          resolve();
        }
      }, 100);
    });

    // Create Bar Chart
    const context = barGraph.value.getContext("2d");
    new Chart(context, {
      type: "bar",
      data: chartData,
      options: {
        scales: {
          y: {
            beginAtZero: true,
            min: 0,
            max: maxValue, // グラフの最大高
            ticks: {
              stepSize: 2
            }
          }
        },
        maintainAspectRatio: false,
        responsive: true
      }
    });
  });
</script>

<template>
  <div>
    <canvas ref="barGraph" width="600" height="350"></canvas>
  </div>
</template>
