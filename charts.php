<!DOCTYPE html>
<html>
<head>
<title>Interns - TGR</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<link rel="shortcut icon" href="favicon.png" type="img/x-icon"/>
</head>
<body>
<div class="stat">
<a href='rech.php'class="simple-button">> Page Précédente</a>
</div>
<style>
*{
  background-color:floralwhite;
}
.simple-button {
  display: inline-block;
  padding: 5px 10px;
  color:blue;
  cursor: pointer;
  font-size: 16px;
  text-align: center;
  margin-top: 10px;
  margin-left: 90px;
  text-decoration: none;
  transition: text-decoration 0.3s ease-in-out;
}

/* Underline on hover */
.simple-button:hover {
  text-decoration: underline;
  font-size: 18px;
}
</style>

     </div>
<div id="ch1">
<canvas id="chart1"></canvas></div>
<style>
 #ch1 {
    width: 600px;
    position: relative;
    margin-top: 150px;
    margin-left: 90px; 
    float: left;
    border: 1px solid #ccc;
    padding: 10px; 
    border-radius: 10px; 
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2); 
  }

  #ch2 {
    width: 600px;
    position: relative;
    margin-top: 150px; 
    margin-left: 60px; 
    float: left;
    border: 1px solid #ccc;
    padding: 10px; 
    border-radius: 10px; 
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2); 
  }
</style>




<?php
require_once('conn.php');

$distinct_months = array(
  'Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Jui',
  'Juill', 'Aou', 'Sep', 'Oct', 'Nov', 'Dec'
);

// Count occurrences of each month between bdate and fdate columns
$query = $conn->query("SELECT MONTH(bdate) AS b_month, MONTH(fdate) AS f_month FROM form");

$month_counts = array_fill(1, 12, 0); // Initialize all months with 0 counts

foreach ($query as $data1) {
  $b_month = $data1['b_month'];
  $f_month = $data1['f_month'];

  // If b_month > f_month, swap them
  if ($b_month > $f_month) {
    list($b_month, $f_month) = array($f_month, $b_month);
  }

  // Increment the count for months between bdate and fdate
  for ($i = $b_month; $i <= $f_month; $i++) {
    $month_counts[$i]++;
  }
}

// Get the counts for all months
$final_counts = array_values($month_counts);
?>


<script> 
const actions = [
  {
    name: 'pointStyle: circle (default)',
    handler: (chart) => {
      chart.data.datasets.forEach(dataset => {
        dataset.pointStyle = 'circle';
      });
      chart.update();
    }
  },
  {
    name: 'pointStyle: cross',
    handler: (chart) => {
      chart.data.datasets.forEach(dataset => {
        dataset.pointStyle = 'cross';
      });
      chart.update();
    }
  },
  {
    name: 'pointStyle: crossRot',
    handler: (chart) => {
      chart.data.datasets.forEach(dataset => {
        dataset.pointStyle = 'crossRot';
      });
      chart.update();
    }
  },
  {
    name: 'pointStyle: dash',
    handler: (chart) => {
      chart.data.datasets.forEach(dataset => {
        dataset.pointStyle = 'dash';
      });
      chart.update();
    }
  },
  {
    name: 'pointStyle: line',
    handler: (chart) => {
      chart.data.datasets.forEach(dataset => {
        dataset.pointStyle = 'line';
      });
      chart.update();
    }
  },
  {
    name: 'pointStyle: rect',
    handler: (chart) => {
      chart.data.datasets.forEach(dataset => {
        dataset.pointStyle = 'rect';
      });
      chart.update();
    }
  },
  {
    name: 'pointStyle: rectRounded',
    handler: (chart) => {
      chart.data.datasets.forEach(dataset => {
        dataset.pointStyle = 'rectRounded';
      });
      chart.update();
    }
  },
  {
    name: 'pointStyle: rectRot',
    handler: (chart) => {
      chart.data.datasets.forEach(dataset => {
        dataset.pointStyle = 'rectRot';
      });
      chart.update();
    }
  },
  {
    name: 'pointStyle: star',
    handler: (chart) => {
      chart.data.datasets.forEach(dataset => {
        dataset.pointStyle = 'star';
      });
      chart.update();
    }
  },
  {
    name: 'pointStyle: triangle',
    handler: (chart) => {
      chart.data.datasets.forEach(dataset => {
        dataset.pointStyle = 'triangle';
      });
      chart.update();
    }
  },
  {
    name: 'pointStyle: false',
    handler: (chart) => {
      chart.data.datasets.forEach(dataset => {
        dataset.pointStyle = false;
      });
      chart.update();
    }
  }
];
const data1 = {
  labels: <?php echo json_encode($distinct_months)?>,
  datasets: [
    {
      label: '',
      data: <?php echo json_encode($final_counts)?>,
      borderColor: 'red', // Set your desired border color here
      backgroundColor: 'rgba(255, 0, 0, 0.5)', // Set your desired background color here
      pointStyle: 'circle',
      pointRadius: 10,
      pointHoverRadius: 15
    }
  ]
};

const config1 = {
  type: 'line',
  data: data1,
  options: {
    responsive: true,
    plugins: {
      title: {
        display: true,
        text: (ctx) => 'Le nombre de stages par mois en 2023',
      }
    }
  }
};

var myChart1 = new Chart(
  document.getElementById('chart1'),
  config1
);

</script>


<div id="ch2">
<canvas id="chart"></canvas></div>
<?php
    require_once('conn.php');
   $query= $conn->query("SELECT school as Ecole, COUNT(*) as Nombre FROM form GROUP BY Ecole");
   foreach($query as $data){
    $Ecole[]=$data['Ecole'];
   $Nombre[]=$data['Nombre'];

}
    ?>

<script>
const labels =<?php echo json_encode($Ecole)?>;
const data = {
  labels: labels,
  datasets: [{
    label: '',
    data: <?php echo json_encode($Nombre)?>,
    backgroundColor: [
      'rgba(255, 99, 132, 0.2)',
      'rgba(255, 159, 64, 0.2)',
      'rgba(255, 205, 86, 0.2)',
      'rgba(75, 192, 192, 0.2)',
      'rgba(54, 162, 235, 0.2)',
      'rgba(153, 102, 255, 0.2)',
      'rgba(201, 203, 207, 0.2)'
    ],
    borderColor: [
      'rgb(255, 99, 132)',
      'rgb(255, 159, 64)',
      'rgb(255, 205, 86)',
      'rgb(75, 192, 192)',
      'rgb(54, 162, 235)',
      'rgb(153, 102, 255)',
      'rgb(201, 203, 207)'
    ],
    borderWidth: 1
  }]
};

const config = {
  type: 'bar',
  data: data,
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    },
    plugins: {
      title: {
        display: true,
        text: (ctx) => 'La répartition des stagiaires par école en 2023',
      }
    }
  }

  
};

var myChart = new Chart(
  document.getElementById('chart'),
  config
);
</script>
</body>
</html>