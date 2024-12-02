// Chart 2 - Insiden per Ruangan
function initializeChart2() {
    const ctx2 = document.getElementById("chart2")?.getContext("2d");
    if (!ctx2) return;

    // Hancurkan chart yang ada jika ada
    if (chart2) {
        chart2.destroy();
        chart2 = null;
    }

    // Persiapkan data
    let labels = [];
    let data = [];

    if (Array.isArray(insidenPerRuangan) && insidenPerRuangan.length > 0) {
        labels = insidenPerRuangan.map(
            (item) =>
                item.ruangan_relasi?.nama_ruangan || "Ruangan tidak dikenal"
        );
        data = insidenPerRuangan.map((item) => item.total || 0);
    } else {
        console.error("insidenPerRuangan is not an array or is empty");
    }

    // Buat warna gradien
    const backgroundColors = data.map((_, index) => {
        const gradient = ctx2.createLinearGradient(0, 0, 0, 300);
        gradient.addColorStop(
            0,
            `hsl(${(index * 360) / data.length}, 70%, 50%)`
        );
        gradient.addColorStop(
            1,
            `hsl(${(index * 360) / data.length}, 70%, 60%)`
        );
        return gradient;
    });

    chart2 = new Chart(ctx2, {
        type: "doughnut",
        data: {
            labels,
            datasets: [
                {
                    label: "Total Insiden per Ruangan",
                    data,
                    backgroundColor: backgroundColors,
                    hoverBackgroundColor: backgroundColors,
                    borderWidth: 1,
                },
            ],
        },
        options: {
            maintainAspectRatio: false,
            cutout: "60%",
            plugins: {
                legend: {
                    display: true,
                    position: "top",
                    labels: {
                        padding: 20,
                        boxWidth: 12,
                    },
                },
                tooltip: {
                    enabled: true,
                    callbacks: {
                        label: function (context) {
                            const value = context.raw || 0;
                            const total = context.dataset.data.reduce(
                                (a, b) => a + b,
                                0
                            );
                            const percentage = Math.round(
                                (value / total) * 100
                            );
                            return `${context.label}: ${value} (${percentage}%)`;
                        },
                    },
                },
            },
        },
    });
}

// Panggil fungsi saat dokumen siap
document.addEventListener("DOMContentLoaded", initializeChart2);
