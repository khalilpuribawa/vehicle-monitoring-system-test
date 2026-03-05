import { useForm, Head } from '@inertiajs/react';
import AppLayout from '../../Layouts/AppLayout';

export default function Create({ vehicles, drivers, approvers }) {
    const { data, setData, post, processing, errors } = useForm({
        vehicle_id: '',
        driver_id: '',
        approver_1_id: '',
        approver_2_id: '',
    });

    const submit = (e) => {
        e.preventDefault();
        post('/bookings');
    };

    return (
        <AppLayout>
            <Head title="Create Booking" />

            {Object.keys(errors).length > 0 && (
                <div className="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                    <ul className="list-disc pl-5">
                        {Object.values(errors).map((error, index) => (
                            <li key={index}>{error}</li>
                        ))}
                    </ul>
                </div>
            )}

            <div className="p-6 bg-white rounded-lg shadow dark:bg-gray-800 max-w-4xl mx-auto">
                <h2 className="mb-4 text-2xl font-bold text-gray-900 dark:text-white">Create New Booking</h2>
                <form onSubmit={submit}>
                    <div className="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <label htmlFor="vehicle_id" className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Vehicle</label>
                            <select id="vehicle_id" value={data.vehicle_id} onChange={e => setData('vehicle_id', e.target.value)} className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <option value="" disabled>Choose a vehicle</option>
                                {vehicles.map(vehicle => (
                                    <option key={vehicle.id} value={vehicle.id}>
                                        {vehicle.name} - {vehicle.type} ({vehicle.condition.charAt(0).toUpperCase() + vehicle.condition.slice(1)})
                                    </option>
                                ))}
                            </select>
                        </div>

                        <div>
                            <label htmlFor="driver_id" className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Driver</label>
                            <select id="driver_id" value={data.driver_id} onChange={e => setData('driver_id', e.target.value)} className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <option value="" disabled>Choose a driver</option>
                                {drivers.map(driver => (
                                    <option key={driver.id} value={driver.id}>{driver.name}</option>
                                ))}
                            </select>
                        </div>

                        <div>
                            <label htmlFor="approver_1_id" className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Approver Level 1</label>
                            <select id="approver_1_id" value={data.approver_1_id} onChange={e => setData('approver_1_id', e.target.value)} className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <option value="" disabled>Select first approver</option>
                                {approvers.map(approver => (
                                    <option key={approver.id} value={approver.id}>{approver.name}</option>
                                ))}
                            </select>
                        </div>

                        <div>
                            <label htmlFor="approver_2_id" className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Approver Level 2</label>
                            <select id="approver_2_id" value={data.approver_2_id} onChange={e => setData('approver_2_id', e.target.value)} className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <option value="" disabled>Select second approver</option>
                                {approvers.map(approver => (
                                    <option key={approver.id} value={approver.id}>{approver.name}</option>
                                ))}
                            </select>
                        </div>
                    </div>

                    <button type="submit" disabled={processing} className="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 disabled:opacity-50">Submit Booking</button>
                </form>
            </div>
        </AppLayout>
    );
}
