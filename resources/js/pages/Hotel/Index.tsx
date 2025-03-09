import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';
import HotelCard from '@/components/HotelCard'; // Importar el componente reutilizable

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
    {
        title: 'Hoteles',
        href: '/hoteles',
    },
];

export default function HotelIndex({ hoteles }: any) {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Hoteles" />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                {/* Encabezado */}
                <div className="flex justify-between items-center">
                    <h2 className="text-2xl font-bold">Listado de Hoteles</h2>
                    <a
                        href="/hotel/create"
                        className="bg-primary text-white px-4 py-2 rounded-md hover:bg-primary-dark transition-colors"
                    >
                        Crear Nuevo Hotel
                    </a>
                </div>

                {/* Lista de Hoteles */}
                <div className="grid auto-rows-min gap-4 md:grid-cols-3">
                    {hoteles.data.length > 0 ? (
                        hoteles.data.map((hotel: any) => (
                            <HotelCard key={hotel.id} hotel={hotel} />
                        ))
                    ) : (
                        <div className="col-span-full text-center text-gray-500">
                            No hay hoteles registrados.
                        </div>
                    )}
                </div>
            </div>
        </AppLayout>
    );
}