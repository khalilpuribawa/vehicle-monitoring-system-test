import { Link, usePage } from '@inertiajs/react';
import AppLayout from '../../Layouts/AppLayout';
import { Head } from '@inertiajs/react';

export default function Index() {
    const { vehicles, flash } = usePage().props;

    return (
        <AppLayout>
            <Head title="Vehicles Management" />

            {flash.success && (
                <div className="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                    {flash.success}
                </div>
            )}

            <div className="flex justify-between items-center mb-6">
                <h2 className="text-2xl font-bold dark:text-white">Vehicles Management</h2>
                <Link href="/vehicles/create" className="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Add Vehicle
                </Link>
            </div>

            <div className="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table className="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" className="px-6 py-3">Name</th>
                            <th scope="col" className="px-6 py-3">Type</th>
                            <th scope="col" className="px-6 py-3">Source</th>
                            <th scope="col" className="px-6 py-3">Fuel Cons. (km/L)</th>
                            <th scope="col" className="px-6 py-3">Status</th>
                            <th scope="col" className="px-6 py-3">Condition</th>
                            <th scope="col" className="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {vehicles.length === 0 ? (
                            <tr className="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td colSpan="7" className="px-6 py-4 text-center">No vehicles found.</td>
                            </tr>
                        ) : (
                            vehicles.map(vehicle => (
                                <tr key={vehicle.id} className="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <Link href={`/vehicles/${vehicle.id}`} className="text-blue-600 hover:underline dark:text-blue-400">
                                            {vehicle.name}
                                        </Link>
                                    </td>
                                    <td className="px-6 py-4 capitalize">{vehicle.type}</td>
                                    <td className="px-6 py-4 capitalize">{vehicle.source}</td>
                                    <td className="px-6 py-4">{vehicle.fuel_consumption}</td>
                                    <td className="px-6 py-4">
                                        {vehicle.status === 'available' ? (
                                            <span className="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Available</span>
                                        ) : (
                                            <span className="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">Unavailable</span>
                                        )}
                                    </td>
                                    <td className="px-6 py-4">
                                        {vehicle.condition === 'bagus' ? (
                                            <span className="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">Bagus</span>
                                        ) : (
                                            <span className="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Tidak Bagus</span>
                                        )}
                                    </td>
                                    <td className="px-6 py-4">
                                        <Link href={`/vehicles/${vehicle.id}/edit`} className="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</Link>
                                    </td>
                                </tr>
                            ))
                        )}
                    </tbody>
                </table>
            </div>
        </AppLayout>
    );
}
