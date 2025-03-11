import React from 'react';

const HotelCard = ({ hotel }: any) => {
    return (
        <div className="border-sidebar-border/70 dark:border-sidebar-border relative overflow-hidden rounded-xl border flex flex-col">
            <div className="p-4 flex-grow">
                <h3 className="font-semibold text-lg">{hotel.nombre}</h3>
                <p className="text-sm text-gray-600 dark:text-gray-400">
                    {hotel.ciudad}, {hotel.direccion}
                </p>
                <p className="text-sm text-gray-500 dark:text-gray-400">
                    Habitaciones: {hotel.numero_habitaciones}
                </p>

                {/* Mostrar Habitaciones Configuradas */}
                <div className="mt-4">
                    <h4 className="text-md font-semibold">Habitaciones Configuradas:</h4>
                    <ul className="list-disc pl-4">
                        {hotel.habitaciones_configuradas && hotel.habitaciones_configuradas.length > 0 ? (
                            hotel.habitaciones_configuradas.map((config: any) => (
                                <li key={config.id}>
                                    {config.cantidad} × {config.room_type.nombre} - {config.accommodation.nombre}
                                </li>
                            ))
                        ) : (
                            <li>No hay habitaciones configuradas.</li>
                        )}
                    </ul>
                </div>
            </div>

            {/* Botón de Edición */}
            <div className="p-4 bg-gray-100 dark:bg-gray-800 flex justify-end mt-auto">
                <a
                    href={`/hotel/${hotel.id}/edit`}
                    className="bg-yellow-500 text-white px-3 py-1 rounded-md hover:bg-yellow-600 transition-colors text-sm"
                >
                    Editar
                </a>
            </div>
        </div>
    );
};

export default HotelCard;