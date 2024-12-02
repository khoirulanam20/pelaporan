document.addEventListener('DOMContentLoaded', function() {
  "use strict";
  
  // Pastikan elemen canvas ada
  const chartElement = document.getElementById("insidenChart");
  if (!chartElement) return;
  
  var ctx = chartElement.getContext('2d');
 
  var gradientStroke3 = ctx.createLinearGradient(0, 0, 0, 300);
  gradientStroke3.addColorStop(0, '#14abef');
  gradientStroke3.addColorStop(1, '#14abef');

  const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
  let selectedLabels = months;
  let selectedData = [];

  // Jika ada bulan yang dipilih
  if (typeof selectedMonths !== 'undefined' && selectedMonths.length > 0) {
      selectedLabels = selectedMonths.map(m => months[m-1]);
      selectedData = selectedMonths.map(m => {
          const index = m - 1;
          return dataInsiden.total[index] || 0;
      });
  } else {
      selectedData = dataInsiden.total;
  }

  // Hancurkan chart yang ada jika ada
  if (window.myChart instanceof Chart) {
      window.myChart.destroy();
  }

  window.myChart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: selectedLabels,
          datasets: [
            {
              label: 'Total Insiden',
              data: selectedData,
              borderColor: gradientStroke3,
              backgroundColor: gradientStroke3,
              hoverBackgroundColor: gradientStroke3,
              pointRadius: 0,
              fill: false,
              borderWidth: 0
          }]
      },
      options: {
          maintainAspectRatio: false,
          plugins: {
              legend: {
                  position: 'bottom',
                  display: true,
                  labels: {
                      boxWidth: 8
                  }
              },
              tooltip: {
                  displayColors: false
              }
          },
          scales: {
              x: {
                  barPercentage: 0.5
              },
              y: {
                  beginAtZero: true
              }
          }
      }
  });

  // Reset filter form submission
  document.getElementById('resetFilterForm').addEventListener('submit', function(e) {
      e.preventDefault();
      
      // Submit form
      this.submit();
      
      // Reset select element ke default
      document.querySelector('select[name="months[]"]').selectedIndex = -1;
  });
});	 

// Chart 2 - Insiden per Ruangan
function initializeChart2() {
    const ctx2 = document.getElementById("chart2")?.getContext('2d');
    if (!ctx2) return;

    // Persiapkan data
    let labels = [];
    let data = [];

    if (Array.isArray(insidenPerRuangan) && insidenPerRuangan.length > 0) {
        labels = insidenPerRuangan.map(item => 
            item.ruangan_relasi?.nama_ruangan || 'Ruangan tidak dikenal'
        );
        data = insidenPerRuangan.map(item => item.total || 0);
    } else {
        console.error('insidenPerRuangan is not an array or is empty');
    }

    // Buat warna gradien
    const backgroundColors = data.map((_, index) => {
        const gradient = ctx2.createLinearGradient(0, 0, 0, 300);
        gradient.addColorStop(0, `hsl(${index * 360/data.length}, 70%, 50%)`);
        gradient.addColorStop(1, `hsl(${index * 360/data.length}, 70%, 60%)`);
        return gradient;
    });

    new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels,
            datasets: [{
                label: 'Total Insiden per Ruangan',
                data,
                backgroundColor: backgroundColors,
                hoverBackgroundColor: backgroundColors,
                borderWidth: 1
            }]
        },
        options: {
            maintainAspectRatio: false,
            cutout: '60%',
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        padding: 20,
                        boxWidth: 12
                    }
                },
                tooltip: {
                    enabled: true,
                    callbacks: {
                        label: function(context) {
                            const value = context.raw || 0;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = Math.round((value / total) * 100);
                            return `${context.label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });
}

// Panggil fungsi saat dokumen siap
document.addEventListener('DOMContentLoaded', initializeChart2);

$(function() {
    "use strict";
	 
// chart 2



// worl map

jQuery('#geographic-map-2').vectorMap(
{
    map: 'world_mill_en',
    backgroundColor: 'transparent',
    borderColor: '#818181',
    borderOpacity: 0.25,
    borderWidth: 1,
    zoomOnScroll: false,
    color: '#009efb',
    regionStyle : {
        initial : {
          fill : '#008cff'
        }
      },
    markerStyle: {
      initial: {
				r: 9,
				'fill': '#fff',
				'fill-opacity':1,
				'stroke': '#000',
				'stroke-width' : 5,
				'stroke-opacity': 0.4
                },
                },
    enableZoom: true,
    hoverColor: '#009efb',
    markers : [{
        latLng : [21.00, 78.00],
        name : 'Lorem Ipsum Dollar'
      
      }],
    hoverOpacity: null,
    normalizeFunction: 'linear',
    scaleColors: ['#b6d6ff', '#005ace'],
    selectedColor: '#c9dfaf',
    selectedRegions: [],
    showTooltip: true,
});


// chart 3

 var ctx = document.getElementById('chart3').getContext('2d');

  var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
      gradientStroke1.addColorStop(0, '#008cff');
      gradientStroke1.addColorStop(1, 'rgba(22, 195, 233, 0.1)');

      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
          datasets: [{
            label: 'Revenue',
            data: [3, 30, 10, 10, 22, 12, 5],
            pointBorderWidth: 2,
            pointHoverBackgroundColor: gradientStroke1,
            backgroundColor: gradientStroke1,
            borderColor: gradientStroke1,
            borderWidth: 3
          }]
        },
        options: {
			maintainAspectRatio: false,
            legend: {
			  position: 'bottom',
              display:false
            },
            tooltips: {
			  displayColors:false,	
              mode: 'nearest',
              intersect: false,
              position: 'nearest',
              xPadding: 10,
              yPadding: 10,
              caretPadding: 10
            }
         }
      });



// chart 4

var ctx = document.getElementById("chart4").getContext('2d');

  var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
      gradientStroke1.addColorStop(0, '#ee0979');
      gradientStroke1.addColorStop(1, '#ff6a00');
    
  var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
      gradientStroke2.addColorStop(0, '#283c86');
      gradientStroke2.addColorStop(1, '#39bd3c');

  var gradientStroke3 = ctx.createLinearGradient(0, 0, 0, 300);
      gradientStroke3.addColorStop(0, '#7f00ff');
      gradientStroke3.addColorStop(1, '#e100ff');

      var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
          labels: ["Completed", "Pending", "Process"],
          datasets: [{
            backgroundColor: [
              gradientStroke1,
              gradientStroke2,
              gradientStroke3
            ],

             hoverBackgroundColor: [
              gradientStroke1,
              gradientStroke2,
              gradientStroke3
            ],

            data: [50, 50, 50],
      borderWidth: [1, 1, 1]
          }]
        },
        options: {
		 maintainAspectRatio: false,
          cutoutPercentage: 0,
            legend: {
              position: 'bottom',
              display: false,
            labels: {
                boxWidth:8
              }
            },
			tooltips: {
			  displayColors:false,
			},
        }
      });

	  
  // chart 5

    var ctx = document.getElementById("chart5").getContext('2d');
   
      var gradientStroke1 = ctx.createLinearGradient(0, 0, 0, 300);
      gradientStroke1.addColorStop(0, '#f54ea2');
      gradientStroke1.addColorStop(1, '#ff7676');

      var gradientStroke2 = ctx.createLinearGradient(0, 0, 0, 300);
      gradientStroke2.addColorStop(0, '#42e695');
      gradientStroke2.addColorStop(1, '#3bb2b8');

      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: [1, 2, 3, 4, 5, 6, 7, 8],
          datasets: [{
            label: 'Clothing',
            data: [40, 30, 60, 35, 60, 25, 50, 40],
            borderColor: gradientStroke1,
            backgroundColor: gradientStroke1,
            hoverBackgroundColor: gradientStroke1,
            pointRadius: 0,
            fill: false,
            borderWidth: 1
          }, {
            label: 'Electronic',
            data: [50, 60, 40, 70, 35, 75, 30, 20],
            borderColor: gradientStroke2,
            backgroundColor: gradientStroke2,
            hoverBackgroundColor: gradientStroke2,
            pointRadius: 0,
            fill: false,
            borderWidth: 1
          }]
        },
		options:{
		  maintainAspectRatio: false,
		  legend: {
			  position: 'bottom',
              display: false,
			  labels: {
                boxWidth:8
              }
            },	
		  scales: {
			  xAxes: [{
				barPercentage: .5
			  }]
		     },
			tooltips: {
			  displayColors:false,
			}
		}
      });




   });	 
   