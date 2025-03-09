import React, { useState } from 'react';
import { useForm } from '@inertiajs/react';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';
import InputField from '@/components/InputField';

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
        title: 'Crear Hotel',
        href: route('hotel.create'),
    },
];

export default function HotelCreate() {
    const { data, setData, post, processing, errors } = useForm({
        nombre: '',
        direccion: '',
        ciudad: '',
        nit: '',
        numero_habitaciones: '',
        habitaciones_configuradas: [],
    });

    const [rooms, setRooms]: any = useState([]);

    const handleAddRoom = () => {
        setRooms([...rooms, { room_type_id: '', accommodation_id: '', cantidad: '' }]);
    };

    const handleRoomChange = (index: any, field: any, value: any) => {
        const updatedRooms: any = [...rooms];
        updatedRooms[index][field] = value;
        setRooms(updatedRooms);
        setData('habitaciones_configuradas', updatedRooms);
    };

    const handleSubmit = (e: any) => {
        e.preventDefault();
    
        const formData: any = {
            ...data,
            habitaciones_configuradas: data.habitaciones_configuradas,
        };
    
        post(route('hotel.store'), formData);
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Crear Hotel" />
            <div className="flex h-full flex-1 flex-col gap-6 rounded-xl p-6 bg-white shadow-lg">
                <h2 className="text-3xl font-bold text-gray-800">Crear Nuevo Hotel</h2>
                <form onSubmit={handleSubmit} className="space-y-6">
                    <div className="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <InputField
                            label="Nombre"
                            value={data.nombre}
                            onChange={(e: any) => setData('nombre', e.target.value)}
                            error={errors.nombre}
                        />
                        <InputField
                            label="Dirección"
                            value={data.direccion}
                            onChange={(e: any) => setData('direccion', e.target.value)}
                            error={errors.direccion}
                        />
                        <InputField
                            label="Ciudad"
                            value={data.ciudad}
                            onChange={(e: any) => setData('ciudad', e.target.value)}
                            error={errors.ciudad}
                        />
                        <InputField
                            label="NIT"
                            value={data.nit}
                            onChange={(e: any) => setData('nit', e.target.value)}
                            error={errors.nit}
                        />
                        <InputField
                            label="Número de Habitaciones"
                            type="number"
                            value={data.numero_habitaciones}
                            onChange={(e: any) => setData('numero_habitaciones', e.target.value)}
                            error={errors.numero_habitaciones}
                        />
                    </div>

                    {/* Agregar Habitaciones Configuradas */}
                    <div>
                        <h3 className="text-xl font-bold">Habitaciones Configuradas</h3>
                        <button
                            type="button"
                            onClick={handleAddRoom}
                            className="bg-primary text-white px-4 py-2 rounded-md hover:bg-primary-dark transition-colors"
                        >
                            Agregar Habitación
                        </button>
                        {rooms.map((room: any, index: any) => (
                            <div key={index} className="mt-4 space-y-2">
                                <select
                                    value={room.room_type_id}
                                    onChange={(e) => handleRoomChange(index, 'room_type_id', e.target.value)}
                                    className="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm"
                                >
                                    <option value="">Selecciona un tipo de habitación</option>
                                    <option value="1">Estándar</option>
                                    <option value="2">Junior</option>
                                    <option value="3">Suite</option>
                                </select>
                                <select
                                    value={room.accommodation_id}
                                    onChange={(e) => handleRoomChange(index, 'accommodation_id', e.target.value)}
                                    className="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm"
                                >
                                    <option value="">Selecciona una acomodación</option>
                                    <option value="1">Sencilla</option>
                                    <option value="2">Doble</option>
                                    <option value="3">Triple</option>
                                </select>
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
                            className="bg-primary text-white px-6 py-2 rounded-md hover:bg-primary-dark transition-colors"
                            disabled={processing}
                        >
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </AppLayout>
    );
}