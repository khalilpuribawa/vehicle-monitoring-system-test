import { Link, usePage } from '@inertiajs/react';
import AppLayout from '../../Layouts/AppLayout';
import { Head } from '@inertiajs/react';

export default function Index() {
    const { drivers, flash } = usePage().props;

    return (
        <AppLayout>
            <Head title="Drivers Management" />

            {flash.success && (
                <div className="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                    {flash.success}
                </div>
            )}

            <div className="flex justify-between items-center mb-6">
                <h2 className="text-2xl font-bold dark:text-white">Drivers Management</h2>
                <Link href="/drivers/create" className="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Add Driver
                </Link>
            </div>

            <div className="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table className="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" className="px-6 py-3">ID</th>
                            <th scope="col" className="px-6 py-3">Name</th>
                            <th scope="col" className="px-6 py-3">Status</th>
                            <th scope="col" className="px-6 py-3">Added At</th>
                            <th scope="col" className="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {drivers.length === 0 ? (
                            <tr className="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td colSpan="5" className="px-6 py-4 text-center">No drivers found.</td>
                            </tr>
                        ) : (
                            drivers.map(driver => (
                                <tr key={driver.id} className="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td className="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        #{driver.id}
                                    </td>
                                    <td className="px-6 py-4">{driver.name}</td>
                                    <td className="px-6 py-4">
                                        {driver.status === 'available' ? (
                                            <span className="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Available</span>
                                        ) : (
                                            <span className="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Busy</span>
                                        )}
                                    </td>
                                    <td className="px-6 py-4">{new Date(driver.created_at).toLocaleDateString()}</td>
                                    <td className="px-6 py-4">
                                        <Link href={`/drivers/${driver.id}/edit`} className="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</Link>
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
