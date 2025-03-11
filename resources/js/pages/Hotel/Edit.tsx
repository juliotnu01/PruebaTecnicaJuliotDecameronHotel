import React, { useState, useEffect } from 'react';
import { useForm } from '@inertiajs/react';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';
import { toast } from 'react-toastify'; // Importar toast


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: route('dashboard'),
    },
    {
        title: 'Hoteles',
        href: route('hotel.index'),
    },
    {
        title: 'Editar Hotel',
        href: '#', // No es necesario un enlace aquí, ya que estamos en la página actual
    },
];

export default function HotelEdit({ hotel, roomTypes, accommodations }: any) {


    const { data, setData, put, processing, errors } = useForm({
        nombre: hotel.data.nombre,
        direccion: hotel.data.direccion,
        ciudad: hotel.data.ciudad,
        nit: hotel.data.nit,
        numero_habitaciones: String(hotel.data.numero_habitaciones),
        habitaciones_configuradas: hotel.data.habitaciones_configuradas.map((room: any) => ({

            id: room.id,
            room_type_id: room.room_type_id,
            accommodation_id: room.accommodation_id,
            cantidad: room.cantidad,
        })),
    });

    // Estado local para manejar las habitaciones configuradas
    const [rooms, setRooms] = useState(data.habitaciones_configuradas);



    useEffect(() => {
        // Sincronizar el estado local con los datos del formulario
        setRooms(data.habitaciones_configuradas);
    }, [data.habitaciones_configuradas]);

    const handleAddRoom = () => {
        setRooms([...rooms, { room_type_id: '', accommodation_id: '', cantidad: '' }]);
    };

    const handleRoomChange = (index: number, field: keyof typeof rooms[0], value: string) => {
        const updatedRooms = [...rooms];
        updatedRooms[index][field] = value;
        setRooms(updatedRooms);
        setData('habitaciones_configuradas', updatedRooms);
    };

    const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => {
        e.preventDefault();
        // put(`/hotel/${hotel.data.id}`);
        put(route('hotel.update', { hotel: hotel.data.id }), {
            onSuccess: () => {
                toast.success('Hotel creado exitosamente.', {
                    position: 'top-right',
                    autoClose: 3000,
                    hideProgressBar: false,
                    closeOnClick: true,
                    pauseOnHover: true,
                });
            },
            onError: (responseErrors: Record<string, string>) => {
                Object.keys(responseErrors).forEach((key) => {
                    toast.error(`${key}: ${responseErrors[key]}`, {
                        position: 'top-right',
                        autoClose: 5000,
                        hideProgressBar: false,
                        closeOnClick: true,
                        pauseOnHover: true,
                    });
                });
            },
        });
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Editar Hotel" />
            <div className="flex h-full flex-1 flex-col gap-6 rounded-xl p-6 bg-white shadow-lg">
                <h2 className="text-3xl font-bold text-gray-800">Editar Hotel</h2>
                <form onSubmit={handleSubmit} className="space-y-6">
                    {/* Campos básicos del hotel */}
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

                    {/* Habitaciones Configuradas */}
                    <div>
                        <h3 className="text-xl font-bold">Habitaciones Configuradas</h3>
                        <button
                            type="button"
                            onClick={handleAddRoom}
                            className="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600 transition-colors"
                        >
                            Agregar Habitación
                        </button>
                        {rooms.map((room: any, index: any) => (
                            <div key={index} className="mt-4 space-y-2">
                                <select
                                    value={String(room.room_type_id)} // Convertir a string para coincidir con el value del option
                                    onChange={(e) => handleRoomChange(index, 'room_type_id', e.target.value)}
                                    className="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm"
                                >
                                    <option value="">Selecciona un tipo de habitación</option>
                                    {roomTypes.data.length > 0 ? (
                                        roomTypes.data.map((roomType: any) => (
                                            <option key={roomType.id} value={String(roomType.id)}> {/* Convertir a string */}
                                                {roomType.nombre}
                                            </option>
                                        ))
                                    ) : (
                                        <option value="" disabled>
                                            No hay tipos de habitación disponibles
                                        </option>
                                    )}
                                </select>

                                <select
                                    value={String(room.accommodation_id)} // Convertir a string para coincidir con el value del option
                                    onChange={(e) => handleRoomChange(index, 'accommodation_id', e.target.value)}
                                    className="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm"
                                >
                                    <option value="">Selecciona una acomodación</option>
                                    {accommodations.data.length > 0 ? (
                                        accommodations.data.map((accommodation: any) => (
                                            <option key={accommodation.id} value={String(accommodation.id)}> {/* Convertir a string */}
                                                {accommodation.nombre}
                                            </option>
                                        ))
                                    ) : (
                                        <option value="" disabled>
                                            No hay acomodaciones disponibles
                                        </option>
                                    )}
                                </select>

                                {/* Input para Cantidad */}
                                <input
                                    type="number"
                                    value={room.cantidad}
                                    onChange={(e) => handleRoomChange(index, 'cantidad', e.target.value)}
                                    placeholder="Cantidad"
                                    className="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm"
                                />
                            </div>
                        ))}
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