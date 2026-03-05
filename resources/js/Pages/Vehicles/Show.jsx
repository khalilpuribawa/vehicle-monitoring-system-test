import { useForm, Head, Link, usePage, router } from '@inertiajs/react';
import AppLayout from '../../Layouts/AppLayout';

export default function Show({ vehicle }) {
    const { flash, errors: pageErrors } = usePage().props;

    // Fuel Form
    const { data: fuelData, setData: setFuelData, post: postFuel, reset: resetFuel } = useForm({
        date: '',
        added_amount: '',
        cost: '',
        notes: '',
    });

    const submitFuel = (e) => {
        e.preventDefault();
        postFuel(`/vehicles/${vehicle.id}/fuel`, {
            onSuccess: () => resetFuel()
        });
    };

    // Service Form
    const { data: serviceData, setData: setServiceData, post: postService, reset: resetService } = useForm({
        service_date: '',
        cost: '',
        description: '',
    });

    const submitService = (e) => {
        e.preventDefault();
        postService(`/vehicles/${vehicle.id}/service`, {
            onSuccess: () => resetService()
        });
    };

    const completeService = (serviceId) => {
        if (confirm('Mark as completed?')) {
            router.post(`/vehicles/service/${serviceId}/complete`);
        }
    };

    return (
        <AppLayout>
            <Head title={`Vehicle Detail: ${vehicle.name}`} />

            {flash.success && (
                <div className="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                    {flash.success}
                </div>
            )}

            {Object.keys(pageErrors).length > 0 && (
                <div className="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                    <ul className="list-disc pl-5">
                        {Object.values(pageErrors).map((error, index) => (
                            <li key={index}>{error}</li>
                        ))}
                    </ul>
                </div>
            )}

            <div className="mb-6 flex items-center justify-between">
                <h2 className="text-2xl font-bold dark:text-white">Vehicle Detail: {vehicle.name}</h2>
                <Link href="/vehicles" className="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">&larr; Back to Vehicles</Link>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                {/* Profile Card */}
                <div className="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <h5 className="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">Profile</h5>
                    <div className="mt-4 space-y-2 text-sm text-gray-700 dark:text-gray-300">
                        <p><span className="font-semibold">Type:</span> <span className="capitalize">{vehicle.type}</span></p>
                        <p><span className="font-semibold">Source:</span> <span className="capitalize">{vehicle.source}</span></p>
                        <p><span className="font-semibold">Fuel Cons.:</span> {vehicle.fuel_consumption} km/L</p>
                        <p><span className="font-semibold">Status:</span>
                            {vehicle.status === 'available' ? (
                                <span className="text-green-600 font-medium ml-1">Available</span>
                            ) : (
                                <span className="text-gray-500 font-medium ml-1">Unavailable</span>
                            )}
                        </p>
                        <p><span className="font-semibold">Condition:</span>
                            {vehicle.condition === 'bagus' ? (
                                <span className="text-blue-600 font-medium ml-1">Bagus</span>
                            ) : (
                                <span className="text-red-600 font-medium ml-1">Tidak Bagus</span>
                            )}
                        </p>
                    </div>
                </div>

                {/* Add Fuel Record Card */}
                <div className="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 md:col-span-2">
                    <h5 className="mb-4 text-lg font-bold tracking-tight text-gray-900 dark:text-white">Record Fuel Refill</h5>
                    <form onSubmit={submitFuel}>
                        <div className="grid gap-4 mb-4 grid-cols-1 md:grid-cols-3">
                            <div>
                                <label className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                                <input type="date" value={fuelData.date} onChange={e => setFuelData('date', e.target.value)} className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required />
                            </div>
                            <div>
                                <label className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount (Litres)</label>
                                <input type="number" step="0.1" value={fuelData.added_amount} onChange={e => setFuelData('added_amount', e.target.value)} className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required />
                            </div>
                            <div>
                                <label className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cost (Rp)</label>
                                <input type="number" step="1000" value={fuelData.cost} onChange={e => setFuelData('cost', e.target.value)} className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required />
                            </div>
                            <div className="md:col-span-3">
                                <label className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Notes (Optional)</label>
                                <input type="text" value={fuelData.notes} onChange={e => setFuelData('notes', e.target.value)} className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" />
                            </div>
                        </div>
                        <button type="submit" className="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700">Save Fuel Log</button>
                    </form>
                </div>
            </div>

            <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {/* Schedule Maintenance */}
                <div className="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 overflow-hidden">
                    <div className="p-6 border-b border-gray-200 dark:border-gray-700">
                        <h5 className="mb-4 text-lg font-bold tracking-tight text-gray-900 dark:text-white">Schedule Maintenance</h5>
                        <form onSubmit={submitService}>
                            <div className="grid gap-4 mb-4 grid-cols-1 sm:grid-cols-2">
                                <div>
                                    <label className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Service Date</label>
                                    <input type="date" value={serviceData.service_date} onChange={e => setServiceData('service_date', e.target.value)} className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required />
                                </div>
                                <div>
                                    <label className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Est. Cost (Rp)</label>
                                    <input type="number" step="1000" value={serviceData.cost} onChange={e => setServiceData('cost', e.target.value)} className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required />
                                </div>
                                <div className="sm:col-span-2">
                                    <label className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                    <input type="text" value={serviceData.description} onChange={e => setServiceData('description', e.target.value)} placeholder="e.g. Ganti Oli dan Filter" className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required />
                                </div>
                            </div>
                            <button type="submit" className="text-white bg-yellow-600 hover:bg-yellow-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellow-500 dark:hover:bg-yellow-600">Schedule Service</button>
                        </form>
                    </div>

                    <div className="p-6">
                        <h5 className="mb-4 text-md font-bold text-gray-900 dark:text-white">Service History</h5>
                        <div className="relative overflow-x-auto">
                            <table className="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th className="px-4 py-2">Date</th>
                                        <th className="px-4 py-2">Desc.</th>
                                        <th className="px-4 py-2">Status</th>
                                        <th className="px-4 py-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {vehicle.service_schedules && vehicle.service_schedules.length > 0 ? vehicle.service_schedules.map(service => (
                                        <tr key={service.id} className="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td className="px-4 py-3">{new Date(service.service_date).toLocaleDateString()}</td>
                                            <td className="px-4 py-3">{service.description}</td>
                                            <td className="px-4 py-3">
                                                {service.status === 'scheduled' ? (
                                                    <span className="text-xs font-medium px-2 py-0.5 rounded bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300">Scheduled</span>
                                                ) : (
                                                    <span className="text-xs font-medium px-2 py-0.5 rounded bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">Completed</span>
                                                )}
                                            </td>
                                            <td className="px-4 py-3">
                                                {service.status === 'scheduled' && (
                                                    <button onClick={() => completeService(service.id)} className="font-medium text-blue-600 dark:text-blue-500 hover:underline">Complete</button>
                                                )}
                                            </td>
                                        </tr>
                                    )) : (
                                        <tr>
                                            <td colSpan="4" className="px-4 py-3 text-center">No service records found.</td>
                                        </tr>
                                    )}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {/* Usage History & Fuel Logs list */}
                <div className="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 p-6 flex flex-col gap-6">
                    <div>
                        <h5 className="mb-4 text-lg font-bold tracking-tight text-gray-900 dark:text-white">Usage History (Bookings)</h5>
                        <div className="relative overflow-x-auto max-h-60 overflow-y-auto">
                            <table className="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th className="px-4 py-2">Date</th>
                                        <th className="px-4 py-2">Admin (Requested By)</th>
                                        <th className="px-4 py-2">Driver</th>
                                        <th className="px-4 py-2">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {vehicle.bookings && vehicle.bookings.length > 0 ? [...vehicle.bookings].reverse().map(booking => (
                                        <tr key={booking.id} className="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td className="px-4 py-3">{new Date(booking.created_at).toLocaleDateString()}</td>
                                            <td className="px-4 py-3">{booking.admin?.name}</td>
                                            <td className="px-4 py-3">{booking.driver?.name}</td>
                                            <td className={`px-4 py-3 capitalize ${booking.status === 'approved' ? 'text-green-600' :
                                                booking.status === 'rejected' ? 'text-red-600' : 'text-yellow-600'
                                                }`}>
                                                {booking.status}
                                            </td>
                                        </tr>
                                    )) : (
                                        <tr>
                                            <td colSpan="4" className="px-4 py-3 text-center">No bookings found.</td>
                                        </tr>
                                    )}
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div>
                        <h5 className="mb-4 text-lg font-bold tracking-tight text-gray-900 dark:text-white">Fuel Purchase Logs</h5>
                        <div className="relative overflow-x-auto max-h-48 overflow-y-auto">
                            <table className="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th className="px-4 py-2">Date</th>
                                        <th className="px-4 py-2">Litres</th>
                                        <th className="px-4 py-2">Cost</th>
                                        <th className="px-4 py-2">Notes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {vehicle.fuel_logs && vehicle.fuel_logs.length > 0 ? [...vehicle.fuel_logs].reverse().map(fuel => (
                                        <tr key={fuel.id} className="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <td className="px-4 py-3">{new Date(fuel.date).toLocaleDateString()}</td>
                                            <td className="px-4 py-3">{fuel.added_amount}</td>
                                            <td className="px-4 py-3">Rp {fuel.cost.toLocaleString('id-ID')}</td>
                                            <td className="px-4 py-3">{fuel.notes}</td>
                                        </tr>
                                    )) : (
                                        <tr>
                                            <td colSpan="4" className="px-4 py-3 text-center">No fuel logs found.</td>
                                        </tr>
                                    )}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}
