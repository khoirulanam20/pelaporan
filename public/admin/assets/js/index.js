// Deklarasi variabel global untuk chart
window.chart1 = null;
window.chart2 = null;

// Tambahkan variabel global untuk menyimpan bulan yang dipilih
window.selectedMonths = undefined;

// Tambahkan definisi chartOptions
const chartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
        y: {
            beginAtZero: true,
            ticks: {
                stepSize: 1
            },
            grid: {
                display: true,
                drawBorder: false
            }
        },
        x: {
            grid: {
                display: false,
                drawBorder: false
            }
        }
    },
    plugins: {
        legend: {
            position: 'bottom',
            display: true
        },
        tooltip: {
            mode: 'index',
            intersect: false
        }
    }
};

document.addEventListener("DOMContentLoaded", function () {
    "use strict";

    // Pastikan elemen canvas ada
    const chartElement = document.getElementById("insidenChart");
    if (!chartElement) return;

    var ctx = chartElement.getContext("2d");
    
    // Set tahun dari localStorage jika ada
    let selectedYear = localStorage.getItem('selectedYear') || new Date().getFullYear();
    const yearSelect = document.querySelector('select[name="year"]');
    if (yearSelect) {
        yearSelect.value = selectedYear;
    }

    // Hancurkan chart yang ada jika ada
    if (window.chart1) {
        window.chart1.destroy();
        window.chart1 = null;
    }

    const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

    // Inisialisasi chart dengan mengambil data tahun yang dipilih
    fetchDataForYear(selectedYear)
        .then(data => {
            let selectedLabels = months;
            let selectedData = data.total || Array(12).fill(0);

            // Jika ada bulan yang dipilih
            if (window.selectedMonths && window.selectedMonths.length > 0) {
                selectedLabels = window.selectedMonths.map(m => months[m - 1]);
                selectedData = window.selectedMonths.map(m => {
                    const index = m - 1;
                    return data.total[index] || 0;
                });
            }

            createChart(ctx, selectedLabels, selectedData);
        })
        .catch(error => {
            console.error("Error:", error);
            alert(`Terjadi kesalahan: ${error.message}`);
        });

    // Event listener untuk dropdown tahun
    if (yearSelect) {
        yearSelect.addEventListener("change", function () {
            selectedYear = this.value;
            localStorage.setItem('selectedYear', selectedYear);
            updateChartData();
        });
    }

    // Tambahkan event listener untuk form submit
    document.querySelector('form').addEventListener('submit', function(event) {
        event.preventDefault();
        
        // Ambil nilai bulan yang dipilih dari form
        const checkedMonths = Array.from(document.querySelectorAll('input[name="bulan[]"]:checked'))
            .map(checkbox => parseInt(checkbox.value))
            .sort((a, b) => a - b); // Urutkan bulan
        
        // Set selectedMonths hanya jika ada bulan yang dipilih
        window.selectedMonths = checkedMonths.length > 0 ? checkedMonths : undefined;
        
        // Ambil data tahun terpilih
        const yearSelect = document.querySelector('select[name="year"]');
        selectedYear = yearSelect ? yearSelect.value : new Date().getFullYear();
        
        // Update chart dengan data yang sudah difilter
        fetchDataForYear(selectedYear)
            .then(data => {
                let updatedLabels = months;
                let updatedData = data.total || Array(12).fill(0);

                if (window.selectedMonths && window.selectedMonths.length > 0) {
                    updatedLabels = window.selectedMonths.map(m => months[m - 1]);
                    updatedData = window.selectedMonths.map(m => {
                        const index = m - 1;
                        return data.total[index] || 0;
                    });
                }

                const canvas = document.getElementById("insidenChart");
                const ctx = canvas.getContext("2d");
                createChart(ctx, updatedLabels, updatedData);
            })
            .catch(error => {
                console.error("Error:", error);
                alert(`Terjadi kesalahan: ${error.message}`);
            });
    });

    // Fungsi untuk mengupdate data grafik
    function updateChartData() {
        if (window.chart1) {
            window.chart1.destroy();
            window.chart1 = null;
        }

        fetchDataForYear(selectedYear)
            .then((data) => {
                let updatedLabels = months;
                let updatedData = data.total || Array(12).fill(0);

                // Gunakan window.selectedMonths yang sudah tersimpan
                if (window.selectedMonths && window.selectedMonths.length > 0) {
                    updatedLabels = window.selectedMonths.map(m => months[m - 1]);
                    updatedData = window.selectedMonths.map(m => {
                        const index = m - 1;
                        return data.total[index] || 0;
                    });
                }

                const canvas = document.getElementById("insidenChart");
                const ctx = canvas.getContext("2d");
                createChart(ctx, updatedLabels, updatedData);
            })
            .catch((error) => {
                console.error("Error:", error);
                alert(`Terjadi kesalahan: ${error.message}`);
            });
    }
});

function fetchDataForYear(year) {
    if (!year || year < 2020 || year > new Date().getFullYear() + 1) {
        return Promise.reject(new Error("Tahun tidak valid"));
    }

    return fetch(`/dashboard/data?year=${year}`)
        .then(response => {
            if (!response.ok) {
                throw new Error("Terjadi kesalahan pada server");
            }
            return response.json();
        })
        .then(data => {
            if (!data || !data.total || !Array.isArray(data.total)) {
                return {
                    total: Array(12).fill(0),
                    perJenis: {}
                };
            }
            return data;
        });
}

// Perbarui fungsi createChart untuk menggunakan data yang benar
function createChart(ctx, labels, data) {
    if (window.chart1) {
        window.chart1.destroy();
        window.chart1 = null;
    }

    const chartElement = document.getElementById("insidenChart");
    ctx.clearRect(0, 0, chartElement.width, chartElement.height);

    window.chart1 = new Chart(ctx, {
        type: "bar",
        data: {
            labels: labels,
            datasets: [{
                label: `Total Insiden ${selectedYear}`,
                data: data,
                borderColor: "#14abef",
                backgroundColor: "#14abef",
                hoverBackgroundColor: "#14abef",
                pointRadius: 0,
                fill: false,
                borderWidth: 0,
            }],
        },
        options: chartOptions
    });
}
