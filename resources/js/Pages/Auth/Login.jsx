import { useForm, usePage, Head } from '@inertiajs/react';
import AppLayout from '../../Layouts/AppLayout';

export default function Login() {
    const { errors } = usePage().props;
    const { data, setData, post, processing } = useForm({
        username: '',
        password: '',
    });

    const submit = (e) => {
        e.preventDefault();
        post('/login');
    };

    return (
        <AppLayout>
            <Head title="Login" />
            <div className="flex items-center justify-center h-screen">
                <div className="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
                    <form className="space-y-6" onSubmit={submit}>
                        <h5 className="text-xl font-medium text-gray-900 dark:text-white">Sign in to VMBS</h5>

                        {(errors.username || errors.password || errors.login) && (
                            <div className="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                                {errors.username || errors.password || errors.login}
                            </div>
                        )}

                        <div>
                            <label htmlFor="username" className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                            <input
                                type="text"
                                name="username"
                                id="username"
                                value={data.username}
                                onChange={e => setData('username', e.target.value)}
                                className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                required
                            />
                        </div>
                        <div>
                            <label htmlFor="password" className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input
                                type="password"
                                name="password"
                                id="password"
                                value={data.password}
                                onChange={e => setData('password', e.target.value)}
                                className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                required
                            />
                        </div>
                        <button
                            type="submit"
                            disabled={processing}
                            className="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 disabled:opacity-50">
                            Login
                        </button>
                    </form>
                </div>
            </div>
        </AppLayout>
    );
}
