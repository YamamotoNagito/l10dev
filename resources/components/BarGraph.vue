<script setup>
  import { ref, onMounted } from "vue";

  // const props = defineProps(["barGraphData"]);
  // const barGraphData = [20, 30, 40, 50, 60]
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

  const keysAndValues = extractKeyAndValue(props.barGraphData);
  const labels = keysAndValues.keys;
  const data = keysAndValues.values;

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
            //   max: 100, // Adjust the max value as needed
            stepSize: 10 // Adjust the step size as needed
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
