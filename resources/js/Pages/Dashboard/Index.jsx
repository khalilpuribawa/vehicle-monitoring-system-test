import { useEffect, useRef } from 'react';
import AppLayout from '../../Layouts/AppLayout';
import { Head, usePage } from '@inertiajs/react';
import Chart from 'chart.js/auto';

export default function Dashboard() {
    const { orangCount, barangCount } = usePage().props;
    const chartRef = useRef(null);
    const chartInstance = useRef(null);

    useEffect(() => {
        if (chartRef.current) {
            if (chartInstance.current) {
                chartInstance.current.destroy();
            }
            chartInstance.current = new Chart(chartRef.current, {
                type: 'pie',
                data: {
                    labels: ['Angkutan Orang', 'Angkutan Barang'],
                    datasets: [{
                        label: '# of Bookings',
                        data: [orangCount, barangCount],
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.8)',
                            'rgba(255, 99, 132, 0.8)'
                        ],
                        borderWidth: 1
                    }]
                }
            });
        }
        return () => {
            if (chartInstance.current) {
                chartInstance.current.destroy();
            }
        }
    }, [orangCount, barangCount]);

    return (
        <AppLayout>
            <Head title="Dashboard" />
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div className="p-6 bg-white rounded-lg shadow dark:bg-gray-800">
                    <h5 className="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Vehicle Usage</h5>
                    <div className="flex justify-center mt-4">
                        <canvas ref={chartRef} height="250"></canvas>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
