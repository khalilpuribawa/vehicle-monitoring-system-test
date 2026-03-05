import { useForm, Head } from '@inertiajs/react';
import AppLayout from '../../Layouts/AppLayout';

export default function Create() {
    const { data, setData, post, processing, errors } = useForm({
        name: '',
        type: '',
        source: '',
        fuel_consumption: '',
        status: 'available',
        condition: 'bagus',
    });

    const submit = (e) => {
        e.preventDefault();
        post('/vehicles');
    };

    return (
        <AppLayout>
            <Head title="Add Vehicle" />

            {Object.keys(errors).length > 0 && (
                <div className="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                    <ul className="list-disc pl-5">
                        {Object.values(errors).map((error, index) => (
                            <li key={index}>{error}</li>
                        ))}
                    </ul>
                </div>
            )}

            <div className="p-6 bg-white rounded-lg shadow dark:bg-gray-800">
                <h2 className="mb-4 text-2xl font-bold text-gray-900 dark:text-white">Add New Vehicle</h2>
                <form onSubmit={submit}>
                    <div className="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <label htmlFor="name" className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Vehicle Name/Model</label>
                            <input type="text" id="name" value={data.name} onChange={e => setData('name', e.target.value)} className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="e.g. Toyota Hilux" required />
                        </div>

                        <div>
                            <label htmlFor="type" className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
                            <select id="type" value={data.type} onChange={e => setData('type', e.target.value)} className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <option value="" disabled>Select type</option>
                                <option value="angkutan orang">Angkutan Orang</option>
                                <option value="angkutan barang">Angkutan Barang</option>
                            </select>
                        </div>

                        <div>
                            <label htmlFor="source" className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Source</label>
                            <select id="source" value={data.source} onChange={e => setData('source', e.target.value)} className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <option value="" disabled>Select source</option>
                                <option value="milik">Milik Sendiri</option>
                                <option value="sewa">Sewa</option>
                            </select>
                        </div>

                        <div>
                            <label htmlFor="fuel_consumption" className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fuel Consumption (km/L)</label>
                            <input type="number" step="0.01" id="fuel_consumption" value={data.fuel_consumption} onChange={e => setData('fuel_consumption', e.target.value)} className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="e.g. 12.5" required />
                        </div>

                        <div>
                            <label htmlFor="status" className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                            <select id="status" value={data.status} onChange={e => setData('status', e.target.value)} className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <option value="available">Available</option>
                                <option value="unavailable">Unavailable</option>
                            </select>
                        </div>

                        <div>
                            <label htmlFor="condition" className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Condition</label>
                            <select id="condition" value={data.condition} onChange={e => setData('condition', e.target.value)} className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <option value="bagus">Bagus</option>
                                <option value="tidak bagus">Tidak Bagus</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" disabled={processing} className="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 disabled:opacity-50">Save Vehicle</button>
                </form>
            </div>
        </AppLayout>
    );
}
