import React from 'react';
import { useForm } from '@inertiajs/react';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
    {
        title: 'Hoteles',
        href: '/hoteles',
    },
    {
        title: 'Editar Hotel',
        href: '#', // No es necesario un enlace aquí, ya que estamos en la página actual
    },
];

export default function HotelEdit({ hotel }: any) {
    const { data, setData, put, processing, errors } = useForm({
        nombre: hotel.data.nombre,
        direccion: hotel.data.direccion,
        ciudad: hotel.data.ciudad,
        nit: hotel.data.nit,
        numero_habitaciones: hotel.data.numero_habitaciones, // Convertir a string para el input
    });

    const handleSubmit = (e: any) => {
        e.preventDefault();
        put(`/hotel/${hotel.data.id}`);
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Editar Hotel" />
            <div className="flex h-full flex-1 flex-col gap-6 rounded-xl p-6 bg-white shadow-lg">
                <h2 className="text-3xl font-bold text-gray-800">Editar Hotel</h2>
                <form onSubmit={handleSubmit} className="space-y-6">
                    <div className="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label className="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Nombre
                            </label>
                            <input
                                type="text"
                                value={data.nombre}
                                onChange={(e) => setData('nombre', e.target.value)}
                                className="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm transition duration-150 ease-in-out"
                            />
                            {errors.nombre && (
                                <p className="text-red-500 text-sm">{errors.nombre}</p>
                            )}
                        </div>
                        <div>
                            <label className="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Dirección
                            </label>
                            <input
                                type="text"
                                value={data.direccion}
                                onChange={(e) => setData('direccion', e.target.value)}
                                className="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm transition duration-150 ease-in-out"
                            />
                            {errors.direccion && (
                                <p className="text-red-500 text-sm">{errors.direccion}</p>
                            )}
                        </div>
                        <div>
                            <label className="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Ciudad
                            </label>
                            <input
                                type="text"
                                value={data.ciudad}
                                onChange={(e) => setData('ciudad', e.target.value)}
                                className="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm transition duration-150 ease-in-out"
                            />
                            {errors.ciudad && (
                                <p className="text-red-500 text-sm">{errors.ciudad}</p>
                            )}
                        </div>
                        <div>
                            <label className="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                NIT
                            </label>
                            <input
                                type="text"
                                value={data.nit}
                                onChange={(e) => setData('nit', e.target.value)}
                                className="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm transition duration-150 ease-in-out"
                            />
                            {errors.nit && (
                                <p className="text-red-500 text-sm">{errors.nit}</p>
                            )}
                        </div>
                        <div>
                            <label className="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Número de Habitaciones
                            </label>
                            <input
                                type="number"
                                value={data.numero_habitaciones}
                                onChange={(e) => setData('numero_habitaciones', e.target.value)}
                                className="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm transition duration-150 ease-in-out"
                            />
                            {errors.numero_habitaciones && (
                                <p className="text-red-500 text-sm">{errors.numero_habitaciones}</p>
                            )}
                        </div>
                    </div>
                    <div className="flex justify-end">
                        <button
                            type="submit"
                            className="bg-yellow-500 text-white px-6 py-2 rounded-md hover:bg-yellow-600 transition-colors"
                            disabled={processing}
                        >
                            Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </AppLayout>
    );
}